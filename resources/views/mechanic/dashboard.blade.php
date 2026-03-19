<x-layout>
<style>
    @import url('https://fonts.googleapis.com/css2?family=Barlow+Condensed:wght@500;700;900&family=Barlow:wght@300;400;500&family=DM+Mono:wght@400;500&display=swap');
    *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
    :root {
        --bg: #0a0a0a; --surface: #121212; --border: #222;
        --accent: #5046E6; --accent-dim: #5046E6;
        --text: #f0ede8; --muted: #888;
        --red: #c0392b; --green: #27ae60; --orange: #e67e22; --blue: #2980b9;
    }
    body { background: var(--bg); color: var(--text); font-family: 'Barlow', sans-serif; font-weight: 300; min-height: 100vh; }

    .topbar { display: flex; align-items: center; justify-content: space-between; padding: 1.25rem 2.5rem; border-bottom: 1px solid var(--border); background: var(--surface); position: sticky; top: 0; z-index: 50; }
    .topbar-left { display: flex; align-items: center; gap: 1.25rem; }
    .topbar-logo { font-family: 'Barlow Condensed', sans-serif; font-weight: 700; font-size: 1.3rem; letter-spacing: 0.08em; text-transform: uppercase; color: var(--text); text-decoration: none; }
    .topbar-logo span { color: var(--accent); }
    .role-badge { font-size: 0.65rem; letter-spacing: 0.2em; text-transform: uppercase; background: rgba(232,184,75,0.12); border: 1px solid rgba(232,184,75,0.3); color: var(--accent); padding: 0.2rem 0.65rem; border-radius: 2px; }
    .topbar-divider { width: 1px; height: 20px; background: var(--border); }
    .topbar-nav { display: flex; align-items: center; gap: 0.25rem; }
    .topbar-nav a { font-family: 'Barlow Condensed', sans-serif; font-size: 0.82rem; letter-spacing: 0.1em; text-transform: uppercase; color: var(--muted); text-decoration: none; padding: 0.4rem 0.85rem; border-radius: 2px; transition: color 0.2s, background 0.2s; }
    .topbar-nav a:hover { color: var(--text); background: rgba(255,255,255,0.05); }
    .topbar-nav a.active { color: var(--accent); }
    .topbar-right { display: flex; align-items: center; gap: 1.5rem; }
    .user-avatar { width: 36px; height: 36px; border-radius: 50%; background: linear-gradient(135deg, var(--accent), var(--accent-dim)); display: flex; align-items: center; justify-content: center; font-family: 'Barlow Condensed', sans-serif; font-weight: 700; font-size: 0.9rem; color: #0a0a0a; text-transform: uppercase; }
    .btn-logout { background: transparent; border: 1px solid var(--border); color: var(--muted); font-family: 'Barlow Condensed', sans-serif; font-weight: 500; font-size: 0.8rem; letter-spacing: 0.12em; text-transform: uppercase; padding: 0.45rem 1rem; border-radius: 2px; cursor: pointer; transition: border-color 0.2s, color 0.2s; }
    .btn-logout:hover { border-color: var(--red); color: var(--red); }

    .page-wrap { max-width: 1300px; margin: 0 auto; padding: 3rem 2.5rem 6rem; }

    .greeting { margin-bottom: 2.5rem; }
    .greeting-tag { font-size: 0.72rem; letter-spacing: 0.2em; text-transform: uppercase; color: var(--accent); margin-bottom: 0.5rem; display: flex; align-items: center; gap: 0.5rem; }
    .greeting-tag::before { content: ''; display: block; width: 1.5rem; height: 1px; background: var(--accent); }
    .greeting h1 { font-family: 'Barlow Condensed', sans-serif; font-weight: 900; font-size: clamp(2rem, 4vw, 3rem); text-transform: uppercase; letter-spacing: -0.01em; }
    .greeting h1 span { color: var(--accent); }
    .greeting-sub { color: var(--muted); font-size: 0.88rem; margin-top: 0.4rem; }

    .stats-row { display: grid; grid-template-columns: repeat(4, 1fr); gap: 1px; background: var(--border); border: 1px solid var(--border); margin-bottom: 2.5rem; }
    .stat-card { background: var(--surface); padding: 1.75rem 2rem; position: relative; overflow: hidden; transition: background 0.2s; }
    .stat-card:hover { background: #181818; }
    .stat-card::after { content: ''; position: absolute; bottom: 0; left: 0; width: 100%; height: 2px; background: var(--accent); transform: scaleX(0); transform-origin: left; transition: transform 0.3s; }
    .stat-card:hover::after { transform: scaleX(1); }
    .stat-card-label { font-size: 0.72rem; letter-spacing: 0.18em; text-transform: uppercase; color: var(--muted); margin-bottom: 0.75rem; }
    .stat-card-num { font-family: 'DM Mono', monospace; font-size: 2.2rem; font-weight: 500; line-height: 1; }
    .stat-card-num.orange { color: var(--orange); }
    .stat-card-num.blue { color: var(--blue); }
    .stat-card-num.green { color: var(--green); }

    .section-title { font-family: 'Barlow Condensed', sans-serif; font-weight: 700; font-size: 1rem; text-transform: uppercase; letter-spacing: 0.12em; color: var(--muted); margin-bottom: 1.25rem; display: flex; align-items: center; gap: 0.75rem; }
    .section-title::after { content: ''; flex: 1; height: 1px; background: var(--border); }

    .table-container { border: 1px solid var(--border); border-radius: 2px; overflow: hidden; margin-bottom: 2rem; }
    .table-toolbar { display: flex; align-items: center; justify-content: space-between; padding: 1rem 1.5rem; background: var(--surface); border-bottom: 1px solid var(--border); }
    .table-toolbar-title { font-family: 'Barlow Condensed', sans-serif; font-weight: 700; font-size: 0.85rem; letter-spacing: 0.12em; text-transform: uppercase; color: var(--muted); }
    .table-count-badge { background: rgba(232,184,75,0.1); border: 1px solid rgba(232,184,75,0.2); color: var(--accent); font-family: 'DM Mono', monospace; font-size: 0.75rem; padding: 0.15rem 0.6rem; border-radius: 2px; }
    table { width: 100%; border-collapse: collapse; }
    thead tr { background: #0d0d0d; }
    th { padding: 0.85rem 1.5rem; text-align: left; font-size: 0.68rem; letter-spacing: 0.18em; text-transform: uppercase; color: var(--muted); font-weight: 500; border-bottom: 1px solid var(--border); }
    td { padding: 1rem 1.5rem; font-size: 0.88rem; border-bottom: 1px solid rgba(255,255,255,0.04); vertical-align: middle; }
    tr:last-child td { border-bottom: none; }
    tbody tr:hover td { background: rgba(255,255,255,0.02); }

    .row-id { font-family: 'DM Mono', monospace; font-size: 0.75rem; color: var(--muted); }
    .vehicle-tag { display: inline-flex; align-items: center; gap: 0.5rem; font-size: 0.82rem; color: var(--text); background: rgba(255,255,255,0.04); border: 1px solid var(--border); padding: 0.3rem 0.85rem; border-radius: 2px; }
    .vehicle-tag svg { width: 13px; height: 13px; color: var(--accent); }
    .user-tag { font-size: 0.78rem; color: var(--muted); }

    .status-dot { display: inline-flex; align-items: center; gap: 0.5rem; font-size: 0.78rem; font-weight: 500; }
    .status-dot::before { content: ''; width: 7px; height: 7px; border-radius: 50%; background: currentColor; flex-shrink: 0; }
    .s-pending   { color: var(--orange); }
    .s-ongoing   { color: var(--blue); }
    .s-confirmed { color: var(--accent); }
    .s-completed { color: var(--green); }
    .s-cancelled { color: var(--red); }
    .s-default   { color: var(--muted); }

    .btn-link { font-family: 'Barlow Condensed', sans-serif; font-size: 0.78rem; letter-spacing: 0.1em; text-transform: uppercase; color: var(--accent); text-decoration: none; border: 1px solid rgba(232,184,75,0.3); padding: 0.35rem 0.85rem; border-radius: 2px; transition: background 0.2s; }
    .btn-link:hover { background: rgba(232,184,75,0.08); }

    @media (max-width: 900px) {
        .stats-row { grid-template-columns: 1fr 1fr; }
        .page-wrap { padding: 2rem 1.25rem 6rem; }
        .topbar { padding: 1rem 1.25rem; }
    }
</style>

<div class="topbar">
    <div class="topbar-left">
        <a href="{{ route('home') }}" class="topbar-logo">Nick<span>Nuck</span></a>
        <span class="role-badge">Szerelő</span>
        <div class="topbar-divider"></div>
        <nav class="topbar-nav">
            <a href="{{ route('mechanic.dashboard') }}" class="active">Dashboard</a>
            <a href="{{ route('mechanic.repairs') }}">Javítások</a>
            <a href="{{ route('mechanic.faults') }}">Hibák</a>
            <a href="{{ route('mechanic.appointments') }}">Időpontok</a>
        </nav>
    </div>
    <div class="topbar-right">
        <div style="display:flex;align-items:center;gap:0.75rem">
            <div class="user-avatar">{{ strtoupper(substr(Auth::user()->first_name ?? Auth::user()->username, 0, 1)) }}</div>
            <span style="font-size:0.88rem;font-weight:500">{{ Auth::user()->username }}</span>
        </div>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="btn-logout">Kilépés</button>
        </form>
    </div>
</div>

<div class="page-wrap">

    <div class="greeting">
        <div class="greeting-tag">Szerelői felület</div>
        <h1>Helló, <span>{{ Auth::user()->first_name ?? Auth::user()->username }}</span>!</h1>
        <p class="greeting-sub">{{ now()->setTimezone('Europe/Budapest')->isoFormat('YYYY. MMMM D., dddd') }}</p>
    </div>

    <div class="stats-row">
        <div class="stat-card">
            <div class="stat-card-label">Összes javítás</div>
            <div class="stat-card-num">{{ $totalRepairs }}</div>
        </div>
        <div class="stat-card">
            <div class="stat-card-label">Függőben</div>
            <div class="stat-card-num orange">{{ $pendingRepairs }}</div>
        </div>
        <div class="stat-card">
            <div class="stat-card-label">Folyamatban</div>
            <div class="stat-card-num blue">{{ $ongoingRepairs }}</div>
        </div>
        <div class="stat-card">
            <div class="stat-card-label">Elvégezve</div>
            <div class="stat-card-num green">{{ $doneRepairs }}</div>
        </div>
    </div>

    <div class="section-title">Legutóbbi javítások</div>

    <div class="table-container">
        <div class="table-toolbar">
            <span class="table-toolbar-title">Legutóbbi 5 javítás</span>
            <a href="{{ route('mechanic.repairs') }}" class="btn-link">Összes megtekintése</a>
        </div>
        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Jármű</th>
                    <th>Tulajdonos</th>
                    <th>Státusz</th>
                </tr>
            </thead>
            <tbody>
                @forelse($recentRepairs as $r)
                    @php
                        $sc = match($r->status_name) {
                            'Függőben'      => 's-pending',
                            'Folyamatban'   => 's-ongoing',
                            'Visszaigazolt' => 's-confirmed',
                            'Elvégezve'     => 's-completed',
                            'Lemondva'      => 's-cancelled',
                            default         => 's-default',
                        };
                    @endphp
                    <tr>
                        <td><span class="row-id">#{{ $r->id }}</span></td>
                        <td>
                            <span class="vehicle-tag">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75"><path d="M7 17H5a2 2 0 01-2-2v-4l2-5h14l2 5v4a2 2 0 01-2 2h-2"/><circle cx="7" cy="17" r="2"/><circle cx="17" cy="17" r="2"/></svg>
                                {{ $r->brand }} {{ $r->model }} · {{ $r->license_plate }}
                            </span>
                        </td>
                        <td><span class="user-tag">{{ $r->username }}</span></td>
                        <td><span class="status-dot {{ $sc }}">{{ $r->status_name ?? '—' }}</span></td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" style="padding:2rem;text-align:center;color:var(--muted);font-size:0.88rem">Nincs javítás</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</div>

</x-layout>