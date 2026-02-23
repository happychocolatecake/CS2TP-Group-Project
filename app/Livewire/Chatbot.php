<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class Chatbot extends Component
{
    public bool $isOpen = false;
    public array $messages = [];
    public string $userInput = ''; // Holds the user's typed message
    public bool $isTyping = false;

    public function mount()
    {
        // Add the initial greeting
        $this->messages[] = [
            'role' => 'assistant',
            'content' => 'Hi there! Welcome to Happy HardWare 😁. How can I help you today?'
        ];
    }

    public function toggleChat()
    {
        $this->isOpen = !$this->isOpen;
    }

    public function sendMessage()
    {
        // Don't send empty messages
        if (trim($this->userInput) === '') {
            return;
        }

        // 1. Add the user's message to the chat array
        $this->messages[] = [
            'role' => 'user',
            'content' => $this->userInput
        ];

        // 2. Clear the input field and trigger typing state
        $this->userInput = '';
        $this->isTyping = true;

        // Render the view with the user message before blocking for the API call
        // In Livewire 3, you can use stream() or just rely on standard request lifecycle.
        $this->callDeepSeekAPI();
    }

    private function callDeepSeekAPI()
    {
        // Provide the AI with context about your business
        $systemPrompt = [
            'role' => 'system',
            'content' => "You are a helpful, friendly customer support bot for 'Happy HardWare'.
            Keep your answers concise and conversational.
            Here is your knowledge base:
            - You sell the best PC components.
            - Users can view order history in their profile at the URL '/profile'.
            - Standard shipping (3-5 days) is £3.95.
            - Express shipping (1-2 days) is £6.95.
            - Returns are accepted within 30 days.
            - If a user needs human support, direct them to the contact page at the URL '/contact'.
            - If a user asks something completely unrelated to PC hardware or your policies, politely decline to answer."
        ];

        // DeepSeek API expects an array of messages starting with the system prompt,
        // followed by the conversation history to maintain context.
        $apiMessages = array_merge([$systemPrompt], $this->messages);

        try {
            $response = Http::withToken(config('services.deepseek.api_key'))
            ->timeout(15) // Prevent hanging if the API is slow
            ->post('https://api.deepseek.com/chat/completions', [
                'model' => 'deepseek-chat',
                'messages' => $apiMessages,
                'temperature' => 0.7, // Adjusts creativity (0.7 is good for chatbots)
            ]);

            if ($response->successful()) {
                $reply = $response->json('choices.0.message.content');
                $this->messages[] = ['role' => 'assistant', 'content' => $reply];
            } else {
                Log::error('DeepSeek API Error', $response->json());
                $this->messages[] = ['role' => 'assistant', 'content' => 'Sorry, I am having trouble connecting to my servers right now. Please try again later.'];
            }
        } catch (\Exception $e) {
            Log::error('Chatbot Exception: ' . $e->getMessage());
            $this->messages[] = ['role' => 'assistant', 'content' => 'An error occurred. Please try again.'];
        }

        $this->isTyping = false;

        // Tell the frontend to scroll to the bottom of the chat
        $this->dispatch('messages-updated');
    }

    public function render()
    {
        return view('livewire.chatbot');
    }
}
