<div class="fixed bottom-4 right-4 z-50">
    <button wire:click="toggleChat"
            class="bg-indigo-600 hover:bg-indigo-700 text-white p-4 rounded-full shadow-lg transition duration-300 focus:outline-none">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                  d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.97 2.887a1 1 0 00-.364 1.118l1.519 4.674c.3.921-.755 1.688-1.54 1.118l-3.97-2.887a1 1 0 00-1.176 0l-3.97 2.887c-.784.57-1.838-.197-1.54-1.118l1.519-4.674a1 1 0 00-.364-1.118L2.012 9.4c-.783-.57-.38-1.81.588-1.81h4.915a1 1 0 00.95-.69l1.519-4.674z"></path>
        </svg>
    </button>

    <div x-show="$wire.isOpen"
         x-transition:enter="ease-out duration-300"
         x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
         x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
         x-transition:leave="ease-in duration-200"
         x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
         x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
         class="absolute bottom-16 right-0 w-80 h-96 bg-white rounded-lg shadow-xl flex flex-col overflow-hidden">

        <div class="bg-indigo-600 text-white p-3 flex justify-between items-center">
            <h3 class="text-lg font-semibold">HappyBot😁</h3>
            <button wire:click="toggleChat" class="text-white hover:text-indigo-200">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>

        <div id="chat-messages" class="flex-grow p-4 space-y-4 overflow-y-auto">
            @foreach ($messages as $message)
                @if ($message['role'] === 'bot')
                    <div class="flex justify-start">
                    <div class="bg-gray-100 rounded-lg p-3 max-w-xs text-sm" x-html>
                        @markdown($message['content'])
                    </div>
                    </div>
                @else
                    <div class="flex justify-end">
                        <div class="bg-indigo-500 text-white rounded-lg p-3 max-w-xs text-sm">{!! $message['content'] !!}</div>
                    </div>
                @endif
            @endforeach

            <div x-show="$wire.isTyping" class="flex justify-start">
                <div class="bg-gray-100 rounded-lg p-3 max-w-xs text-sm flex items-center space-x-2">
                    <span class="text-gray-500">Bot is typing</span>
                    <div class="flex space-x-1">
                        <div class="w-1.5 h-1.5 bg-gray-500 rounded-full animate-bounce delay-150"></div>
                        <div class="w-1.5 h-1.5 bg-gray-500 rounded-full animate-bounce delay-300"></div>
                        <div class="w-1.5 h-1.5 bg-gray-500 rounded-full animate-bounce delay-500"></div>
                    </div>
                </div>
            </div>

        </div>

        <div class="p-4 bg-gray-50 border-t border-gray-200">
            <div class="grid grid-cols-2 gap-2">
                @foreach ($currentOptions as $option)
                    <button wire:click="selectOption('{{ $option['next'] }}', '{{ $option['label'] }}')"
                            wire:loading.attr="disabled"
                            class="text-xs font-medium text-indigo-600 border border-indigo-300 rounded-full py-2 px-3 hover:bg-indigo-50 transition duration-150 disabled:opacity-50 disabled:cursor-not-allowed">
                        {{ $option['label'] }}
                    </button>
                @endforeach
            </div>
            @if(empty($currentOptions) && !$isTyping)
                <p class="text-xs text-gray-500 mt-2 text-center">Please select an option above to continue.</p>
            @endif
        </div>
    </div>
</div>

<script>
    document.addEventListener('livewire:initialized', () => {
        
        const componentId = @js($this->getId());

        Livewire.on('start-typing-delay', (event) => {
            const nextStep = event.nextStep;
            
            // Random delay between 2 and 5 seconds
            const minDuration = 2000; 
            const maxDuration = 5000;
            const duration = Math.floor(Math.random() * (maxDuration - minDuration + 1)) + minDuration;

            setTimeout(() => {
                Livewire.find(componentId).dispatch('process-response', { nextStep: nextStep });
            }, duration);
        });

        const scroll = () => {
             const chatWindow = document.getElementById('chat-messages');
             // Only scroll if the chat window is actually open
             if (chatWindow && document.querySelector('[x-show]').style.display !== 'none') {
                 chatWindow.scrollTop = chatWindow.scrollHeight;
             }
        };

        // Scroll when the chat contents are updated (e.g., new message appears)
        Livewire.hook('morph.updated', ({ component }) => {
             if (component.name === 'chatbot') {
                 scroll();
             }
        });

        Livewire.on('messages-updated', scroll);
        
        // Initial scroll check
        scroll();
    });
</script>