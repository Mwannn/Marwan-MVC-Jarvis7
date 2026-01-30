export default class JarvisVoice {
    constructor() {
        this.synth = window.speechSynthesis;
        this.recognition = null;
        this.isListening = false;
        
        if ('webkitSpeechRecognition' in window) {
            this.recognition = new window.webkitSpeechRecognition();
            this.recognition.continuous = false;
            this.recognition.lang = 'en-US'; // Default
            
            this.recognition.onstart = () => {
                this.isListening = true;
                this.updateUI('LISTENING...', 'bg-red-500');
            };
            
            this.recognition.onend = () => {
                this.isListening = false;
                this.updateUI('VOICE OFF', 'bg-transparent text-[#00f3ff]');
            };

            this.recognition.onresult = (event) => {
                const transcript = event.results[0][0].transcript;
                this.handleVoiceCommand(transcript);
            };
        }
    }

    speak(text) {
        if (this.synth.speaking) {
            console.error('speechSynthesis.speaking');
            return;
        }
        if (text !== '') {
            const utterThis = new SpeechSynthesisUtterance(text);
            utterThis.onend = function (event) {
                console.log('SpeechSynthesisUtterance.onend');
            };
            utterThis.onerror = function (event) {
                console.error('SpeechSynthesisUtterance.onerror');
            };
            // Select a good futuristic voice if available
            const voices = this.synth.getVoices();
            const preferredVoice = voices.find(v => v.name.includes('Google US English')) || voices[0];
            utterThis.voice = preferredVoice;
            utterThis.pitch = 0.9;
            utterThis.rate = 1.1;
            
            this.synth.speak(utterThis);
        }
    }

    toggleListen() {
        if (!this.recognition) {
            alert("Neural Link Offline: Web Speech API not supported.");
            return;
        }
        
        if (this.isListening) {
            this.recognition.stop();
        } else {
            this.recognition.start();
            // Play activation sound if we had one
        }
    }

    handleVoiceCommand(transcript) {
        console.log("Voice Command:", transcript);
        this.speak("Processing: " + transcript);
        
        // Simple command routing
        const cmd = transcript.toLowerCase();
        
        if (cmd.includes('go to tasks') || cmd.includes('open protocols')) {
            window.location.href = '/tasks';
        } else if (cmd.includes('go to database')) {
            window.location.href = '/database';
        } else if (cmd.includes('go to dashboard') || cmd.includes('go home')) {
            window.location.href = '/';
        } else if (cmd.includes('activate ai') || cmd.includes('neural core')) {
            window.location.href = '/ai';
        }
        
        // Integration with AI Chat if on that page
        const aiInput = document.getElementById('ai-input');
        if (aiInput) {
            aiInput.value = transcript;
            // Optionally trigger send
            // document.getElementById('btn-send').click();
        }
    }

    updateUI(text, classes) {
        const btn = document.getElementById('voice-toggle');
        if(btn) {
            btn.innerHTML = `<i class="fas fa-microphone"></i> ${text}`;
            // Simple class toggle - improve in real app
            if(text.includes('LISTENING')) {
                btn.classList.add('bg-[#00f3ff]', 'text-black');
                btn.classList.remove('text-[#00f3ff]');
            } else {
                btn.classList.remove('bg-[#00f3ff]', 'text-black');
                btn.classList.add('text-[#00f3ff]');
            }
        }
    }
}
