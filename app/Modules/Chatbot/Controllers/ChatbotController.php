<?php

namespace App\Modules\Chatbot\Controllers;

use App\Http\Controllers\Controller;
use App\Models\ChatbotRule;
use App\Models\ChatHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class ChatbotController extends Controller
{
    /**
     * Handle GET request to chatbot endpoint (returns error message)
     */
    public function handleGet()
    {
        return response()->json([
            'error' => 'This endpoint only accepts POST requests. Please use the chatbot interface.',
            'message' => 'Use POST method with a JSON body containing {"message": "your message"}'
        ], 405);
    }

    /**
     * Handle POST request with chatbot message
     */
    public function handleMessage(Request $request)
    {
        $request->validate([
            'message' => 'required|string|max:500'
        ]);

        $message = strtolower(trim($request->message));
        $userId = auth()->id(); // Can be null for unauthenticated users

        // Check for keyword matches in chatbot rules
        $rules = Cache::remember('chatbot_rules', 3600, function () {
            return ChatbotRule::where('status', 'active')
                ->orderBy('priority', 'desc')
                ->get();
        });

        $response = null;
        $matchedRule = null;

        foreach ($rules as $rule) {
            // Check if the keyword appears in the message
            $keyword = strtolower(trim($rule->keyword));
            if (!empty($keyword) && str_contains($message, $keyword)) {
                $response = $rule->response;
                $matchedRule = $rule;
                break;
            }
        }

        // Fallback responses if no keyword match
        if (!$response) {
            $fallbacks = [
                'I\'m sorry, I didn\'t understand that. Could you please rephrase your question?',
                'I\'m here to help with information about our products and services. What would you like to know?',
                'Please check our website for more detailed information, or feel free to ask about our products!',
            ];
            $response = $fallbacks[array_rand($fallbacks)];
        }

        // Save chat history
        try {
            $sessionId = session()->getId() ?? null;
            
            ChatHistory::create([
                'session_id' => $sessionId,
                'user_id' => $userId,
                'user_message' => $request->message,
                'bot_response' => $response,
                'rule_id' => $matchedRule ? $matchedRule->id : null,
                'ip_address' => $request->ip(),
                'user_agent' => $request->userAgent() ?? 'Unknown',
            ]);
        } catch (\Exception $e) {
            // Log the error but don't fail the request
            \Log::error('Failed to save chat history: ' . $e->getMessage(), [
                'exception' => $e,
                'user_id' => $userId,
                'message' => $request->message
            ]);
        }

        return response()->json([
            'response' => $response,
            'timestamp' => now()->toISOString()
        ]);
    }
}
