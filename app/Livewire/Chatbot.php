<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\On;

class Chatbot extends Component
{
    public bool $isOpen = false;
    public array $messages = [];
    public array $currentOptions = [];
    public bool $isTyping = false; 
    public function mount()
    {
        $this->addBotMessage($this->conversationFlow()['start']['text']);
        $this->currentOptions = $this->conversationFlow()['start']['options'];
    }

    public function toggleChat()
    {
        $this->isOpen = !$this->isOpen;
    }

    public function selectOption(string $nextStep, string $label): void
    {
        $this->messages[] = [
            'role' => 'user', 
            'content' => $label
        ];

        $this->currentOptions = []; 
        $this->isTyping = true; 

        $this->dispatch('start-typing-delay', nextStep: $nextStep); 
    }

    #[On('process-response')]
    public function processOption(string $nextStep): void
    {
        $this->isTyping = false;

        $flow = $this->conversationFlow();
        $step = $flow[$nextStep] ?? [
            'text' => "I'm not sure about that. Please contact support.", 
            'options' => $flow['start']['options']
        ];
        
        $this->addBotMessage($step['text']);
        
        $this->currentOptions = $step['options'] ?? [];
        
        $this->dispatch('messages-updated');
    }

    private function addBotMessage($text)
    {
        $this->messages[] = ['role' => 'bot', 'content' => $text];
    }

    // Conversation flow definitions
    private function conversationFlow(): array
    {
        return [
            'start' => [
                'text' => 'Hi there! Welcome to Happy HardWare 😁. How can I help you today?',
                'options' => [
                    ['label' => 'Where is my order?', 'next' => 'order_status'],
                    ['label' => 'Shipping & Returns', 'next' => 'shipping'],
                    ['label' => 'Product Questions', 'next' => 'products'],
                    ['label' => 'Contact Support', 'next' => 'contact'],
                ]
            ],
            'order_status' => [
                'text' => 'You can view your order history and status in your Profile dashboard. Would you like me to take you there?',
                'options' => [
                    ['label' => 'Yes, go to Profile', 'next' => 'redirect_profile'],
                    ['label' => 'No, something else', 'next' => 'start'],
                ]
            ],

            'redirect_profile' => [
                'text' => 'Click [**here**](/profile) to view your profile',
                'options' => [
                    ['label' => 'Back to start', 'next' => 'start'],
                ]
            ],
            'shipping' => [
                'text' => 'We offer standard (3-5 days) and express (1-2 days) shipping. Returns are accepted within 30 days.',
                'options' => [
                    ['label' => 'How much is shipping?', 'next' => 'shipping_cost'],
                    ['label' => 'Back to start', 'next' => 'start'],
                ]
            ],
            'shipping_cost' => [
                'text' => 'Standard shipping is £3.95. Express is £6.95. Some orders are free!',
                'options' => [
                    ['label' => 'Awesome, thanks!', 'next' => 'start'],
                ]
            ],
            'products' => [
                'text' => 'We sell the best PC components. You can browse by category in the store.',
                'options' => [
                    ['label' => 'Go back', 'next' => 'start'], 
                ],
            ],
            'contact' => [
                    'text' => 'You can reach our human team on our contact page [**here**](/contact).',   
                'options' => [
                    ['label' => 'Start Over', 'next' => 'start'],
                ]
            ]
        ];
    }

    public function render()
    {
        return view('livewire.chatbot');
    }
}