<div x-data="{ open: false, messages: [], isLoading: false }" 
     class="fixed bottom-6 right-6 z-50"
     id="chatbot-widget">
    
    <!-- Chatbot Window -->
    <div x-show="open"
         x-cloak
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0 transform translate-y-4 scale-95"
         x-transition:enter-end="opacity-100 transform translate-y-0 scale-100"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100 transform translate-y-0 scale-100"
         x-transition:leave-end="opacity-0 transform translate-y-4 scale-95"
         class="bg-white dark:bg-neutral-800 rounded-2xl shadow-2xl w-80 h-[500px] md:w-96 md:h-[600px] flex flex-col overflow-hidden border border-neutral-200 dark:border-neutral-700">
        
        <!-- Header -->
        <div class="bg-gradient-to-r from-primary-600 to-primary-700 text-white p-4 flex items-center justify-between">
            <div class="flex items-center space-x-3">
                <div class="w-10 h-10 bg-white/20 rounded-full flex items-center justify-center">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                    </svg>
                </div>
                <div>
                    <h3 class="font-heading font-semibold text-sm">PT Lestari Jaya Bangsa</h3>
                    <p class="text-xs text-primary-100">Kami siap membantu Anda</p>
                </div>
            </div>
            <button @click="open = false" 
                    class="text-white/80 hover:text-white transition-colors p-1 rounded-lg hover:bg-white/10"
                    aria-label="Close chat">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>

        <!-- Messages Container -->
        <div class="flex-1 p-4 overflow-y-auto space-y-4 bg-neutral-50 dark:bg-neutral-900/50" 
             x-ref="messagesContainer">
            <template x-for="(message, index) in messages" :key="index">
                <div :class="message.type === 'user' ? 'flex justify-end' : 'flex justify-start'">
                    <div :class="message.type === 'user' 
                        ? 'bg-primary-600 text-white rounded-2xl rounded-tr-sm px-4 py-2 max-w-[80%]' 
                        : 'bg-white dark:bg-neutral-800 text-neutral-900 dark:text-neutral-100 rounded-2xl rounded-tl-sm px-4 py-2 max-w-[80%] shadow-sm'">
                        <p class="text-sm" x-text="message.text"></p>
                        <span class="text-xs opacity-70 mt-1 block" x-text="message.time"></span>
                    </div>
                </div>
            </template>
            
            <!-- Loading Indicator -->
            <div x-show="isLoading" class="flex justify-start">
                <div class="bg-white dark:bg-neutral-800 rounded-2xl rounded-tl-sm px-4 py-2 shadow-sm">
                    <div class="flex space-x-1">
                        <div class="w-2 h-2 bg-neutral-400 rounded-full animate-bounce" style="animation-delay: 0s"></div>
                        <div class="w-2 h-2 bg-neutral-400 rounded-full animate-bounce" style="animation-delay: 0.2s"></div>
                        <div class="w-2 h-2 bg-neutral-400 rounded-full animate-bounce" style="animation-delay: 0.4s"></div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Input Area -->
        <div class="border-t border-neutral-200 dark:border-neutral-700 p-4 bg-white dark:bg-neutral-800">
            <form @submit.prevent="
                if ($refs.messageInput.value.trim()) {
                    const userMessage = $refs.messageInput.value.trim();
                    messages.push({ type: 'user', text: userMessage, time: new Date().toLocaleTimeString('id-ID', { hour: '2-digit', minute: '2-digit' }) });
                    $refs.messageInput.value = '';
                    $refs.messagesContainer.scrollTop = $refs.messagesContainer.scrollHeight;
                    isLoading = true;
                    
                    fetch('{{ route('chatbot.message') }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name=csrf-token]').content
                        },
                        body: JSON.stringify({ message: userMessage })
                    })
                    .then(response => response.json())
                    .then(data => {
                        isLoading = false;
                        messages.push({ type: 'bot', text: data.response || data.message || 'Maaf, terjadi kesalahan. Silakan coba lagi.', time: new Date().toLocaleTimeString('id-ID', { hour: '2-digit', minute: '2-digit' }) });
                        setTimeout(() => $refs.messagesContainer.scrollTop = $refs.messagesContainer.scrollHeight, 100);
                    })
                    .catch(error => {
                        isLoading = false;
                        messages.push({ type: 'bot', text: 'Maaf, terjadi kesalahan. Silakan coba lagi.', time: new Date().toLocaleTimeString('id-ID', { hour: '2-digit', minute: '2-digit' }) });
                    });
                }
            " class="flex space-x-2">
                <input 
                    type="text" 
                    x-ref="messageInput"
                    placeholder="Ketik pesan Anda..."
                    class="flex-1 px-4 py-2 border border-neutral-300 dark:border-neutral-600 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary-500 dark:bg-neutral-700 dark:text-neutral-100 text-sm"
                    autocomplete="off">
                <button 
                    type="submit"
                    class="btn btn-primary px-4 py-2 rounded-xl"
                    :disabled="isLoading">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
                    </svg>
                </button>
            </form>
        </div>
    </div>

    <!-- Chatbot Button -->
    <button 
        @click="open = !open; if (open && messages.length === 0) { messages.push({ type: 'bot', text: 'Halo! Saya di sini untuk membantu Anda dengan informasi tentang produk dan layanan kami. Ada yang bisa saya bantu?', time: new Date().toLocaleTimeString('id-ID', { hour: '2-digit', minute: '2-digit' }) }); }"
        class="bg-gradient-to-r from-primary-600 to-primary-700 hover:from-primary-700 hover:to-primary-800 text-white rounded-full w-16 h-16 md:w-20 md:h-20 flex items-center justify-center cursor-pointer shadow-2xl hover:shadow-primary-500/50 transform hover:scale-110 transition-all duration-300 pulse-ring"
        aria-label="Open chat">
        <svg x-show="!open" class="w-8 h-8 md:w-10 md:h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
        </svg>
        <svg x-show="open" class="w-8 h-8 md:w-10 md:h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
        </svg>
    </button>
</div>

<style>
    [x-cloak] { display: none !important; }
</style>

