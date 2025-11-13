<?php

namespace App\Services;

use App\Repositories\ChatbotRuleRepository;
use App\Repositories\ChatHistoryRepository;
use App\Models\ChatHistory;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ChatbotService
{
    /**
     * Rate limiting: max requests per minute per IP.
     */
    const RATE_LIMIT_PER_MINUTE = 30;

    /**
     * Rate limiting: max requests per hour per IP.
     */
    const RATE_LIMIT_PER_HOUR = 200;

    /**
     * Cache TTL for message responses (5 minutes).
     */
    const MESSAGE_CACHE_TTL = 300;

    public function __construct(
        protected ChatbotRuleRepository $ruleRepository,
        protected ChatHistoryRepository $historyRepository
    ) {}

    /**
     * Check rate limit for IP address.
     *
     * @param string $ipAddress
     * @return bool
     */
    public function checkRateLimit(string $ipAddress): bool
    {
        $minuteKey = "chatbot:rate_limit:minute:{$ipAddress}";
        $hourKey = "chatbot:rate_limit:hour:{$ipAddress}";

        // Check per-minute limit
        if (RateLimiter::tooManyAttempts($minuteKey, self::RATE_LIMIT_PER_MINUTE)) {
            return false;
        }

        // Check per-hour limit
        if (RateLimiter::tooManyAttempts($hourKey, self::RATE_LIMIT_PER_HOUR)) {
            return false;
        }

        // Increment rate limit counters
        RateLimiter::hit($minuteKey, 60); // 60 seconds
        RateLimiter::hit($hourKey, 3600); // 3600 seconds (1 hour)

        return true;
    }

    /**
     * Get remaining rate limit attempts.
     *
     * @param string $ipAddress
     * @return array
     */
    public function getRateLimitInfo(string $ipAddress): array
    {
        $minuteKey = "chatbot:rate_limit:minute:{$ipAddress}";
        $hourKey = "chatbot:rate_limit:hour:{$ipAddress}";

        return [
            'remaining_minute' => RateLimiter::remaining($minuteKey, self::RATE_LIMIT_PER_MINUTE),
            'remaining_hour' => RateLimiter::remaining($hourKey, self::RATE_LIMIT_PER_HOUR),
            'retry_after_minute' => RateLimiter::availableIn($minuteKey),
            'retry_after_hour' => RateLimiter::availableIn($hourKey),
        ];
    }

    /**
     * Process user message and return bot response (optimized with caching and rate limiting).
     *
     * @param string $message
     * @param string|null $sessionId
     * @param string|null $ipAddress
     * @param string|null $userAgent
     * @param int|null $userId
     * @return array
     */
    public function processMessage(
        string $message,
        ?string $sessionId = null,
        ?string $ipAddress = null,
        ?string $userAgent = null,
        ?int $userId = null
    ): array {
        $message = trim($message);
        
        if (empty($message)) {
            return [
                'response' => 'Please provide a message.',
                'rule_id' => null,
                'session_id' => $sessionId,
            ];
        }

        // Check rate limit if IP address is provided
        if ($ipAddress && !$this->checkRateLimit($ipAddress)) {
            $rateLimitInfo = $this->getRateLimitInfo($ipAddress);
            return [
                'response' => 'Too many requests. Please try again later.',
                'rule_id' => null,
                'session_id' => $sessionId,
                'rate_limit' => $rateLimitInfo,
                'error' => 'rate_limit_exceeded',
            ];
        }

        // Generate session ID if not provided
        if (!$sessionId) {
            $sessionId = $this->generateSessionId();
        }

        // Try to get cached response for exact message match (optional optimization)
        $messageHash = md5(strtolower($message));
        $cacheKey = "chatbot:response:{$messageHash}";
        
        // Note: We don't cache responses by default as messages vary, but we can cache exact matches
        // Uncomment if needed: $cachedResponse = Cache::get($cacheKey);

        // Find matching rule using optimized repository method (uses cached rules)
        $rule = $this->ruleRepository->findMatchingRule($message);

        $response = null;
        $ruleId = null;

        if ($rule) {
            $response = $rule->response;
            $ruleId = $rule->id;

            // Handle different response types
            if ($rule->type === 'link' && isset($rule->response)) {
                // Response might contain URL, parse it
                $response = $rule->response;
            } elseif ($rule->type === 'product' && isset($rule->response)) {
                // Response might contain product reference
                $response = $rule->response;
            }
        } else {
            // Fallback responses
            $fallbacks = [
                'I\'m sorry, I didn\'t understand that. Could you please rephrase your question?',
                'I\'m here to help with information about our products and services. What would you like to know?',
                'Please check our website for more detailed information, or feel free to ask about our products!',
                'For detailed product information, please visit our products page. How else can I help you?',
            ];
            $response = $fallbacks[array_rand($fallbacks)];
        }

        // Save chat history asynchronously (in transaction for data integrity)
        try {
            DB::transaction(function () use ($sessionId, $userId, $message, $response, $ruleId, $ipAddress, $userAgent) {
                $this->historyRepository->create([
                    'session_id' => $sessionId,
                    'user_id' => $userId,
                    'user_message' => $message,
                    'bot_response' => $response,
                    'rule_id' => $ruleId,
                    'ip_address' => $ipAddress,
                    'user_agent' => $userAgent,
                ]);

                // Clear session cache if history was saved
                $this->historyRepository->clearSessionCache($sessionId);
            });
        } catch (\Exception $e) {
            // Log the error but don't fail the request
            Log::error('Failed to save chat history: ' . $e->getMessage(), [
                'exception' => $e,
                'user_id' => $userId,
                'session_id' => $sessionId,
                'message' => $message
            ]);
        }

        return [
            'response' => $response,
            'rule_id' => $ruleId,
            'session_id' => $sessionId,
            'timestamp' => now()->toISOString(),
        ];
    }

    /**
     * Get chat history by session (with caching).
     *
     * @param string $sessionId
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getChatHistory(string $sessionId)
    {
        return $this->historyRepository->getBySession($sessionId);
    }

    /**
     * Get analytics data (with caching).
     *
     * @param int $days
     * @return array
     */
    public function getAnalytics(int $days = 30)
    {
        return $this->historyRepository->getAnalytics($days);
    }

    /**
     * Generate a unique session ID.
     *
     * @return string
     */
    protected function generateSessionId(): string
    {
        // Use a more secure session ID generation
        return 'chat_' . uniqid('', true) . '_' . time() . '_' . bin2hex(random_bytes(8));
    }

    /**
     * Clear chatbot cache (rules and history).
     *
     * @return void
     */
    public function clearCache(): void
    {
        $this->ruleRepository->clearCache();
        $this->historyRepository->clearCache();
    }

    /**
     * Warm up chatbot cache (pre-load rules).
     *
     * @return void
     */
    public function warmCache(): void
    {
        $this->ruleRepository->warmCache();
    }
}

