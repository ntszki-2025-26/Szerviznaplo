<x-layout>
<style>
    *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

    :root {
        --bg: #0a0a0a;
        --surface: #121212;
        --border: #222;
        --accent: #5046E6;
        --accent-dim: #5046E6;
        --text: #f0ede8;
        --muted: #888;
        --green: #4caf7d;
        --red: #c0392b;
    }

    body {
        background: var(--bg);
        color: var(--text);
        font-family: 'Barlow', sans-serif;
        font-weight: 300;
        min-height: 100vh;
    }

    
    .topbar {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 1.25rem 3rem;
        border-bottom: 1px solid var(--border);
        background: var(--surface);
    }

    .topbar-logo {
        font-family: 'Barlow Condensed', sans-serif;
        font-weight: 700;
        font-size: 1.3rem;
        letter-spacing: 0.08em;
        text-transform: uppercase;
        text-decoration: none;
        color: var(--text);
    }

    .topbar-logo span { color: var(--accent); }
    .topbar-logo .sep { color: var(--muted); font-weight: 300; font-size: 1rem; }

    .topbar-right {
        display: flex;
        align-items: center;
        gap: 1.5rem;
    }

    .user-badge {
        display: flex;
        align-items: center;
        gap: 0.6rem;
        font-size: 0.85rem;
        color: var(--muted);
    }

    .user-avatar {
        width: 34px;
        height: 34px;
        border-radius: 50%;
        background: var(--border);
        border: 1px solid var(--accent);
        display: flex;
        align-items: center;
        justify-content: center;
        font-family: 'Barlow Condensed', sans-serif;
        font-weight: 700;
        font-size: 0.85rem;
        color: var(--accent);
        text-transform: uppercase;
    }

    .btn-logout {
        display: inline-flex;
        align-items: center;
        gap: 0.4rem;
        background: transparent;
        border: 1px solid var(--border);
        color: var(--muted);
        font-family: 'Barlow', sans-serif;
        font-size: 0.8rem;
        letter-spacing: 0.1em;
        text-transform: uppercase;
        padding: 0.45rem 1rem;
        border-radius: 2px;
        cursor: pointer;
        transition: border-color 0.2s, color 0.2s;
    }

    .btn-logout:hover { border-color: var(--red); color: var(--red); }

    
    .dashboard {
        max-width: 1200px;
        margin: 0 auto;
        padding: 3rem;
    }


    .greeting { margin-bottom: 3rem; }

    .greeting-tag {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        font-size: 0.72rem;
        letter-spacing: 0.25em;
        text-transform: uppercase;
        color: var(--accent);
        margin-bottom: 0.75rem;
    }

    .greeting-tag::before {
        content: '';
        display: block;
        width: 1.5rem;
        height: 1px;
        background: var(--accent);
    }

    .greeting h1 {
        font-family: 'Barlow Condensed', sans-serif;
        font-weight: 700;
        font-size: clamp(2rem, 4vw, 3rem);
        text-transform: uppercase;
        letter-spacing: -0.01em;
    }

    .greeting h1 span { color: var(--accent); }
    .greeting-sub { margin-top: 0.5rem; color: var(--muted); font-size: 0.9rem; }

    
    .stats-row {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 1px;
        background: var(--border);
        border: 1px solid var(--border);
        margin-bottom: 2.5rem;
    }

    .stat-card {
        background: var(--surface);
        padding: 1.75rem 2rem;
        position: relative;
        overflow: hidden;
        transition: background 0.2s;
    }

    .stat-card:hover { background: #181818; }

    .stat-card::after {
        content: '';
        position: absolute;
        bottom: 0; left: 0;
        width: 100%; height: 2px;
        background: var(--accent);
        transform: scaleX(0);
        transform-origin: left;
        transition: transform 0.3s;
    }

    .stat-card:hover::after { transform: scaleX(1); }

    .stat-card-label {
        font-size: 0.72rem;
        letter-spacing: 0.18em;
        text-transform: uppercase;
        color: var(--muted);
        margin-bottom: 0.75rem;
    }

    .stat-card-num {
        font-family: 'Barlow Condensed', sans-serif;
        font-weight: 700;
        font-size: 2.2rem;
        color: var(--text);
        line-height: 1;
    }

    .stat-card-icon {
        position: absolute;
        top: 1.5rem; right: 1.5rem;
        width: 28px; height: 28px;
        color: var(--border);
        transition: color 0.2s;
    }

    .stat-card:hover .stat-card-icon { color: rgba(232,184,75,0.25); }

    
    .section-title {
        font-family: 'Barlow Condensed', sans-serif;
        font-weight: 700;
        font-size: 1.1rem;
        text-transform: uppercase;
        letter-spacing: 0.12em;
        color: var(--muted);
        margin-bottom: 1.25rem;
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }

    .section-title::after { content: ''; flex: 1; height: 1px; background: var(--border); }

   
    .actions-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 1rem;
        margin-bottom: 2.5rem;
    }

    .action-card {
        background: var(--surface);
        border: 1px solid var(--border);
        border-radius: 2px;
        padding: 1.5rem;
        text-decoration: none;
        color: var(--text);
        display: flex;
        align-items: center;
        gap: 1rem;
        transition: border-color 0.2s, background 0.2s;
    }

    .action-card:hover {
        border-color: var(--accent);
        background: rgba(232,184,75,0.04);
    }

    .action-icon {
        width: 42px; height: 42px;
        border-radius: 2px;
        background: var(--border);
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        transition: background 0.2s;
    }

    .action-card:hover .action-icon { background: rgba(232,184,75,0.15); }
    .action-icon svg { width: 20px; height: 20px; color: var(--accent); }

    .action-title {
        font-family: 'Barlow Condensed', sans-serif;
        font-weight: 600;
        font-size: 1rem;
        text-transform: uppercase;
        letter-spacing: 0.06em;
        margin-bottom: 0.2rem;
    }

    .action-desc { font-size: 0.78rem; color: var(--muted); }

    
    .info-row { display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; }

    .info-box {
        background: var(--surface);
        border: 1px solid var(--border);
        padding: 1.5rem 2rem;
    }

    .info-box-title {
        font-size: 0.72rem;
        letter-spacing: 0.2em;
        text-transform: uppercase;
        color: var(--muted);
        margin-bottom: 1rem;
    }

    .info-item {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 0.6rem 0;
        border-bottom: 1px solid var(--border);
        font-size: 0.88rem;
    }

    .info-item:last-child { border-bottom: none; }
    .info-item-label { color: var(--muted); }
    .info-item-val { color: var(--text); font-weight: 400; }
    .info-item-val.accent { color: var(--accent); }

    .status-dot {
        display: inline-block;
        width: 7px; height: 7px;
        border-radius: 50%;
        background: var(--green);
        margin-right: 0.4rem;
    }

    @media (max-width: 900px) {
        .topbar { padding: 1rem 1.5rem; }
        .dashboard { padding: 2rem 1.5rem; }
        .stats-row { grid-template-columns: 1fr 1fr; }
        .actions-grid { grid-template-columns: 1fr 1fr; }
        .info-row { grid-template-columns: 1fr; }
    }

    @media (max-width: 600px) {
        .stats-row { grid-template-columns: 1fr; }
        .actions-grid { grid-template-columns: 1fr; }
    }
</style>

<link href="https://fonts.googleapis.com/css2?family=Barlow+Condensed:wght@300;500;700;900&family=Barlow:wght@300;400;500&display=swap" rel="stylesheet">


<div class="topbar">
    <a href="{{ route('home') }}" class="topbar-logo">
        Szerviz<span>napló</span> <span class="sep">/ Irányítópult</span>
    </a>
    <div class="topbar-right">
        <div class="user-badge">
            
            {{ Auth::user()->first_name ?? Auth::user()->username }}
        </div>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="btn-logout">
                <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M9 21H5a2 2 0 01-2-2V5a2 2 0 012-2h4"/>
                    <polyline points="16 17 21 12 16 7"/>
                    <line x1="21" y1="12" x2="9" y2="12"/>
                </svg>
                Kilépés
            </button>
        </form>
    </div>
</div>


<div class="dashboard">

    
    <div class="greeting">
        <div class="greeting-tag">Üdvözöljük</div>
        <h1>Helló, <span>{{ Auth::user()->username }}</span>!</h1>
        <p class="greeting-sub">{{ now()->isoFormat('YYYY. MMMM D., dddd') }} — Jó munkát kívánunk.</p>
    </div>

  
    <div class="stats-row">
        <div class="stat-card">
            <div class="stat-card-label">Járműveim</div>
            <div class="stat-card-num">{{ $vehicleCount ?? '—' }}</div>
            <svg class="stat-card-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                <path d="M7 17H5a2 2 0 01-2-2v-4l2-5h14l2 5v4a2 2 0 01-2 2h-2"/>
                <circle cx="7" cy="17" r="2"/><circle cx="17" cy="17" r="2"/>
                <path d="M5 10h14"/>
            </svg>
        </div>
        <div class="stat-card">
            <div class="stat-card-label">Aktív hibák</div>
            <div class="stat-card-num">{{ $faultCount ?? '—' }}</div>
            <svg class="stat-card-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                <path d="M12 9v4M12 17h.01"/>
                <path d="M10.29 3.86L1.82 18a2 2 0 001.71 3h16.94a2 2 0 001.71-3L13.71 3.86a2 2 0 00-3.42 0z"/>
            </svg>
        </div>
        <div class="stat-card">
            <div class="stat-card-label">Folyamatban lévő javítás</div>
            <div class="stat-card-num">—</div>
            <svg class="stat-card-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                <path d="M14.7 6.3a1 1 0 000 1.4l1.6 1.6a1 1 0 001.4 0l3.77-3.77a6 6 0 01-7.94 7.94l-6.91 6.91a2.12 2.12 0 01-3-3l6.91-6.91a6 6 0 017.94-7.94l-3.76 3.76z"/>
            </svg>
        </div>
        <div class="stat-card">
            <div class="stat-card-label">Következő időpontom</div>
           <div class="stat-card-num">{{ $nextAppointmentFormatted ?? '—' }}</div>
            <svg class="stat-card-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                <rect x="3" y="4" width="18" height="18" rx="2"/>
                <line x1="16" y1="2" x2="16" y2="6"/>
                <line x1="8" y1="2" x2="8" y2="6"/>
                <line x1="3" y1="10" x2="21" y2="10"/>
            </svg>
        </div>
    </div>

   
<div class="section-title">Gyors műveletek</div>
<div class="actions-grid">
    <a href="{{ route('vehicles.index') }}" class="action-card">
        <div class="action-icon">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                <path d="M7 17H5a2 2 0 01-2-2v-4l2-5h14l2 5v4a2 2 0 01-2 2h-2"/>
                <circle cx="7" cy="17" r="2"/><circle cx="17" cy="17" r="2"/>
            </svg>
        </div>
        <div>
            <div class="action-title">Jármű hozzáadása</div>
            <div class="action-desc">Új jármű regisztrálása</div>
        </div>
    </a>
    <a href="{{ route('faults.index') }}" class="action-card" title="Hamarosan...">
        <div class="action-icon">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                <path d="M12 9v4M12 17h.01"/>
                <path d="M10.29 3.86L1.82 18a2 2 0 001.71 3h16.94a2 2 0 001.71-3L13.71 3.86a2 2 0 00-3.42 0z"/>
            </svg>
        </div>
        <div>
            <div class="action-title">Hiba bejelentése</div>
            <div class="action-desc">Fotóval és leírással</div>
        </div>
    </a>
    <a href="{{ route('appointments.index') }}" class="action-card" title="Hamarosan...">
        <div class="action-icon">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                <rect x="3" y="4" width="18" height="18" rx="2"/>
                <line x1="16" y1="2" x2="16" y2="6"/>
                <line x1="8" y1="2" x2="8" y2="6"/>
                <line x1="3" y1="10" x2="21" y2="10"/>
            </svg>
        </div>
        <div>
            <div class="action-title">Időpont foglalása</div>
            <div class="action-desc">Szerviz időpont kérése</div>
        </div>
    </a>
    <a href="#" class="action-card" title="Hamarosan...">
        <div class="action-icon">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                <path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8z"/>
                <polyline points="14 2 14 8 20 8"/>
                <line x1="16" y1="13" x2="8" y2="13"/>
                <line x1="16" y1="17" x2="8" y2="17"/>
            </svg>
        </div>
        <div>
            <div class="action-title">Szerviznapló</div>
            <div class="action-desc">Előzmények megtekintése</div>
        </div>
    </a>
    <a href="#" class="action-card" title="Hamarosan...">
        <div class="action-icon">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                <path d="M14.7 6.3a1 1 0 000 1.4l1.6 1.6a1 1 0 001.4 0l3.77-3.77a6 6 0 01-7.94 7.94l-6.91 6.91a2.12 2.12 0 01-3-3l6.91-6.91a6 6 0 017.94-7.94l-3.76 3.76z"/>
            </svg>
        </div>
        <div>
            <div class="action-title">Javítások</div>
            <div class="action-desc">Aktív javítások állapota</div>
        </div>
    </a>
    <a href="#" class="action-card" title="Hamarosan...">
        <div class="action-icon">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                <path d="M20 21v-2a4 4 0 00-4-4H8a4 4 0 00-4 4v2"/>
                <circle cx="12" cy="7" r="4"/>
            </svg>
        </div>
        <div>
            <div class="action-title">Profilom</div>
            <div class="action-desc">Adatok szerkesztése</div>
        </div>
    </a>
</div>

  
    <div class="section-title">Fiók adatok</div>
    <div class="info-row">
        <div class="info-box">
            <div class="info-box-title">Személyes adatok</div>
            <div class="info-item">
                <span class="info-item-label">Felhasználónév</span>
                <span class="info-item-val accent">{{ Auth::user()->username }}</span>
            </div>
            <div class="info-item">
                <span class="info-item-label">Teljes név</span>
                <span class="info-item-val">{{ Auth::user()->last_name }} {{ Auth::user()->first_name }}</span>
            </div>
            <div class="info-item">
                <span class="info-item-label">E-mail cím</span>
                <span class="info-item-val">{{ Auth::user()->email }}</span>
            </div>
        </div>
        <div class="info-box">
            <div class="info-box-title">Fiók állapot</div>
            <div class="info-item">
                <span class="info-item-label">Státusz</span>
                <span class="info-item-val"><span class="status-dot"></span>Aktív</span>
            </div>
            <div class="info-item">
                <span class="info-item-label">Jogosultság</span>
                <span class="info-item-val">{{ Auth::user()->is_admin ? 'Adminisztrátor' : 'Felhasználó' }}</span>
            </div>
            <div class="info-item">
                <span class="info-item-label">Bejelentkezve</span>
                <span class="info-item-val">{{ now()->format('H:i') }}</span>
            </div>
        </div>
    </div>

</div>
</x-layout>