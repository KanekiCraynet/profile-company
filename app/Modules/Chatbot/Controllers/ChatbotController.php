<?php

namespace App\Modules\Chatbot\Controllers;

use App\Http\Controllers\Controller;
use App\Services\ChatbotService;
use Illuminate\Http\Request;

class ChatbotController extends Controller
{
    public function __construct(
        protected ChatbotService $chatbotService
    ) {}

    /**
     * Handle chatbot message.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function handleMessage(Request $request)
    {
        $request->validate([
            'message' => 'required|string|max:500',
            'session_id' => 'nullable|string|max:255',
        ]);

        try {
            $result = $this->chatbotService->processMessage(
                $request->message,
                $request->session_id,
                $request->ip(),
                $request->userAgent()
            );

            return response()->json([
                'success' => true,
                'response' => $result['response'],
                'session_id' => $result['session_id'],
                'timestamp' => now()->toISOString(),
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'response' => 'Sorry, an error occurred. Please try again.',
                'timestamp' => now()->toISOString(),
            ], 500);
        }
    }
}