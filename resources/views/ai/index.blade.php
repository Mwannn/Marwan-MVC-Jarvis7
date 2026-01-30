@extends('layouts.jarvis')

@section('title', 'AI NEURAL CORE')

@section('content')
<div class="flex flex-col h-[calc(100vh-180px)]">
    <!-- Chat Window -->
    <div class="flex-1 flex flex-col overflow-hidden bg-[#101018]/80 backdrop-blur-md border border-[#00f3ff]/10 rounded-xl relative">
        <div class="flex items-center justify-between p-4 border-b border-[#00f3ff]/20 bg-[#00f3ff]/5">
            <div class="flex items-center gap-3">
                <i class="fas fa-brain fa-pulse text-[#00f3ff]"></i>
                <span class="text-xs font-bold text-[#00f3ff] tracking-widest">NEURAL LINK: ESTABLISHED</span>
            </div>
            <div id="connection-status" class="w-2 h-2 rounded-full bg-green-500 shadow-[0_0_10px_#00ff00]"></div>
        </div>
        
        <div id="chat-history" class="flex-1 p-6 overflow-y-auto space-y-4 font-mono scrollbar-thin scrollbar-thumb-[#00f3ff]/20 scrollbar-track-transparent">
            <!-- Initial Greeting -->
            <div class="flex flex-col items-start max-w-[80%]">
                <div class="flex items-center gap-2 mb-1">
                    <span class="text-[10px] text-[#00f3ff] font-bold">JARVIS AI</span>
                </div>
                <div class="bg-[#00f3ff]/10 border border-[#00f3ff]/30 p-4 rounded-tr-xl rounded-br-xl rounded-bl-xl text-gray-300 text-sm leading-relaxed shadow-[0_0_15px_rgba(0,243,255,0.05)]">
                    Greetings, Sir. Neural Core is online. Accessing cognitive subroutines... How may I assist you with the protocols today?
                </div>
            </div>
        </div>

        <!-- Input Area -->
        <div class="p-4 border-t border-[#00f3ff]/20 bg-[#0a0a12]/90">
            <div class="relative flex items-center gap-3">
                <input type="text" id="ai-input" 
                    placeholder="Enter command or query..." 
                    class="flex-1 bg-black/50 border border-[#00f3ff]/30 text-white p-3 pl-4 rounded-lg outline-none focus:border-[#00f3ff] focus:shadow-[0_0_10px_rgba(0,243,255,0.2)] transition font-mono placeholder-gray-600"
                    autocomplete="off">
                
                <button onclick="sendMessage()" class="bg-[#00f3ff]/10 border border-[#00f3ff] text-[#00f3ff] px-6 py-3 rounded-lg hover:bg-[#00f3ff] hover:text-black transition flex items-center gap-2 font-bold text-sm tracking-wider uppercase">
                    SEND <i class="fas fa-paper-plane"></i>
                </button>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/marked/marked.min.js"></script>
<script>
    async function sendMessage() {
        const input = document.getElementById('ai-input');
        const text = input.value;
        const history = document.getElementById('chat-history');

        if(!text.trim()) return;

        // User Message
        const userDiv = document.createElement('div');
        userDiv.className = 'flex flex-col items-end max-w-[80%] ml-auto';
        userDiv.innerHTML = `
            <div class="flex items-center gap-2 mb-1">
                <span class="text-[10px] text-gray-500 font-bold">USER</span>
            </div>
            <div class="bg-gray-800 border border-gray-700 p-4 rounded-tl-xl rounded-bl-xl rounded-br-xl text-gray-300 text-sm leading-relaxed">
                ${text.replace(/\n/g, '<br>')}
            </div>
        `;
        history.appendChild(userDiv);
        input.value = '';
        history.scrollTo({ top: history.scrollHeight, behavior: 'smooth' });

        // Loading State
        const loadingDiv = document.createElement('div');
        loadingDiv.className = 'flex flex-col items-start max-w-[80%] loading-indicator';
        loadingDiv.innerHTML = `
            <div class="flex items-center gap-2 mb-1">
                <span class="text-[10px] text-[#00f3ff] font-bold">JARVIS AI</span>
            </div>
             <div class="bg-[#00f3ff]/5 border border-[#00f3ff]/20 p-3 rounded-tr-xl rounded-br-xl rounded-bl-xl flex gap-2 items-center">
                <div class="w-2 h-2 bg-[#00f3ff] rounded-full animate-bounce"></div>
                <div class="w-2 h-2 bg-[#00f3ff] rounded-full animate-bounce delay-100"></div>
                <div class="w-2 h-2 bg-[#00f3ff] rounded-full animate-bounce delay-200"></div>
            </div>
        `;
        history.appendChild(loadingDiv);
        history.scrollTo({ top: history.scrollHeight, behavior: 'smooth' });

        try {
            const token = document.querySelector('meta[name="csrf-token"]').content;
            const response = await fetch("{{ route('ai.chat') }}", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": token
                },
                body: JSON.stringify({ message: text })
            });

            const data = await response.json();
            
            // Remove loading indicator
            loadingDiv.remove();

            // AI Message
            const aiDiv = document.createElement('div');
            aiDiv.className = 'flex flex-col items-start max-w-[90%]';
            aiDiv.innerHTML = `
                <div class="flex items-center gap-2 mb-1">
                    <span class="text-[10px] text-[#00f3ff] font-bold">JARVIS AI</span>
                </div>
                <div class="bg-[#00f3ff]/10 border border-[#00f3ff]/30 p-4 rounded-tr-xl rounded-br-xl rounded-bl-xl text-gray-300 text-sm leading-relaxed shadow-[0_0_15px_rgba(0,243,255,0.05)] markdown-body">
                    ${marked.parse(data.response)}
                </div>
            `;
            history.appendChild(aiDiv);
            
            // Text to speech (optional)
            if(window.jarvisVoice && window.jarvisVoice.isListening === false) {
                 // Only speak if not currently listening to avoid loop, or make it configurable
                 // window.jarvisVoice.speak(data.response.replace(/[*#`]/g, ''));
            }

        } catch (error) {
            loadingDiv.remove();
            const errorDiv = document.createElement('div');
            errorDiv.className = 'flex flex-col items-start max-w-[80%]';
            errorDiv.innerHTML = `
                <div class="bg-red-500/10 border border-red-500/50 p-3 rounded-xl text-red-500 text-sm">
                    <i class="fas fa-exclamation-triangle"></i> Neural Link Interference: ${error.message}
                </div>
            `;
            history.appendChild(errorDiv);
        }
        
        history.scrollTo({ top: history.scrollHeight, behavior: 'smooth' });
    }

    // Enter key support
    document.getElementById('ai-input').addEventListener('keypress', function (e) {
        if (e.key === 'Enter') sendMessage();
    });
</script>
