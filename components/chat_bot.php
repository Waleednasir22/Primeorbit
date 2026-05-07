<!-- Chat Bot UI -->
<div 
  id="chatbot-container"
  class="fixed inset-y-0 right-0 z-[100] w-full md:w-[450px] bg-white shadow-2xl border-l border-gray-100 flex flex-col transform translate-x-full transition-transform duration-500 ease-out hidden"
>
  <!-- Header -->
  <div class="p-6 border-b border-gray-100 flex justify-between items-center bg-white/80 backdrop-blur-md sticky top-0 z-10">
    <div class="flex items-center gap-3">
      <div class="w-10 h-10 rounded-full bg-gradient-to-tr from-google-blue to-blue-600 flex items-center justify-center text-white shadow-lg shadow-blue-200">
        <i data-lucide="bot" class="w-5 h-5"></i>
      </div>
      <div>
        <h3 class="font-display font-bold text-lg text-gray-900 leading-tight">Nexus AI</h3>
        <p class="text-xs text-google-green font-medium flex items-center gap-1">
          <span class="w-2 h-2 rounded-full bg-google-green animate-pulse"></span> Online
        </p>
      </div>
    </div>
    <button 
      id="close-chatbot"
      class="p-2 hover:bg-gray-100 rounded-full transition-colors text-gray-500 hover:text-gray-900"
    >
      <i data-lucide="x" class="w-6 h-6"></i>
    </button>
  </div>

  <!-- Messages Container -->
  <div id="chat-messages" class="flex-1 overflow-y-auto p-6 space-y-6 bg-gray-50/50">
    <div class="flex items-start gap-3">
      <div class="w-8 h-8 rounded-full bg-blue-100 text-google-blue flex items-center justify-center flex-shrink-0">
        <i data-lucide="sparkles" class="w-4 h-4"></i>
      </div>
      <div class="max-w-[80%] p-4 rounded-2xl text-sm leading-relaxed bg-white border border-gray-200 text-gray-700 rounded-tl-sm shadow-sm">
        Hello! I'm Nexus, PrimeOrbit's digital liaison. How can I assist you in exploring PrimeOrbit services today?
      </div>
    </div>
  </div>

  <!-- Voice Visualizer (Hidden by default) -->
  <div id="voice-visualizer" class="px-6 py-2 bg-blue-50 border-t border-blue-100 hidden items-center justify-center gap-1">
    <div class="h-3 w-1 bg-google-blue animate-pulse"></div>
    <div class="h-5 w-1 bg-google-blue animate-pulse delay-75"></div>
    <div class="h-8 w-1 bg-google-blue animate-pulse delay-150"></div>
    <span class="ml-2 text-xs font-bold text-google-blue uppercase tracking-wider">Listening...</span>
  </div>

  <!-- Input Area -->
  <div class="p-4 bg-white border-t border-gray-100">
    <form id="chat-form" class="relative flex gap-2">
       <button
         type="button"
         id="voice-btn"
         class="p-4 bg-gray-100 text-gray-500 hover:bg-gray-200 rounded-full transition-all"
         title="Use Voice Command"
       >
         <i data-lucide="mic" class="w-5 h-5"></i>
       </button>

       <div class="relative flex-grow">
         <input 
           id="chat-input"
           type="text" 
           placeholder="Type or speak..."
           class="w-full pl-6 pr-12 py-4 bg-gray-50 border border-gray-200 rounded-full focus:ring-2 focus:ring-google-blue/20 focus:border-google-blue outline-none transition-all placeholder:text-gray-400"
         />
         <button 
           type="submit"
           id="send-btn"
           class="absolute right-2 top-2 p-2 bg-google-blue text-white rounded-full hover:bg-blue-600 transition-all shadow-lg shadow-blue-200 hover:scale-105 active:scale-95"
         >
           <i data-lucide="send" class="w-5 h-5 ml-0.5" id="send-icon"></i>
         </button>
       </div>
    </form>
    <p class="text-center text-[10px] text-gray-400 mt-2">AI generated responses. Privacy policy applies.</p>
  </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const container = document.getElementById('chatbot-container');
        const closeBtn = document.getElementById('close-chatbot');
        const form = document.getElementById('chat-form');
        const input = document.getElementById('chat-input');
        const messages = document.getElementById('chat-messages');
        const sendIcon = document.getElementById('send-icon');
        const voiceBtn = document.getElementById('voice-btn');
        const voiceVisualizer = document.getElementById('voice-visualizer');

        let isListening = false;
        let recognition = null;

        // Global function to open chat
        window.openChat = function(initialMessage = null) {
            container.classList.remove('hidden');
            setTimeout(() => {
                container.classList.remove('translate-x-full');
            }, 10);
            
            if (initialMessage) {
                input.value = initialMessage;
                input.focus();
            }
        };

        // Initialize Speech Recognition
        if ('webkitSpeechRecognition' in window || 'SpeechRecognition' in window) {
            const SpeechRecognition = window.SpeechRecognition || window.webkitSpeechRecognition;
            recognition = new SpeechRecognition();
            recognition.continuous = false;
            recognition.interimResults = false;
            recognition.lang = 'en-US';

            recognition.onresult = (event) => {
                const transcript = event.results[0][0].transcript;
                input.value = transcript;
                sendMessage(transcript);
                stopListening();
            };
            recognition.onerror = () => stopListening();
            recognition.onend = () => stopListening();
        }

        function startListening() {
            if (!recognition) return alert("Speech recognition not supported.");
            isListening = true;
            recognition.start();
            voiceVisualizer.style.display = 'flex';
            voiceBtn.classList.add('bg-red-50', 'text-red-500', 'animate-pulse');
            lucide.createIcons();
        }

        function stopListening() {
            isListening = false;
            recognition?.stop();
            voiceVisualizer.style.display = 'none';
            voiceBtn.classList.remove('bg-red-50', 'text-red-500', 'animate-pulse');
            lucide.createIcons();
        }

        voiceBtn.addEventListener('click', () => {
            if (isListening) stopListening(); else startListening();
        });

        closeBtn.addEventListener('click', () => {
            container.classList.add('translate-x-full');
            setTimeout(() => {
                container.classList.add('hidden');
            }, 500);
        });

        form.addEventListener('submit', (e) => {
            e.preventDefault();
            sendMessage(input.value);
        });

        async function sendMessage(text) {
            if (!text.trim()) return;

            // Add User Message
            appendMessage('user', text);
            input.value = '';
            
            // Show Typing
            const typingId = appendTyping();
            
            try {
                const response = await fetch('api/chat.php', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify({ message: text })
                });
                const data = await response.json();
                
                removeTyping(typingId);
                appendMessage('model', data.response || "Sorry, I encountered an error.");
            } catch (error) {
                removeTyping(typingId);
                appendMessage('model', "I'm offline. Please try again later.");
            }
        }

        function appendMessage(role, text) {
            const div = document.createElement('div');
            div.className = `flex items-start gap-3 ${role === 'user' ? 'flex-row-reverse' : ''}`;
            div.innerHTML = `
                <div class="w-8 h-8 rounded-full flex items-center justify-center flex-shrink-0 ${
                  role === 'user' ? 'bg-gray-200 text-gray-600' : 'bg-blue-100 text-google-blue'
                }">
                  <i data-lucide="${role === 'user' ? 'user' : 'sparkles'}" class="w-4 h-4"></i>
                </div>
                <div class="max-w-[80%] p-4 rounded-2xl text-sm leading-relaxed ${
                  role === 'user' 
                    ? 'bg-gray-900 text-white rounded-tr-sm' 
                    : 'bg-white border border-gray-200 text-gray-700 rounded-tl-sm shadow-sm'
                }">
                  ${text}
                </div>
            `;
            messages.appendChild(div);
            messages.scrollTop = messages.scrollHeight;
            lucide.createIcons();
        }

        function appendTyping() {
            const id = 'typing-' + Date.now();
            const div = document.createElement('div');
            div.id = id;
            div.className = "flex items-start gap-3";
            div.innerHTML = `
                 <div class="w-8 h-8 rounded-full bg-blue-100 text-google-blue flex items-center justify-center flex-shrink-0">
                   <i data-lucide="loader-2" class="w-4 h-4 animate-spin"></i>
                 </div>
                 <div class="bg-white border border-gray-200 px-4 py-3 rounded-2xl rounded-tl-sm shadow-sm">
                   <div class="flex gap-1">
                     <span class="w-1.5 h-1.5 bg-gray-400 rounded-full animate-bounce"></span>
                     <span class="w-1.5 h-1.5 bg-gray-400 rounded-full animate-bounce delay-75"></span>
                     <span class="w-1.5 h-1.5 bg-gray-400 rounded-full animate-bounce delay-150"></span>
                   </div>
                 </div>
            `;
            messages.appendChild(div);
            messages.scrollTop = messages.scrollHeight;
            lucide.createIcons();
            return id;
        }

        function removeTyping(id) {
            const el = document.getElementById(id);
            if (el) el.remove();
        }

        lucide.createIcons();
    });
</script>
