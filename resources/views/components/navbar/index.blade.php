@props(['title' => null])
<link
    href="https://fonts.googleapis.com/css2?family=Barlow+Condensed:wght@300;500;700;900&family=Barlow:wght@300;400;500&display=swap"
    rel="stylesheet">
<header>
    @if (Auth::user() != null)
        <div class="topbar px-4 sm:px-6">
            <div class="topbar-left">
                <a href="{{ Auth::user()->isAdmin() ? route('admin.dashboard') : route('dashboard') }}" class="topbar-logo">Szerviz<span>napló</span></a>
                <div class="topbar-divider hidden sm:block"></div>
                <div class="breadcrumb hidden sm:flex">
                    <a href="{{ Auth::user()->isAdmin() ? route('admin.dashboard') : route('dashboard') }}">Dashboard</a>
                    <span>/</span>
                    <span class="current">{{ $title }}</span>
                </div>
            </div>
            <div class="topbar-right pr-4 sm:pr-0">
                <div style="display:flex;align-items:center;gap:0.75rem">
                    <div class="user-avatar">
                        {{ strtoupper(substr(Auth::user()->first_name ?? Auth::user()->username, 0, 1)) }}
                    </div>
                    <span class="user-name hidden sm:inline">{{ Auth::user()->username }}</span>
                </div>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="btn-logout">Kilépés</button>
                </form>
            </div>
        </div>
    @else
        <div class="topbar px-4 sm:px-6">
            <a href="{{ route('home') }}" class="topbar-logo">Szerviz<span>napló</span></a>
            <nav class="topbar-nav">
                <a href="{{ route('login') }}" class="btn-outline">Bejelentkezés</a>
                <a href="{{ route('register') }}" class="btn-accent">Regisztráció</a>
            </nav>
        </div>
    @endif
</header>