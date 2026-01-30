import './bootstrap';
import JarvisVoice from './jarvis-voice.js';
import CommandPalette from './command-palette.js';

document.addEventListener('DOMContentLoaded', () => {
    // Initialize Voice System
    const voiceSystem = new JarvisVoice();
    window.jarvisVoice = voiceSystem; // Expose globally for inline onclicks if needed

    const voiceBtn = document.getElementById('voice-toggle');
    if (voiceBtn) {
        voiceBtn.addEventListener('click', () => voiceSystem.toggleListen());
    }

    // Initialize Command Palette
    new CommandPalette();

    // Clock
    setInterval(() => {
        const now = new Date();
        const time = now.toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' });
        const el = document.getElementById('clock');
        if(el) el.innerText = time;
    }, 1000);
});
