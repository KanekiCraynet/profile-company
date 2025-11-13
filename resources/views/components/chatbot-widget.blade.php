<!-- Modern Enhanced Chatbot Widget Component -->
<div id="chatbot-widget" 
     class="fixed bottom-6 right-6 z-50"
     x-data="chatbotWidget()"
     x-init="init()">
    
    <!-- Notification Badge -->
    <div x-show="unreadCount > 0 && !open" 
         class="absolute -top-1 -right-1 bg-red-500 text-white text-xs font-bold rounded-full w-6 h-6 flex items-center justify-center shadow-lg animate-pulse">
        <span x-text="unreadCount > 9 ? '9+' : unreadCount"></span>
    </div>

    <!-- Chatbot Button -->
    <button id="chatbot-button" 
            @click="toggleChat()"
            :class="open ? 'bg-red-500 hover:bg-red-600 rotate-90' : 'bg-green-600 hover:bg-green-700'"
            class="text-white rounded-full w-16 h-16 flex items-center justify-center cursor-pointer shadow-2xl transition-all duration-300 transform hover:scale-110 active:scale-95 flex-shrink-0 relative overflow-hidden group"
            aria-label="Open chat">
        
        <!-- Button Background Animation -->
        <div class="absolute inset-0 bg-gradient-to-br from-green-400 to-green-600 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
        
        <!-- Chat Icon -->
        <svg x-show="!open" 
             class="w-8 h-8 relative z-10 transition-all duration-300" 
             fill="none" 
             stroke="currentColor" 
             viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
        </svg>
        
        <!-- Close Icon -->
        <svg x-show="open" 
             class="w-8 h-8 relative z-10 transition-all duration-300" 
             fill="none" 
             stroke="currentColor" 
             viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
        </svg>
    </button>

    <!-- Chatbot Window -->
    <div x-show="open" 
         x-cloak
         @click.away="if (!clickInside) { open = false }"
         @click="clickInside = true"
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0 transform scale-95 translate-y-4"
         x-transition:enter-end="opacity-100 transform scale-100 translate-y-0"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100 transform scale-100 translate-y-0"
         x-transition:leave-end="opacity-0 transform scale-95 translate-y-4"
         class="absolute bottom-20 right-0 bg-white rounded-2xl shadow-2xl w-96 h-[600px] flex flex-col overflow-hidden border border-gray-200 backdrop-blur-sm"
         style="display: none;">
        
        <!-- Header -->
        <div class="bg-gradient-to-r from-green-600 via-green-700 to-green-600 text-white p-5 relative overflow-hidden">
            <!-- Pattern Background -->
            <div class="absolute inset-0 opacity-10">
                <div class="absolute inset-0" style="background-image: url('data:image/svg+xml,<svg width=\"40\" height=\"40\" xmlns=\"http://www.w3.org/2000/svg\"><circle cx=\"20\" cy=\"20\" r=\"2\" fill=\"white\"/></svg>');"></div>
            </div>
            
            <div class="flex items-center justify-between relative z-10">
                <div class="flex items-center space-x-3">
                    <!-- Avatar -->
                    <div class="w-10 h-10 bg-white/20 rounded-full flex items-center justify-center backdrop-blur-sm">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                        </svg>
                    </div>
                <div>
                        <h3 class="font-bold text-lg font-heading">PT Lestari Jaya Bangsa</h3>
                        <p class="text-xs opacity-90 flex items-center">
                            <span class="w-2 h-2 bg-green-300 rounded-full mr-2 animate-pulse"></span>
                            Online
                        </p>
                    </div>
                </div>
                <div class="flex items-center space-x-2">
                    <!-- Minimize Button -->
                    <button @click="open = false" 
                            class="text-white/80 hover:text-white transition-colors p-1.5 rounded-lg hover:bg-white/20">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"/>
                    </svg>
                </button>
                </div>
            </div>
        </div>

        <!-- Messages Container -->
        <div id="chat-messages" 
             x-ref="messagesContainer"
             class="flex-1 p-4 overflow-y-auto space-y-4 bg-gradient-to-b from-gray-50 to-white"
             style="scroll-behavior: smooth;">
            
            <!-- Welcome Message -->
            <div class="flex items-start space-x-2">
                <div class="w-8 h-8 bg-green-100 rounded-full flex items-center justify-center flex-shrink-0">
                    <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                    </svg>
                </div>
                <div class="flex-1">
                    <div class="bg-white rounded-2xl rounded-tl-none shadow-md p-4 border border-gray-100">
                        <p class="text-sm text-gray-700 leading-relaxed">
                            Halo! 👋 Saya siap membantu Anda dengan informasi tentang produk dan layanan kami. 
                            Ada yang bisa saya bantu?
                        </p>
                    </div>
                    <div class="mt-2 text-xs text-gray-400">
                        <time x-text="getCurrentTime()"></time>
                    </div>
                </div>
            </div>

            <!-- Quick Reply Buttons -->
            <div class="flex flex-wrap gap-2 px-10">
                <button @click="sendQuickReply('Apa saja produk yang tersedia?')"
                        class="bg-green-50 hover:bg-green-100 text-green-700 text-xs px-3 py-2 rounded-full border border-green-200 transition-all duration-200 transform hover:scale-105">
                    📦 Produk
                </button>
                <button @click="sendQuickReply('Bagaimana cara menghubungi?')"
                        class="bg-green-50 hover:bg-green-100 text-green-700 text-xs px-3 py-2 rounded-full border border-green-200 transition-all duration-200 transform hover:scale-105">
                    📞 Kontak
                </button>
                <button @click="sendQuickReply('Dimana lokasi perusahaan?')"
                        class="bg-green-50 hover:bg-green-100 text-green-700 text-xs px-3 py-2 rounded-full border border-green-200 transition-all duration-200 transform hover:scale-105">
                    📍 Lokasi
                </button>
            </div>
        </div>

        <!-- Typing Indicator -->
        <div x-show="isTyping" 
             x-cloak
             class="px-4 pb-2">
            <div class="flex items-center space-x-2 px-4">
                <div class="w-8 h-8 bg-green-100 rounded-full flex items-center justify-center">
                    <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                    </svg>
                </div>
                <div class="bg-white rounded-2xl rounded-tl-none shadow-md p-3 border border-gray-100">
                    <div class="flex space-x-1">
                        <div class="w-2 h-2 bg-gray-400 rounded-full animate-bounce" style="animation-delay: 0ms;"></div>
                        <div class="w-2 h-2 bg-gray-400 rounded-full animate-bounce" style="animation-delay: 150ms;"></div>
                        <div class="w-2 h-2 bg-gray-400 rounded-full animate-bounce" style="animation-delay: 300ms;"></div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Input Area -->
        <div class="border-t border-gray-200 p-4 bg-white">
            <div class="flex items-end space-x-2">
                <div class="flex-1 relative">
                    <textarea id="chat-input" 
                              x-ref="chatInput"
                              @keydown.enter.exact.prevent="sendMessage()"
                              @keydown.enter.shift.exact="event.preventDefault(); $refs.chatInput.value += '\n';"
                              @input="adjustTextareaHeight()"
                              placeholder="Ketik pesan Anda..."
                              rows="1"
                              class="w-full border border-gray-300 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent transition-all resize-none max-h-32 overflow-y-auto"
                              style="min-height: 48px;"></textarea>
                </div>
                <button id="send-message" 
                        @click="sendMessage()"
                        :disabled="isSending || !messageText.trim()"
                        :class="isSending || !messageText.trim() ? 'opacity-50 cursor-not-allowed' : 'hover:bg-green-700 hover:scale-110'"
                        class="bg-green-600 text-white px-4 py-3 rounded-xl transition-all duration-200 transform active:scale-95 flex-shrink-0 shadow-md disabled:opacity-50 disabled:cursor-not-allowed">
                    <svg x-show="!isSending" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
                    </svg>
                    <svg x-show="isSending" class="w-5 h-5 animate-spin" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                </button>
            </div>
            <p class="text-xs text-gray-400 mt-2 text-center">
                Tekan Enter untuk mengirim, Shift+Enter untuk baris baru
            </p>
        </div>
    </div>
</div>

<script>
function chatbotWidget() {
    return {
        open: false,
        isTyping: false,
        isSending: false,
        messageText: '',
        unreadCount: 0,
        clickInside: false,
        
        init() {
            // Check for unread messages
            this.checkUnreadMessages();
            
            // Auto-focus input when chat opens
            this.$watch('open', (value) => {
                if (value) {
                    this.$nextTick(() => {
                        this.$refs.chatInput?.focus();
                        this.unreadCount = 0;
                    });
                } else {
                    this.clickInside = false;
                }
            });
            
            // Initialize message text watcher
            this.$watch('messageText', (value) => {
                this.messageText = value;
            });
        },
        
        toggleChat() {
            this.open = !this.open;
            if (this.open) {
                this.unreadCount = 0;
                this.scrollToBottom();
            }
        },
        
        getCurrentTime() {
            const now = new Date();
            return now.toLocaleTimeString('id-ID', { hour: '2-digit', minute: '2-digit' });
        },
        
        adjustTextareaHeight() {
            const textarea = this.$refs.chatInput;
            if (textarea) {
                textarea.style.height = 'auto';
                textarea.style.height = Math.min(textarea.scrollHeight, 128) + 'px';
            }
        },
        
        sendQuickReply(message) {
            this.$refs.chatInput.value = message;
            this.messageText = message;
            this.sendMessage();
        },
        
        sendMessage() {
            const input = this.$refs.chatInput;
            const message = input?.value.trim();
            
            if (!message || this.isSending) return;
            
            this.isSending = true;
            this.messageText = '';

        // Add user message
            this.addMessage(message, 'user');
            input.value = '';
            this.adjustTextareaHeight();
            
            // Show typing indicator
            this.isTyping = true;
            this.scrollToBottom();

        // Get or create session ID
        let sessionId = localStorage.getItem('chatbot_session_id');
        if (!sessionId) {
            sessionId = 'chat_' + Date.now() + '_' + Math.random().toString(36).substr(2, 9);
            localStorage.setItem('chatbot_session_id', sessionId);
        }

            // Send to backend
        fetch('{{ route("chatbot.message") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content')
            },
            body: JSON.stringify({ 
                message: message,
                session_id: sessionId
            })
        })
        .then(response => response.json())
        .then(data => {
                this.isTyping = false;
                this.isSending = false;
            
            if (data.success) {
                    this.addMessage(data.response, 'bot');
                if (data.session_id) {
                    localStorage.setItem('chatbot_session_id', data.session_id);
                }
            } else {
                    this.addMessage(data.response || 'Maaf, terjadi kesalahan. Silakan coba lagi.', 'bot', true);
            }
        })
        .catch(error => {
                this.isTyping = false;
                this.isSending = false;
                this.addMessage('Maaf, terjadi kesalahan. Silakan coba lagi atau hubungi kami langsung.', 'bot', true);
            });
        },
        
        addMessage(text, sender, isError = false) {
            const container = this.$refs.messagesContainer;
            if (!container) return;
            
        const messageDiv = document.createElement('div');
            const time = this.getCurrentTime();
            
            if (sender === 'user') {
                messageDiv.className = 'flex items-start space-x-2 justify-end';
                messageDiv.innerHTML = `
                    <div class="flex-1 max-w-xs">
                        <div class="bg-green-600 text-white rounded-2xl rounded-tr-none shadow-md p-4 ml-auto">
                            <p class="text-sm leading-relaxed">${this.escapeHtml(text)}</p>
                        </div>
                        <div class="mt-1 text-xs text-gray-400 text-right">
                            <time>${time}</time>
                        </div>
                    </div>
                    <div class="w-8 h-8 bg-green-600 rounded-full flex items-center justify-center flex-shrink-0">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                        </svg>
                    </div>
                `;
            } else {
                messageDiv.className = 'flex items-start space-x-2';
                const bgColor = isError ? 'bg-red-50 border-red-200' : 'bg-white border-gray-100';
                const textColor = isError ? 'text-red-700' : 'text-gray-700';
                messageDiv.innerHTML = `
                    <div class="w-8 h-8 bg-green-100 rounded-full flex items-center justify-center flex-shrink-0">
                        <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                        </svg>
                    </div>
                    <div class="flex-1">
                        <div class="${bgColor} rounded-2xl rounded-tl-none shadow-md p-4 border ${textColor}">
                            <p class="text-sm leading-relaxed">${this.escapeHtml(text)}</p>
                        </div>
                        <div class="mt-1 text-xs text-gray-400">
                            <time>${time}</time>
                        </div>
                    </div>
                `;
            }
            
            container.appendChild(messageDiv);
            this.scrollToBottom();
            
            // Add animation
            messageDiv.style.opacity = '0';
            messageDiv.style.transform = sender === 'user' ? 'translateX(20px)' : 'translateX(-20px)';
            setTimeout(() => {
                messageDiv.style.transition = 'all 0.3s ease-out';
                messageDiv.style.opacity = '1';
                messageDiv.style.transform = 'translateX(0)';
            }, 10);
        },
        
        escapeHtml(text) {
            const div = document.createElement('div');
            div.textContent = text;
            return div.innerHTML;
        },
        
        scrollToBottom() {
            this.$nextTick(() => {
                const container = this.$refs.messagesContainer;
                if (container) {
                    container.scrollTo({
                        top: container.scrollHeight,
                        behavior: 'smooth'
                    });
                }
            });
        },
        
        checkUnreadMessages() {
            // Check for unread messages when chat is closed
            if (!this.open && this.unreadCount === 0) {
                // This could be enhanced with actual unread message detection
            }
        }
    }
}
</script>

<style>
[x-cloak] { display: none !important; }

/* Custom Scrollbar */
#chat-messages::-webkit-scrollbar {
    width: 6px;
}

#chat-messages::-webkit-scrollbar-track {
    background: transparent;
}

#chat-messages::-webkit-scrollbar-thumb {
    background: #cbd5e1;
    border-radius: 3px;
}

#chat-messages::-webkit-scrollbar-thumb:hover {
    background: #94a3b8;
}

/* Smooth animations */
@keyframes slideInRight {
    from {
        opacity: 0;
        transform: translateX(20px);
    }
    to {
        opacity: 1;
        transform: translateX(0);
    }
}

@keyframes slideInLeft {
    from {
        opacity: 0;
        transform: translateX(-20px);
    }
    to {
        opacity: 1;
        transform: translateX(0);
    }
}

/* Mobile responsiveness */
@media (max-width: 640px) {
    #chatbot-widget {
        bottom: 1rem;
        right: 1rem;
    }
    
    #chatbot-widget > div[x-show] {
        width: calc(100vw - 2rem);
        max-width: 400px;
        height: calc(100vh - 120px);
        max-height: 600px;
    }
}
</style>
