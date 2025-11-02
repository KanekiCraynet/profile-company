<?php

namespace App\Modules\Admin\Controllers;

use App\Http\Controllers\Controller;
use App\Models\ChatbotRule;
use App\Models\ChatHistory;
use Illuminate\Http\Request;

class ChatbotController extends Controller
{
    public function index()
    {
        $rules = ChatbotRule::orderBy('priority', 'desc')->paginate(15);
        return view('admin.chatbot.index', compact('rules'));
    }

    public function create()
    {
        return view('admin.chatbot.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'keyword' => 'required|string|max:255',
            'response' => 'required|string',
            'type' => 'required|in:text,link,product_reference',
            'priority' => 'required|integer|min:1|max:10',
            'status' => 'required|in:active,inactive',
        ]);

        ChatbotRule::create($request->all());

        return redirect()->route('admin.chatbot.index')->with('success', 'Chatbot rule created successfully.');
    }

    public function show(ChatbotRule $chatbotRule)
    {
        return view('admin.chatbot.show', compact('chatbotRule'));
    }

    public function edit(ChatbotRule $chatbotRule)
    {
        return view('admin.chatbot.edit', compact('chatbotRule'));
    }

    public function update(Request $request, ChatbotRule $chatbotRule)
    {
        $request->validate([
            'keyword' => 'required|string|max:255',
            'response' => 'required|string',
            'type' => 'required|in:text,link,product_reference',
            'priority' => 'required|integer|min:1|max:10',
            'status' => 'required|in:active,inactive',
        ]);

        $chatbotRule->update($request->all());

        return redirect()->route('admin.chatbot.index')->with('success', 'Chatbot rule updated successfully.');
    }

    public function destroy(ChatbotRule $chatbotRule)
    {
        $chatbotRule->delete();
        return redirect()->route('admin.chatbot.index')->with('success', 'Chatbot rule deleted successfully.');
    }

    public function history()
    {
        $histories = ChatHistory::with('user')->orderBy('created_at', 'desc')->paginate(20);
        return view('admin.chatbot.history', compact('histories'));
    }
}