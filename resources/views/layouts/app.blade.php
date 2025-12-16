<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Coda') }}</title>
    
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Inter:400,500,600,700" rel="stylesheet">
    
    <!-- Bootstrap & Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    
    <!-- Quill Editor -->
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
    
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    
    <style>
        :root {
            --bs-body-font-family: 'Inter', sans-serif;
        }
        
        /* ========== LIGHT MODE VARIABLES ========== */
        [data-theme="light"] {
            --bg-primary: #ffffff;
            --bg-secondary: #f8f9fa;
            --bg-tertiary: #e9ecef;
            --text-primary: #212529;
            --text-secondary: #6c757d;
            --text-muted: #adb5bd;
            --border-color: #dee2e6;
            --card-bg: #ffffff;
            --sidebar-bg: #f8f9fa;
            --hover-bg: #e9ecef;
            --navbar-bg: #ffffff;
            --input-bg: #ffffff;
            --shadow: rgba(0,0,0,0.1);
            --shadow-hover: rgba(0,0,0,0.15);
        }
        
        /* ========== DARK MODE VARIABLES ========== */
        [data-theme="dark"] {
            --bg-primary: #0d1117;
            --bg-secondary: #161b22;
            --bg-tertiary: #21262d;
            --text-primary: #e6edf3;
            --text-secondary: #8b949e;
            --text-muted: #6e7681;
            --border-color: #30363d;
            --card-bg: #161b22;
            --sidebar-bg: #0d1117;
            --hover-bg: #21262d;
            --navbar-bg: #161b22;
            --input-bg: #0d1117;
            --shadow: rgba(0,0,0,0.3);
            --shadow-hover: rgba(0,0,0,0.5);
        }
        
        /* ========== GLOBAL STYLES ========== */
        body {
            background-color: var(--bg-primary);
            color: var(--text-primary);
            transition: background-color 0.3s ease, color 0.3s ease;
        }
        
        /* ========== NAVBAR ========== */
        .navbar {
            background-color: var(--navbar-bg) !important;
            border-bottom: 1px solid var(--border-color);
            box-shadow: 0 2px 4px var(--shadow);
            transition: all 0.3s ease;
        }
        
        .navbar-brand {
            font-weight: 700;
            font-size: 1.5rem;
            color: var(--text-primary) !important;
        }
        
        .nav-link {
            color: var(--text-secondary) !important;
            transition: color 0.2s;
        }
        
        .nav-link:hover {
            color: var(--text-primary) !important;
        }
        
        /* ========== THEME TOGGLE BUTTON ========== */
        .theme-toggle-btn {
            position: relative;
            width: 60px;
            height: 30px;
            background: var(--bg-tertiary);
            border: 2px solid var(--border-color);
            border-radius: 30px;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            padding: 0 4px;
        }
        
        .theme-toggle-btn:hover {
            border-color: #667eea;
        }
        
        .theme-toggle-slider {
            position: absolute;
            width: 22px;
            height: 22px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-radius: 50%;
            transition: transform 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 0.7rem;
        }
        
        [data-theme="dark"] .theme-toggle-slider {
            transform: translateX(30px);
        }
        
        /* ========== CARDS ========== */
        .card {
            background-color: var(--card-bg);
            color: var(--text-primary);
            border-color: var(--border-color);
            box-shadow: 0 2px 8px var(--shadow);
            transition: all 0.3s ease;
        }
        
        .card:hover {
            box-shadow: 0 4px 12px var(--shadow-hover);
        }
        
        .card-header {
            background-color: var(--bg-secondary);
            border-bottom-color: var(--border-color);
        }
        
        .card-footer {
            border-top-color: var(--border-color);
        }
        
        /* ========== FORMS ========== */
        .form-control,
        .form-select {
            background-color: var(--input-bg);
            color: var(--text-primary);
            border-color: var(--border-color);
            transition: all 0.2s;
        }
        
        .form-control:focus,
        .form-select:focus {
            background-color: var(--input-bg);
            color: var(--text-primary);
            border-color: #667eea;
            box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
        }
        
        .form-control::placeholder {
            color: var(--text-muted);
        }
        
        /* ========== BUTTONS ========== */
        .btn-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
            transition: all 0.3s ease;
        }
        
        .btn-primary:hover {
            background: linear-gradient(135deg, #5568d3 0%, #65408b 100%);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(102, 126, 234, 0.4);
        }
        
        .btn-outline-primary {
            color: #667eea;
            border-color: #667eea;
        }
        
        .btn-outline-primary:hover {
            background: #667eea;
            border-color: #667eea;
        }
        
        [data-theme="dark"] .btn-outline-secondary {
            color: var(--text-primary);
            border-color: var(--border-color);
        }
        
        [data-theme="dark"] .btn-outline-secondary:hover {
            background-color: var(--hover-bg);
            color: var(--text-primary);
            border-color: var(--border-color);
        }
        
        /* ========== DROPDOWN ========== */
        .dropdown-menu {
            background-color: var(--card-bg);
            border-color: var(--border-color);
            box-shadow: 0 4px 12px var(--shadow);
        }
        
        .dropdown-item {
            color: var(--text-primary);
            transition: all 0.2s;
        }
        
        .dropdown-item:hover {
            background-color: var(--hover-bg);
            color: var(--text-primary);
        }
        
        .dropdown-divider {
            border-top-color: var(--border-color);
        }
        
        /* ========== SIDEBAR ========== */
        .sidebar {
            background-color: var(--sidebar-bg);
            border-right: 1px solid var(--border-color);
            min-height: calc(100vh - 56px);
            position: sticky;
            top: 56px;
        }
        
        .list-group-item {
            background-color: transparent;
            color: var(--text-secondary);
            border-color: var(--border-color);
            transition: all 0.2s;
        }
        
        .list-group-item:hover {
            background-color: var(--hover-bg);
            color: var(--text-primary);
        }
        
        .list-group-item.active {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-color: #667eea;
            color: white;
        }
        
        /* ========== NOTE CARDS ========== */
        .note-card {
            transition: all 0.3s ease;
            cursor: pointer;
            height: 100%;
            position: relative;
            overflow: hidden;
        }
        
        .note-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, #667eea 0%, #764ba2 100%);
            transform: scaleX(0);
            transition: transform 0.3s ease;
        }
        
        .note-card:hover::before {
            transform: scaleX(1);
        }
        
        .note-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 8px 24px var(--shadow-hover);
        }
        
        .note-content {
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
            line-height: 1.6;
        }
        
        .pinned-badge {
            position: absolute;
            top: 10px;
            right: 10px;
            animation: pulse 2s infinite;
        }
        
        @keyframes pulse {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.7; }
        }
        
        .category-badge {
            font-size: 0.75rem;
            padding: 0.35rem 0.65rem;
            font-weight: 500;
            border-radius: 12px;
        }
        
        /* ========== MODALS ========== */
        [data-theme="dark"] .modal-content {
            background-color: var(--card-bg);
            color: var(--text-primary);
            border-color: var(--border-color);
        }
        
        [data-theme="dark"] .modal-header,
        [data-theme="dark"] .modal-footer {
            border-color: var(--border-color);
        }
        
        [data-theme="dark"] .btn-close {
            filter: invert(1);
        }
        
        /* ========== TEXT COLORS ========== */
        [data-theme="dark"] .text-muted {
            color: var(--text-muted) !important;
        }
        
        [data-theme="dark"] .text-secondary {
            color: var(--text-secondary) !important;
        }
        
        /* ========== ALERTS ========== */
        [data-theme="dark"] .alert {
            border-color: var(--border-color);
        }
        
        [data-theme="dark"] .alert-info {
            background-color: rgba(13, 110, 253, 0.1);
            color: #9ec5fe;
            border-color: rgba(13, 110, 253, 0.2);
        }
        
        /* ========== TABLES ========== */
        [data-theme="dark"] .table {
            color: var(--text-primary);
        }
        
        [data-theme="dark"] .table-hover tbody tr:hover {
            background-color: var(--hover-bg);
        }
        
        /* ========== PAGINATION ========== */
        [data-theme="dark"] .page-link {
            background-color: var(--card-bg);
            border-color: var(--border-color);
            color: var(--text-primary);
        }
        
        [data-theme="dark"] .page-link:hover {
            background-color: var(--hover-bg);
            border-color: var(--border-color);
            color: var(--text-primary);
        }
        
        [data-theme="dark"] .page-item.active .page-link {
            background-color: #667eea;
            border-color: #667eea;
        }
        
        /* ========== BADGES ========== */
        .badge {
            font-weight: 500;
            padding: 0.4em 0.8em;
        }
        
        /* ========== QUILL EDITOR DARK MODE ========== */
        [data-theme="dark"] .ql-toolbar {
            background-color: var(--bg-secondary);
            border-color: var(--border-color) !important;
        }
        
        [data-theme="dark"] .ql-container {
            background-color: var(--input-bg);
            border-color: var(--border-color) !important;
            color: var(--text-primary);
        }
        
        [data-theme="dark"] .ql-editor {
            color: var(--text-primary);
        }
        
        [data-theme="dark"] .ql-editor.ql-blank::before {
            color: var(--text-muted);
        }
        
        [data-theme="dark"] .ql-stroke {
            stroke: var(--text-secondary);
        }
        
        [data-theme="dark"] .ql-fill {
            fill: var(--text-secondary);
        }
        
        [data-theme="dark"] .ql-picker-label {
            color: var(--text-secondary);
        }
        
        [data-theme="dark"] .ql-picker-options {
            background-color: var(--card-bg);
            border-color: var(--border-color);
        }
        
        [data-theme="dark"] .ql-toolbar button:hover .ql-stroke,
        [data-theme="dark"] .ql-toolbar button.ql-active .ql-stroke {
            stroke: #667eea;
        }
        
        [data-theme="dark"] .ql-toolbar button:hover .ql-fill,
        [data-theme="dark"] .ql-toolbar button.ql-active .ql-fill {
            fill: #667eea;
        }
        
        /* ========== SCROLLBAR ========== */
        [data-theme="dark"] ::-webkit-scrollbar {
            width: 10px;
            height: 10px;
        }
        
        [data-theme="dark"] ::-webkit-scrollbar-track {
            background: var(--bg-secondary);
        }
        
        [data-theme="dark"] ::-webkit-scrollbar-thumb {
            background: var(--border-color);
            border-radius: 5px;
        }
        
        [data-theme="dark"] ::-webkit-scrollbar-thumb:hover {
            background: var(--text-muted);
        }
        
        /* ========== LOGO STYLES ========== */
        .navbar-brand .logo-icon {
            font-size: 1.8rem;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        
        /* ========== ANIMATIONS ========== */
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        .fade-in {
            animation: fadeIn 0.3s ease;
        }
    </style>
</head>
<body data-theme="light">
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light shadow-sm">
            <div class="container-fluid">
                <a class="navbar-brand d-flex align-items-center" href="{{ url('/') }}">
                    <!-- GANTI LOGO DI SINI -->
                    <i class="bi bi-journal-bookmark-fill logo-icon me-2"></i>
                    <span>Coda</span>
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ms-auto align-items-center">
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">
                                        <i class="bi bi-box-arrow-in-right"></i> Login
                                    </a>
                                </li>
                            @endif
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">
                                        <i class="bi bi-person-plus"></i> Register
                                    </a>
                                </li>
                            @endif
                        @else
                            <!-- Theme Toggle Button -->
                            <li class="nav-item me-3">
                                <div class="theme-toggle-btn" onclick="toggleTheme()">
                                    <div class="theme-toggle-slider">
                                        <i class="bi bi-moon-fill" id="theme-icon"></i>
                                    </div>
                                </div>
                            </li>
                            
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" role="button" data-bs-toggle="dropdown">
                                    <i class="bi bi-person-circle me-2" style="font-size: 1.5rem;"></i>
                                    <span>{{ Auth::user()->name }}</span>
                                    @if(Auth::user()->isAdmin())
                                        <span class="badge bg-danger ms-2">Admin</span>
                                    @endif
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end">
                                    <li>
                                        <a class="dropdown-item" href="{{ route('dashboard') }}">
                                            <i class="bi bi-speedometer2"></i> Dashboard
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="{{ route('user.settings') }}">
                                            <i class="bi bi-gear"></i> Settings
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="{{ route('categories.index') }}">
                                            <i class="bi bi-folder"></i> Kategori
                                        </a>
                                    </li>
                                    @if(Auth::user()->isAdmin())
                                        <li><hr class="dropdown-divider"></li>
                                        <li>
                                            <a class="dropdown-item text-danger" href="{{ route('admin.users.index') }}">
                                                <i class="bi bi-shield-lock"></i> Admin Panel
                                            </a>
                                        </li>
                                    @endif
                                    <li><hr class="dropdown-divider"></li>
                                    <li>
                                        <a class="dropdown-item text-danger" href="{{ route('logout') }}"
                                           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                            <i class="bi bi-box-arrow-right"></i> Logout
                                        </a>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                            @csrf
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main>
            @yield('content')
        </main>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
    
    <script>
        // Dark Mode Toggle with Animation
        function toggleTheme() {
            const html = document.documentElement;
            const body = document.body;
            const themeIcon = document.getElementById('theme-icon');
            const currentTheme = html.getAttribute('data-theme');
            const newTheme = currentTheme === 'light' ? 'dark' : 'light';
            
            html.setAttribute('data-theme', newTheme);
            body.setAttribute('data-theme', newTheme);
            localStorage.setItem('theme', newTheme);
            
            if (newTheme === 'dark') {
                themeIcon.classList.remove('bi-moon-fill');
                themeIcon.classList.add('bi-sun-fill');
            } else {
                themeIcon.classList.remove('bi-sun-fill');
                themeIcon.classList.add('bi-moon-fill');
            }
        }
        
        // Load saved theme on page load
        document.addEventListener('DOMContentLoaded', function() {
            const savedTheme = localStorage.getItem('theme') || 'light';
            const html = document.documentElement;
            const body = document.body;
            const themeIcon = document.getElementById('theme-icon');
            
            html.setAttribute('data-theme', savedTheme);
            body.setAttribute('data-theme', savedTheme);
            
            if (savedTheme === 'dark' && themeIcon) {
                themeIcon.classList.remove('bi-moon-fill');
                themeIcon.classList.add('bi-sun-fill');
            }
        });
    </script>
    
    @stack('scripts')
</body>
</html>