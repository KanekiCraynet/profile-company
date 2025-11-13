<div x-data="{
         open: false,
         messages: [],
         isLoading: false
     }"
     x-init="
         $watch('open', (value) => {
             if (value && messages.length === 0) {
                 messages.push({
                     type: 'bot',
                     text: 'Halo! Ada yang bisa saya bantu?',
                     time: new Date().toLocaleTimeString('id-ID', { hour: '2-digit', minute: '2-digit' })
                 });
             }
         });
     "
     class="fixed bottom-6 right-6 z-50"
     id="chatbot-widget">

    <!-- Chat Window -->
    <div x-show="open"
         x-cloak
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0 scale-95"
         x-transition:enter-end="opacity-100 scale-100"
         class="bg-white rounded-lg shadow-xl w-80 h-96 flex flex-col mb-4 border">

        <!-- Header -->
        <div class="bg-primary-600 text-white p-4 flex justify-between items-center">
            <h3 class="font-semibold">Chat Assistant</h3>
            <button @click="open = false" class="text-white hover:text-gray-200">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>

        <!-- Messages -->
        <div class="flex-1 p-4 overflow-y-auto">
            <template x-for="(message, index) in messages" :key="index">
                <div :class="message.type === 'user' ? 'flex justify-end' : 'flex justify-start'" class="mb-3">
                    <div :class="message.type === 'user'
                        ? 'bg-primary-600 text-white'
                        : 'bg-gray-200 text-gray-800'"
                        class="rounded-lg px-3 py-2 max-w-[80%]">
                        <p class="text-sm" x-text="message.text"></p>
                        <span class="text-xs opacity-70" x-text="message.time"></span>
                    </div>
                </div>
            </template>

            <div x-show="isLoading" class="flex justify-start">
                <div class="bg-gray-200 rounded-lg px-3 py-2">
                    <div class="flex space-x-1">
                        <div class="w-2 h-2 bg-gray-400 rounded-full animate-bounce"></div>
                        <div class="w-2 h-2 bg-gray-400 rounded-full animate-bounce" style="animation-delay: 0.2s"></div>
                        <div class="w-2 h-2 bg-gray-400 rounded-full animate-bounce" style="animation-delay: 0.4s"></div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Input -->
        <div class="p-4 border-t">
            <form @submit.prevent="
                if ($refs.messageInput.value.trim()) {
                    const userMessage = $refs.messageInput.value.trim();
                    messages.push({
                        type: 'user',
                        text: userMessage,
                        time: new Date().toLocaleTimeString('id-ID', { hour: '2-digit', minute: '2-digit' })
                    });
                    $refs.messageInput.value = '';
                    isLoading = true;

                    // Simulate bot response
                    setTimeout(() => {
                        isLoading = false;
                        messages.push({
                            type: 'bot',
                            text: 'Terima kasih atas pesan Anda. Saya akan segera membantu.',
                            time: new Date().toLocaleTimeString('id-ID', { hour: '2-digit', minute: '2-digit' })
                        });
                    }, 1000);
                }
            " class="flex space-x-2">
                <input x-ref="messageInput"
                       type="text"
                       placeholder="Ketik pesan..."
                       class="flex-1 px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-500">
                <button type="submit"
                        :disabled="isLoading"
                        class="bg-primary-600 text-white px-4 py-2 rounded-lg hover:bg-primary-700 disabled:opacity-50">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
                    </svg>
                </button>
            </form>
        </div>
    </div>

    <!-- Chat Button -->
    <button @click="open = !open"
            class="bg-primary-600 hover:bg-primary-700 text-white rounded-full w-14 h-14 flex items-center justify-center shadow-lg transition">
        <svg x-show="!open" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
        </svg>
        <svg x-show="open" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
        </svg>
    </button>
</div>

<style>
    [x-cloak] { display: none !important; }
</style>