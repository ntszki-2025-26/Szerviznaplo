@props(['title' => null])

<link
    href="https://fonts.googleapis.com/css2?family=Barlow+Condensed:wght@300;500;700;900&family=Barlow:wght@300;400;500&display=swap"
    rel="stylesheet">

<header>
    @if (Auth::user() != null)

        <div class="topbar">
            <div class="topbar-left">
                <a href="{{ route('home') }}" class="topbar-logo">Szerviz<span>napló</span></a>
                <div class="topbar-divider"></div>
                <div class="breadcrumb">
                    <a href="{{ route('dashboard') }}">Dashboard</a>
                    <span>/</span>
                    <span class="current">{{ $title }}</span>
                </div>
            </div>
            <div class="topbar-right">
                <div style="display:flex;align-items:center;gap:0.75rem">
                    <div class="user-avatar">
                        {{ strtoupper(substr(Auth::user()->first_name ?? Auth::user()->username, 0, 1)) }}
                    </div>
                    <span class="user-name">{{ Auth::user()->username }}</span>
                </div>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="btn-logout">Kilépés</button>
                </form>
            </div>

        </div>
    @else
        <div class="topbar">
            <a href="{{ route('home') }}" class="topbar-logo">Szerviz<span>napló</span></a>
            <nav class="topbar-nav">
                <a href="{{ route('login') }}" class="btn-outline">Bejelentkezés</a>
                <a href="{{ route('register') }}" class="btn-accent">Regisztráció</a>
            </nav>
        </div>

    @endif

</header>