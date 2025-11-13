<div x-data="{ 
    open: false,
    messages: [
        { type: 'bot', text: 'Halo! Saya di sini untuk membantu Anda dengan informasi tentang produk dan layanan kami. Ada yang bisa saya bantu?' }
    ],
    input: '',
    loading: false
}" 
     class="fixed bottom-6 right-6 z-50">
    <!-- Chatbot Button -->
    <button @click="open = !open" 
            class="bg-gradient-to-r from-green-600 to-green-700 hover:from-green-700 hover:to-green-800 text-white rounded-full w-16 h-16 flex items-center justify-center cursor-pointer shadow-2xl hover:shadow-green-500/50 transition-all duration-300 transform hover:scale-110"
            :class="{ 'rotate-180': open }">
        <svg x-show="!open" class="w-8 h-8 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
        </svg>
        <svg x-show="open" class="w-6 h-6 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
        </svg>
    </button>

    <!-- Chatbot Window -->
    <div x-show="open"
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0 transform scale-95 translate-y-4"
         x-transition:enter-end="opacity-100 transform scale-100 translate-y-0"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100 transform scale-100 translate-y-0"
         x-transition:leave-end="opacity-0 transform scale-95 translate-y-4"
         class="absolute bottom-24 right-0 bg-white rounded-2xl shadow-2xl w-96 h-[500px] flex flex-col overflow-hidden border border-gray-200">
        
        <!-- Header -->
        <div class="bg-gradient-to-r from-green-600 to-green-700 text-white p-5">
            <div class="flex items-center justify-between">
                <div>
                    <h3 class="font-bold text-lg">PT Lestari Jaya Bangsa</h3>
                    <p class="text-sm opacity-90 mt-1">Customer Support</p>
                </div>
                <div class="w-3 h-3 bg-green-400 rounded-full animate-pulse"></div>
            </div>
        </div>

        <!-- Messages Area -->
        <div class="flex-1 p-4 overflow-y-auto space-y-4 bg-gray-50" id="chat-messages">
            <template x-for="(message, index) in messages" :key="index">
                <div :class="message.type === 'user' ? 'flex justify-end' : 'flex justify-start'">
                    <div :class="message.type === 'user' 
                        ? 'bg-gradient-to-r from-green-600 to-green-700 text-white rounded-2xl rounded-tr-sm px-4 py-2 max-w-[80%]' 
                        : 'bg-white text-gray-800 rounded-2xl rounded-tl-sm px-4 py-2 max-w-[80%] shadow-sm'">
                        <p class="text-sm" x-text="message.text"></p>
                    </div>
                </div>
            </template>
            
            <!-- Loading Indicator -->
            <div x-show="loading" class="flex justify-start">
                <div class="bg-white rounded-2xl rounded-tl-sm px-4 py-2 shadow-sm">
                    <div class="flex space-x-2">
                        <div class="w-2 h-2 bg-gray-400 rounded-full animate-bounce" style="animation-delay: 0s"></div>
                        <div class="w-2 h-2 bg-gray-400 rounded-full animate-bounce" style="animation-delay: 0.2s"></div>
                        <div class="w-2 h-2 bg-gray-400 rounded-full animate-bounce" style="animation-delay: 0.4s"></div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Input Area -->
        <div class="border-t border-gray-200 p-4 bg-white">
            <form @submit.prevent="
                if (!input.trim() || loading) return;
                messages.push({ type: 'user', text: input });
                const userMessage = input;
                input = '';
                loading = true;
                
                fetch('{{ route('chatbot.message') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name=\'csrf-token\']').getAttribute('content')
                    },
                    body: JSON.stringify({ message: userMessage })
                })
                .then(response => response.json())
                .then(data => {
                    loading = false;
                    messages.push({ type: 'bot', text: data.response || 'Maaf, terjadi kesalahan. Silakan coba lagi.' });
                    setTimeout(() => {
                        const chatMessages = document.getElementById('chat-messages');
                        if (chatMessages) chatMessages.scrollTop = chatMessages.scrollHeight;
                    }, 100);
                })
                .catch(error => {
                    loading = false;
                    messages.push({ type: 'bot', text: 'Maaf, terjadi kesalahan. Silakan coba lagi nanti.' });
                });
            " class="flex space-x-2">
                <input type="text" 
                       x-model="input"
                       placeholder="Ketik pesan Anda..."
                       class="flex-1 border border-gray-300 rounded-full px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent"
                       :disabled="loading">
                <button type="submit"
                        :disabled="!input.trim() || loading"
                        class="bg-gradient-to-r from-green-600 to-green-700 text-white px-5 py-2 rounded-full hover:from-green-700 hover:to-green-800 disabled:opacity-50 disabled:cursor-not-allowed transition-all duration-200 shadow-md hover:shadow-lg">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
                    </svg>
                </button>
            </form>
        </div>
    </div>
</div>
