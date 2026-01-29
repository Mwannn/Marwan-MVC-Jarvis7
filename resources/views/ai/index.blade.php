@extends('layouts.jarvis')

@section('title', 'AI NEURAL CORE')

@section('content')
<div style="display:flex; flex-direction:column; height: calc(100vh - 180px);">
    <!-- Chat Window -->
    <div class="j-card" style="flex:1; display:flex; flex-direction:column; overflow:hidden;">
        <div class="j-card-header">
            <span class="stat-label">NEURAL LINK: ESTABLISHED</span>
            <i class="fas fa-brain fa-pulse" style="color:var(--primary)"></i>
        </div>
        
        <div id="chat-history" style="flex:1; padding:20px; overflow-y:auto; font-family: 'Roboto Mono', monospace;">
            <div style="margin-bottom:15px; display:flex;">
                <div style="background:rgba(0,0,0,0.5); border:1px solid var(--primary); padding:10px 15px; border-radius:0 15px 15px 15px; max-width:80%;">
                    <span style="color:var(--primary); font-size:10px; display:block; margin-bottom:5px;">JARVIS AI</span>
                    Greetings, Sir. Neural Core is online. Accessing cognitive subroutines... How may I assist you with the protocols today?
                </div>
            </div>
        </div>

        <!-- Input Area -->
        <div style="padding:20px; border-top:1px solid rgba(0, 243, 255, 0.2); background:rgba(0,0,0,0.3);">
            <div style="display:flex;">
                <input type="text" id="ai-input" placeholder="Enter command or query..." style="flex:1; background:transparent; border:1px solid var(--primary); color:white; padding:10px; outline:none; font-family:inherit;">
                <button class="badge badge-done" style="margin-left:10px; cursor:pointer;" onclick="sendMessage()">
                    SEND <i class="fas fa-paper-plane"></i>
                </button>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/marked/marked.min.js"></script>
<script>
    function sendMessage() {
        const input = document.getElementById('ai-input');
        const text = input.value;
        if(!text) return;

        const history = document.getElementById('chat-history');
        
        // User Message
        const userDiv = document.createElement('div');
        userDiv.style.marginBottom = '15px';
        userDiv.style.display = 'flex';
        userDiv.style.justifyContent = 'flex-end';
        userDiv.innerHTML = `
            <div style="background:rgba(255,255,255,0.1); border:1px solid var(--text-dim); padding:10px 15px; border-radius:15px 0 15px 15px; max-width:80%;">
                <span style="color:var(--text-dim); font-size:10px; display:block; margin-bottom:5px; text-align:right;">USER</span>
                ${text.replace(/\n/g, '<br>')}
            </div>
        `;
        history.appendChild(userDiv);
        input.value = '';
        history.scrollTop = history.scrollHeight;

        // Send to Backend
        fetch("{{ route('ai.chat') }}", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": "{{ csrf_token() }}"
            },
            body: JSON.stringify({ message: text })
        })
        .then(response => response.json())
        .then(data => {
             // Create AI Bubble
            const aiDiv = document.createElement('div');
            aiDiv.style.marginBottom = '15px';
            aiDiv.style.display = 'flex';
            aiDiv.innerHTML = `
                <div style="background:rgba(0,0,0,0.5); border:1px solid var(--primary); padding:10px 15px; border-radius:0 15px 15px 15px; max-width:90%; color: var(--text-main);">
                    <span style="color:var(--primary); font-size:10px; display:block; margin-bottom:5px;">JARVIS AI</span>
                    <div class="markdown-body" style="font-size: 14px; line-height: 1.6;">
                        ${marked.parse(data.response)}
                    </div>
                </div>
            `;
            history.appendChild(aiDiv);
            history.scrollTop = history.scrollHeight;
        })
        .catch(error => {
            console.error('Error:', error);
             const aiDiv = document.createElement('div');
            aiDiv.style.marginBottom = '15px';
            aiDiv.style.display = 'flex';
            aiDiv.innerHTML = `
                <div style="background:rgba(255,0,0,0.2); border:1px solid var(--secondary); padding:10px 15px; border-radius:0 15px 15px 15px; max-width:80%; color:var(--secondary);">
                    <span style="font-size:10px; display:block; margin-bottom:5px;">SYSTEM ALERT</span>
                    Connection to neural core failed.
                </div>
            `;
            history.appendChild(aiDiv);
            history.scrollTop = history.scrollHeight;
        });
    }

    // Allow Enter key to send
    document.getElementById('ai-input').addEventListener('keypress', function (e) {
        if (e.key === 'Enter') {
            sendMessage();
        }
    });
</script>
@endsection
