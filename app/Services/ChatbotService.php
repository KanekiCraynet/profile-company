<?php

namespace App\Services;

use App\Repositories\ChatbotRuleRepository;
use App\Repositories\ChatHistoryRepository;
use App\Models\ChatHistory;
use Illuminate\Support\Facades\Cache;

class ChatbotService
{
    public function __construct(
        protected ChatbotRuleRepository $ruleRepository,
        protected ChatHistoryRepository $historyRepository
    ) {}

    /**
     * Process user message and return bot response.
     *
     * @param string $message
     * @param string|null $sessionId
     * @param string|null $ipAddress
     * @param string|null $userAgent
     * @return array
     */
    public function processMessage(
        string $message,
        ?string $sessionId = null,
        ?string $ipAddress = null,
        ?string $userAgent = null
    ): array {
        $message = trim($message);
        
        if (empty($message)) {
            return [
                'response' => 'Please provide a message.',
                'rule_id' => null,
            ];
        }

        // Find matching rule (don't cache per-message as messages vary)
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

        // Generate session ID if not provided
        if (!$sessionId) {
            $sessionId = $this->generateSessionId();
        }

        // Save chat history
        $this->historyRepository->create([
            'session_id' => $sessionId,
            'user_message' => $message,
            'bot_response' => $response,
            'rule_id' => $ruleId,
            'ip_address' => $ipAddress,
            'user_agent' => $userAgent,
        ]);

        return [
            'response' => $response,
            'rule_id' => $ruleId,
            'session_id' => $sessionId,
        ];
    }

    /**
     * Get chat history by session.
     *
     * @param string $sessionId
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getChatHistory(string $sessionId)
    {
        return $this->historyRepository->getBySession($sessionId);
    }

    /**
     * Get analytics data.
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
        return uniqid('chat_', true) . '_' . time();
    }
}

