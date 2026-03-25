<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>@yield('title', 'Admin') — Teta Zahwe</title>
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}" />
    @stack('styles')
</head>

<body class="admin-body">

    {{-- Mobile sidebar toggle --}}
    <button class="sidebar-toggle" id="sidebarToggle" aria-label="Toggle menu">
        <span></span><span></span><span></span>
    </button>
    <div class="sidebar-overlay" id="sidebarOverlay"></div>

    <div class="admin-layout">

        {{-- SIDEBAR --}}
        <aside class="sidebar">
            <div class="sidebar-logo">
                <div class="sidebar-logo-en">Teta Zahwe</div>
                <div class="sidebar-logo-ar">لوحة التحكم</div>
            </div>

            <nav class="sidebar-nav">
                <div class="sidebar-nav-label">Main</div>
                <a href="{{ route('admin.dashboard') }}"
                    class="sidebar-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <rect x="3" y="3" width="7" height="7" />
                        <rect x="14" y="3" width="7" height="7" />
                        <rect x="3" y="14" width="7" height="7" />
                        <rect x="14" y="14" width="7" height="7" />
                    </svg>
                    Dashboard
                </a>
                <a href="{{ route('admin.weeks.index') }}"
                    class="sidebar-link {{ request()->routeIs('admin.weeks.*') ? 'active' : '' }}">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path
                            d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                    </svg>
                    Weekly Menus
                </a>
                <a href="{{ route('admin.messages') }}"
                    class="sidebar-link {{ request()->routeIs('admin.messages*') ? 'active' : '' }}">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M21 15a2 2 0 01-2 2H7l-4 4V5a2 2 0 012-2h14a2 2 0 012 2z" />
                    </svg>
                    Messages
                    @php $unread = \App\Models\ContactMessage::where('is_read', false)->count(); @endphp
                    @if($unread > 0)
                    <span class="sidebar-badge">{{ $unread }}</span>
                    @endif
                </a>
            </nav>

            <div class="sidebar-bottom">
                <div class="sidebar-nav-label">Site</div>
                <a href="{{ route('home') }}" target="_blank" class="sidebar-link">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M10 13a5 5 0 007.54.54l3-3a5 5 0 00-7.07-7.07l-1.72 1.71" />
                        <path d="M14 11a5 5 0 00-7.54-.54l-3 3a5 5 0 007.07 7.07l1.71-1.71" />
                    </svg>
                    View Website
                </a>
                <form action="{{ route('admin.logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="sidebar-link sidebar-logout">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2">
                            <path d="M9 21H5a2 2 0 01-2-2V5a2 2 0 012-2h4" />
                            <polyline points="16,17 21,12 16,7" />
                            <line x1="21" y1="12" x2="9" y2="12" />
                        </svg>
                        Logout
                    </button>
                </form>
            </div>
        </aside>

        {{-- MAIN --}}
        <main class="admin-main">
            <div class="admin-topbar">
                <div class="admin-topbar-title">@yield('page-title', 'Dashboard')</div>
                <div class="admin-topbar-user">Admin Panel</div>
            </div>

            @if(session('success'))
            <div class="admin-flash admin-flash-success">
                <svg width="15" height="15" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd"
                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                        clip-rule="evenodd" />
                </svg>
                {{ session('success') }}
            </div>
            @endif
            @if(session('error'))
            <div class="admin-flash admin-flash-error">
                <svg width="15" height="15" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd"
                        d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                        clip-rule="evenodd" />
                </svg>
                {{ session('error') }}
            </div>
            @endif

            <div class="admin-content">
                @yield('content')
            </div>
        </main>
    </div>

    <script src="{{ asset('js/admin.js') }}"></script>
    @stack('scripts')
</body>

</html>