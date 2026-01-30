export default class CommandPalette {
    constructor() {
        this.overlay = document.getElementById('command-palette');
        this.input = document.getElementById('command-input');
        this.results = document.getElementById('command-results');
        
        this.commands = [
            { name: 'Dashboard / Monitor', url: '/', icon: 'fa-microchip' },
            { name: 'Protocols / Tasks', url: '/tasks', icon: 'fa-tasks' },
            { name: 'Create New Protocol', url: '/tasks/create', icon: 'fa-plus-circle' },
            { name: 'AI Core / Neural Link', url: '/ai', icon: 'fa-robot' },
            { name: 'Database Viewer', url: '/database', icon: 'fa-database' },
            { name: 'System Settings', action: () => alert('Access Restricted: Level 10 Required'), icon: 'fa-cogs' },
        ];

        this.init();
    }

    init() {
        // Toggle keybind
        document.addEventListener('keydown', (e) => {
            if (e.key === 'k' && (e.metaKey || e.ctrlKey)) {
                e.preventDefault();
                this.toggle();
            }
            if (e.key === 'Escape' && !this.overlay.classList.contains('hidden')) {
                this.toggle();
            }
        });

        // Search input
        this.input.addEventListener('input', (e) => this.filter(e.target.value));
        
        // Initial render
        this.render(this.commands);
    }

    toggle() {
        this.overlay.classList.toggle('hidden');
        if (!this.overlay.classList.contains('hidden')) {
            this.input.focus();
            this.input.value = '';
            this.render(this.commands);
        }
    }

    filter(query) {
        if (!query) {
            this.render(this.commands);
            return;
        }
        const filtered = this.commands.filter(cmd => 
            cmd.name.toLowerCase().includes(query.toLowerCase())
        );
        this.render(filtered);
    }

    render(items) {
        this.results.innerHTML = '';
        if (items.length === 0) {
            this.results.innerHTML = '<div class="text-gray-500 text-sm p-4 text-center">No matching protocols found.</div>';
            return;
        }

        items.forEach(item => {
            const el = document.createElement('div');
            el.className = 'flex items-center gap-3 p-3 rounded hover:bg-[#00f3ff]/10 cursor-pointer transition group';
            el.innerHTML = `
                <div class="w-8 h-8 rounded bg-[#00f3ff]/20 flex items-center justify-center text-[#00f3ff] group-hover:bg-[#00f3ff] group-hover:text-black transition">
                    <i class="fas ${item.icon}"></i>
                </div>
                <span class="text-gray-300 group-hover:text-white">${item.name}</span>
            `;
            el.onclick = () => {
                if (item.url) window.location.href = item.url;
                if (item.action) item.action();
                this.toggle();
            };
            this.results.appendChild(el);
        });
    }
}
