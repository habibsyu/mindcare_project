@extends('layouts.app')

@section('title', '- Chat Konseling')

@section('content')
<div class="min-h-screen transition-colors duration-300"
     :class="{ 'bg-gray-50': !darkMode, 'bg-gray-900': darkMode }"
     x-data="chatApp()">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        
        <!-- Chat Header -->
        <div class="rounded-t-2xl p-4 transition-colors duration-300"
             :class="{ 'bg-white border-b border-gray-200': !darkMode, 'bg-gray-800 border-b border-gray-700': darkMode }">
            <div class="flex items-center justify-between">
                <div class="flex items-center">
                    <div class="w-10 h-10 rounded-full mr-3 flex items-center justify-center transition-colors duration-300"
                         :class="{ 'bg-blue-100': !darkMode, 'bg-blue-900': darkMode }">
                        <i class="fas fa-{{ $session->isAiMode() ? 'robot' : 'user-md' }} text-blue-600"></i>
                    </div>
                    <div>
                        <h2 class="font-semibold transition-colors duration-300"
                            :class="{ 'text-gray-900': !darkMode, 'text-white': darkMode }">
                            {{ $session->isAiMode() ? 'AI Counselor' : 'Human Counselor' }}
                        </h2>
                        <p class="text-sm transition-colors duration-300"
                           :class="{ 'text-gray-500': !darkMode, 'text-gray-400': darkMode }">
                            {{ $session->isAiMode() ? 'Chatbot MindCare' : ($session->staff->name ?? 'Konselor Professional') }}
                        </p>
                    </div>
                </div>
                
                <div class="flex items-center space-x-2">
                    <div class="flex items-center">
                        <div class="w-3 h-3 bg-green-500 rounded-full mr-2 animate-pulse"></div>
                        <span class="text-sm font-medium text-green-600">Online</span>
                    </div>
                    
                    <button @click="showEndSessionModal = true" 
                            class="p-2 rounded-lg transition-colors duration-200"
                            :class="{ 'text-red-600 hover:bg-red-50': !darkMode, 'text-red-400 hover:bg-red-900/20': darkMode }">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Chat Messages -->
        <div class="h-96 overflow-y-auto p-4 space-y-4 transition-colors duration-300"
             :class="{ 'bg-gray-50': !darkMode, 'bg-gray-800': darkMode }"
             id="chatMessages">
            @foreach($session->messages as $message)
            <div class="flex {{ $message['type'] === 'user' ? 'justify-end' : ($message['type'] === 'system' ? 'justify-center' : 'justify-start') }}">
                <div class="chat-bubble {{ $message['type'] }}">
                    {{ $message['content'] }}
                    <div class="text-xs opacity-70 mt-1">
                        {{ \Carbon\Carbon::parse($message['timestamp'])->format('H:i') }}
                    </div>
                </div>
            </div>
            @endforeach
            
            <!-- Typing indicator -->
            <div x-show="isTyping" class="flex justify-start">
                <div class="chat-bubble bot">
                    <div class="flex space-x-1">
                        <div class="w-2 h-2 bg-gray-400 rounded-full animate-bounce"></div>
                        <div class="w-2 h-2 bg-gray-400 rounded-full animate-bounce" style="animation-delay: 0.1s;"></div>
                        <div class="w-2 h-2 bg-gray-400 rounded-full animate-bounce" style="animation-delay: 0.2s;"></div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Human Transfer Prompt -->
        <div x-show="showTransferPrompt" 
             class="p-4 border-t transition-colors duration-300"
             :class="{ 'bg-yellow-50 border-yellow-200': !darkMode, 'bg-yellow-900/20 border-yellow-800': darkMode }">
            <div class="flex items-center justify-between">
                <div class="flex items-center">
                    <i class="fas fa-exclamation-triangle text-yellow-600 mr-3"></i>
                    <span class="text-sm font-medium transition-colors duration-300"
                          :class="{ 'text-yellow-800': !darkMode, 'text-yellow-200': darkMode }">
                        Apakah Anda ingin terhubung dengan konselor manusia?
                    </span>
                </div>
                <div class="flex space-x-2">
                    <button @click="requestHumanTransfer" 
                            class="px-4 py-2 bg-green-600 text-white rounded-lg text-sm hover:bg-green-700 transition-colors duration-200">
                        Ya, Hubungkan
                    </button>
                    <button @click="showTransferPrompt = false" 
                            class="px-4 py-2 text-sm rounded-lg transition-colors duration-200"
                            :class="{ 'bg-gray-200 text-gray-700 hover:bg-gray-300': !darkMode, 'bg-gray-700 text-gray-300 hover:bg-gray-600': darkMode }">
                        Tidak
                    </button>
                </div>
            </div>
        </div>

        <!-- Message Input -->
        <div class="rounded-b-2xl p-4 transition-colors duration-300"
             :class="{ 'bg-white border-t border-gray-200': !darkMode, 'bg-gray-800 border-t border-gray-700': darkMode }">
            <form @submit.prevent="sendMessage" class="flex space-x-4">
                <input type="text" 
                       x-model="newMessage"
                       placeholder="Ketik pesan Anda..."
                       class="flex-1 px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-300"
                       :class="{ 'border-gray-300 bg-white text-gray-900': !darkMode, 'border-gray-600 bg-gray-700 text-white': darkMode }"
                       :disabled="isSending">
                
                <button type="submit" 
                        :disabled="!newMessage.trim() || isSending"
                        class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 disabled:opacity-50 disabled:cursor-not-allowed transition-colors duration-200">
                    <i class="fas fa-paper-plane" x-show="!isSending"></i>
                    <i class="fas fa-spinner fa-spin" x-show="isSending"></i>
                </button>
            </form>
            
            @if($session->isAiMode())
            <div class="mt-2 text-center">
                <button @click="showTransferPrompt = true" 
                        class="text-sm text-blue-600 hover:text-blue-700 transition-colors duration-200">
                    Butuh bantuan konselor manusia?
                </button>
            </div>
            @endif
        </div>
    </div>

    <!-- End Session Modal -->
    <div x-show="showEndSessionModal" 
         class="fixed inset-0 z-50 overflow-y-auto" 
         x-cloak>
        <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <div x-show="showEndSessionModal" 
                 x-transition:enter="ease-out duration-300"
                 x-transition:enter-start="opacity-0"
                 x-transition:enter-end="opacity-100"
                 class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"></div>

            <div x-show="showEndSessionModal" 
                 x-transition:enter="ease-out duration-300"
                 x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                 x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                 class="inline-block align-bottom rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full"
                 :class="{ 'bg-white': !darkMode, 'bg-gray-800': darkMode }">
                
                <div class="px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <div class="sm:flex sm:items-start">
                        <div class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-red-100 sm:mx-0 sm:h-10 sm:w-10">
                            <i class="fas fa-exclamation-triangle text-red-600"></i>
                        </div>
                        <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                            <h3 class="text-lg leading-6 font-medium transition-colors duration-300"
                                :class="{ 'text-gray-900': !darkMode, 'text-white': darkMode }">
                                Akhiri Sesi Konseling
                            </h3>
                            <div class="mt-2">
                                <p class="text-sm transition-colors duration-300"
                                   :class="{ 'text-gray-500': !darkMode, 'text-gray-400': darkMode }">
                                    Apakah Anda yakin ingin mengakhiri sesi konseling ini? 
                                    Anda dapat memberikan rating dan feedback setelah sesi berakhir.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                    <button @click="endSession" 
                            class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-red-600 text-base font-medium text-white hover:bg-red-700 sm:ml-3 sm:w-auto sm:text-sm">
                        Akhiri Sesi
                    </button>
                    <button @click="showEndSessionModal = false" 
                            class="mt-3 w-full inline-flex justify-center rounded-md border shadow-sm px-4 py-2 text-base font-medium sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm transition-colors duration-300"
                            :class="{ 'border-gray-300 bg-white text-gray-700 hover:bg-gray-50': !darkMode, 'border-gray-600 bg-gray-700 text-gray-300 hover:bg-gray-600': darkMode }">
                        Batal
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function chatApp() {
    return {
        newMessage: '',
        isSending: false,
        isTyping: false,
        showTransferPrompt: false,
        showEndSessionModal: false,
        
        async sendMessage() {
            if (!this.newMessage.trim() || this.isSending) return;
            
            const message = this.newMessage.trim();
            this.newMessage = '';
            this.isSending = true;
            this.isTyping = true;
            
            // Add user message to chat
            this.addMessageToChat('user', message);
            
            try {
                const response = await fetch(`/counseling/chat/{{ $session->session_id }}/message`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    },
                    body: JSON.stringify({ message: message })
                });
                
                const data = await response.json();
                
                if (data.message) {
                    this.addMessageToChat('bot', data.message.content);
                }
                
                if (data.needs_human) {
                    this.showTransferPrompt = true;
                }
                
            } catch (error) {
                console.error('Error sending message:', error);
                this.addMessageToChat('system', 'Terjadi kesalahan. Silakan coba lagi.');
            } finally {
                this.isSending = false;
                this.isTyping = false;
            }
        },
        
        addMessageToChat(type, content) {
            const chatMessages = document.getElementById('chatMessages');
            const messageDiv = document.createElement('div');
            messageDiv.className = `flex ${type === 'user' ? 'justify-end' : (type === 'system' ? 'justify-center' : 'justify-start')}`;
            
            const now = new Date();
            const time = now.toLocaleTimeString('id-ID', { hour: '2-digit', minute: '2-digit' });
            
            messageDiv.innerHTML = `
                <div class="chat-bubble ${type}">
                    ${content}
                    <div class="text-xs opacity-70 mt-1">${time}</div>
                </div>
            `;
            
            chatMessages.appendChild(messageDiv);
            chatMessages.scrollTop = chatMessages.scrollHeight;
        },
        
        async requestHumanTransfer() {
            try {
                const response = await fetch(`/counseling/chat/{{ $session->session_id }}/request-human`, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    }
                });
                
                const data = await response.json();
                
                if (data.success) {
                    this.addMessageToChat('system', data.message);
                    this.showTransferPrompt = false;
                } else {
                    this.addMessageToChat('system', data.message);
                }
                
            } catch (error) {
                console.error('Error requesting human transfer:', error);
                this.addMessageToChat('system', 'Terjadi kesalahan saat menghubungkan dengan konselor.');
            }
        },
        
        async endSession() {
            try {
                const response = await fetch(`/counseling/chat/{{ $session->session_id }}/end`, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    }
                });
                
                if (response.ok) {
                    window.location.href = '/counseling';
                }
                
            } catch (error) {
                console.error('Error ending session:', error);
            }
        }
    }
}
</script>
@endsection