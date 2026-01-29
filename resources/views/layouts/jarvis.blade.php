<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JARVIS 7 | AI Dashboard</title>
    <link rel="stylesheet" href="{{ asset('css/jarvis.css') }}">
    <!-- Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>

<div class="jarvis-container">
    <!-- Sidebar -->
    <aside class="jarvis-sidebar">
        <div class="brand">JARVIS <span style="color:var(--text-main)">7</span></div>
        
        <nav>
            <a href="{{ url('/') }}" class="nav-link {{ request()->is('/') ? 'active' : '' }}">
                <i class="fas fa-microchip nav-icon"></i> MONITOR
            </a>
            <a href="{{ url('/tasks') }}" class="nav-link {{ request()->is('tasks*') ? 'active' : '' }}">
                <i class="fas fa-tasks nav-icon"></i> PROTOCOLS
            </a>
            <a href="{{ route('ai.index') }}" class="nav-link {{ request()->routeIs('ai.index') ? 'active' : '' }}">
                <i class="fas fa-robot nav-icon"></i> AI CORE
            </a>
            <a href="{{ route('database.index') }}" class="nav-link {{ request()->routeIs('database.index') ? 'active' : '' }}">
                <i class="fas fa-database nav-icon"></i> DATABASE
            </a>
        </nav>

        <div style="margin-top:auto; font-size: 10px; color: var(--text-dim); text-align: center;">
            SYSTEM STATUS: ONLINE<br>
            v7.0.1
        </div>
        
        <!-- Mobile Toggle -->
        <div class="mobile-toggle" onclick="document.querySelector('.jarvis-sidebar').classList.toggle('active')">
            <i class="fas fa-bars"></i>
        </div>
    </aside>

    <!-- Main Content -->
    <main class="jarvis-main">
        <header class="top-bar">
            <div>
                <h3>@yield('title', 'COMMAND CENTER')</h3>
                <div class="system-status">
                    <span><i class="fas fa-circle" style="color:#0f0; font-size:8px;"></i> SYSTEMS NOMINAL</span>
                    <span><i class="fas fa-clock"></i> {{ date('H:i:s') }}</span>
                </div>
            </div>
            <div>
                <button class="badge badge-done" style="background:transparent; cursor:pointer;" onclick="toggleAudio()">
                    <i class="fas fa-volume-up"></i> AUDIO
                </button>
                <div style="display:inline-block; width: 40px; height: 40px; border-radius: 50%; border: 2px solid var(--primary); vertical-align: middle; margin-left: 10px; background: url('https://ui-avatars.com/api/?name=Admin&background=00f3ff&color=000'); background-size: cover;"></div>
            </div>
        </header>

        @yield('content')
    </main>
</div>

<script>
    function toggleAudio() {
        alert('Audio interface initialized.');
    }
</script>
</body>
</html>
