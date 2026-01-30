<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>JARVIS 7 | AI Dashboard</title>
    <!-- Vite Assets -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <!-- Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Legacy CSS (Optional) -->
    <link rel="stylesheet" href="{{ asset('css/jarvis.css') }}">
</head>
<body class="bg-gray-900 text-white font-mono antialiased">

<div class="jarvis-container flex min-h-screen">
    <!-- Sidebar -->
    <aside class="jarvis-sidebar w-64 bg-gray-800 border-r border-[#00f3ff]/20 hidden md:flex flex-col p-4 fixed h-full z-10">
        <div class="brand text-2xl font-bold text-[#00f3ff] mb-8 tracking-widest text-center">
            JARVIS <span class="text-white">7</span>
        </div>
        
        <nav class="flex-1 space-y-2">
            <a href="{{ url('/') }}" class="nav-link flex items-center p-3 rounded hover:bg-[#00f3ff]/10 {{ request()->is('/') ? 'text-[#00f3ff]' : 'text-gray-400' }} transition">
                <i class="fas fa-microchip nav-icon w-6"></i> MONITOR
            </a>
            <a href="{{ url('/tasks') }}" class="nav-link flex items-center p-3 rounded hover:bg-[#00f3ff]/10 {{ request()->is('tasks*') ? 'text-[#00f3ff]' : 'text-gray-400' }} transition">
                <i class="fas fa-tasks nav-icon w-6"></i> PROTOCOLS
            </a>
            <a href="{{ route('ai.index') }}" class="nav-link flex items-center p-3 rounded hover:bg-[#00f3ff]/10 {{ request()->routeIs('ai.index') ? 'text-[#00f3ff]' : 'text-gray-400' }} transition">
                <i class="fas fa-robot nav-icon w-6"></i> AI CORE
            </a>
            <a href="{{ route('database.index') }}" class="nav-link flex items-center p-3 rounded hover:bg-[#00f3ff]/10 {{ request()->routeIs('database.index') ? 'text-[#00f3ff]' : 'text-gray-400' }} transition">
                <i class="fas fa-database nav-icon w-6"></i> DATABASE
            </a>
        </nav>

        <div class="text-xs text-gray-500 text-center mt-auto">
            SYSTEM STATUS: ONLINE<br>
            v7.0.1
        </div>
    </aside>

    <!-- Main Content -->
    <main class="jarvis-main flex-1 md:ml-64 p-6 bg-[#0a0a12] relative">
        <header class="top-bar flex justify-between items-center mb-6 border-b border-[#00f3ff]/20 pb-4">
            <div>
                <h3 class="text-xl font-bold text-[#e0e0e0] tracking-wider">@yield('title', 'COMMAND CENTER')</h3>
                <div class="system-status text-xs text-gray-400 mt-1">
                    <span><i class="fas fa-circle text-green-500 text-[8px]"></i> SYSTEMS NOMINAL</span>
                    <span class="ml-3"><i class="fas fa-clock"></i> <span id="clock">{{ date('H:i') }}</span></span>
                </div>
            </div>
            <div class="flex items-center gap-4">
                <button id="voice-toggle" class="text-xs border border-[#00f3ff] text-[#00f3ff] px-3 py-1 rounded hover:bg-[#00f3ff] hover:text-black transition uppercase">
                    <i class="fas fa-microphone"></i> VOICE OFF
                </button>
                <div class="w-10 h-10 rounded-full border-2 border-[#00f3ff] overflow-hidden">
                    <img src="https://ui-avatars.com/api/?name=Admin&background=00f3ff&color=000" class="w-full h-full object-cover">
                </div>
            </div>
        </header>

        @yield('content')
    </main>
</div>

<!-- Command Palette Overlay -->
<div id="command-palette" class="fixed inset-0 bg-black/80 hidden z-50 flex items-start justify-center pt-24 backdrop-blur-sm">
    <div class="bg-[#1a1a24] w-full max-w-lg rounded-xl border border-[#00f3ff]/30 shadow-[0_0_30px_rgba(0,243,255,0.2)] overflow-hidden">
        <div class="p-4 border-b border-gray-700 flex items-center gap-3">
            <i class="fas fa-search text-gray-400"></i>
            <input type="text" id="command-input" placeholder="Type a command or search..." class="bg-transparent border-none outline-none text-white w-full h-full text-lg placeholder-gray-500">
            <span class="text-xs text-gray-500 border border-gray-700 px-2 py-1 rounded">ESC</span>
        </div>
        <div id="command-results" class="max-h-64 overflow-y-auto p-2">
            <!-- Results injected here via JS -->
            <div class="text-gray-500 text-sm p-4 text-center">No recent commands.</div>
        </div>
        <div class="p-2 bg-[#00f3ff]/5 text-[10px] text-[#00f3ff] flex justify-between px-4">
            <span>JARVIS COMMAND INTERFACE</span>
            <span>PRO TIP: Use arrow keys to navigate</span>
        </div>
    </div>
</div>

</body>
</html>
