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
    .topbar-divider { width: 1px; height: 20px; background: var(--border); }
    .breadcrumb { display: flex; align-items: center; gap: 0.5rem; font-size: 0.78rem; letter-spacing: 0.12em; text-transform: uppercase; }
    .breadcrumb a { color: var(--muted); text-decoration: none; transition: color 0.2s; }
    .breadcrumb a:hover { color: var(--text); }
    .breadcrumb span { color: var(--border); }
    .breadcrumb .current { color: var(--accent); }
    .topbar-right { display: flex; align-items: center; gap: 1.5rem; }
    .user-avatar { width: 36px; height: 36px; border-radius: 50%; background: linear-gradient(135deg, var(--accent), var(--accent-dim)); display: flex; align-items: center; justify-content: center; font-family: 'Barlow Condensed', sans-serif; font-weight: 700; font-size: 0.9rem; color: #fff; text-transform: uppercase; }
    .btn-logout { background: transparent; border: 1px solid var(--border); color: var(--muted); font-family: 'Barlow Condensed', sans-serif; font-weight: 500; font-size: 0.8rem; letter-spacing: 0.12em; text-transform: uppercase; padding: 0.45rem 1rem; border-radius: 2px; cursor: pointer; transition: border-color 0.2s, color 0.2s; }
    .btn-logout:hover { border-color: var(--red); color: var(--red); }

    .page-wrap { max-width: 1200px; margin: 0 auto; padding: 3rem 2.5rem 6rem; }   

    .page-header { display: flex; align-items: flex-end; justify-content: space-between; margin-bottom: 2.5rem; padding-bottom: 2rem; border-bottom: 1px solid var(--border); }
    .page-tag { font-size: 0.72rem; letter-spacing: 0.2em; text-transform: uppercase; color: var(--accent); margin-bottom: 0.5rem; display: flex; align-items: center; gap: 0.5rem; }
    .page-tag::before { content: ''; display: block; width: 1.5rem; height: 1px; background: var(--accent); }
    .page-title { font-family: 'Barlow Condensed', sans-serif; font-weight: 900; font-size: clamp(2rem, 4vw, 3rem); text-transform: uppercase; letter-spacing: -0.01em; line-height: 1; }

    .info-banner { display: flex; align-items: center; gap: 0.75rem; padding: 1rem 1.5rem; border: 1px solid var(--border); border-radius: 2px; background: var(--surface); margin-bottom: 2rem; font-size: 0.85rem; color: var(--muted); }
    .info-banner svg { width: 18px; height: 18px; flex-shrink: 0; color: var(--accent); }

    .stat-strip { display: flex; border: 1px solid var(--border); border-radius: 2px; overflow: hidden; margin-bottom: 2rem; }
    .stat-strip-item { flex: 1; padding: 1.25rem 1.5rem; background: var(--surface); border-right: 1px solid var(--border); position: relative; }
    .stat-strip-item:last-child { border-right: none; }
    .stat-strip-item::after { content: ''; position: absolute; top: 0; left: 0; width: 3px; height: 100%; }
    .stat-strip-item.total::after  { background: var(--accent); }
    .stat-strip-item.ongoing::after { background: var(--orange); }
    .stat-strip-item.done::after   { background: var(--green); }
    .stat-strip-num { font-family: 'DM Mono', monospace; font-size: 2rem; font-weight: 500; line-height: 1; margin-bottom: 0.3rem; }
    .stat-strip-label { font-size: 0.72rem; letter-spacing: 0.12em; text-transform: uppercase; color: var(--muted); }

    .alert { padding: 1rem 1.5rem; border-radius: 2px; margin-bottom: 1.5rem; font-size: 0.88rem; display: flex; align-items: center; gap: 0.75rem; }
    .alert-success { background: rgba(39,174,96,0.08); border: 1px solid rgba(39,174,96,0.25); color: #2ecc71; }

    .table-container { border: 1px solid var(--border); border-radius: 2px; overflow: hidden; }
    .table-toolbar { display: flex; align-items: center; justify-content: space-between; padding: 1rem 1.5rem; background: var(--surface); border-bottom: 1px solid var(--border); }
    .table-toolbar-title { font-family: 'Barlow Condensed', sans-serif; font-weight: 700; font-size: 0.85rem; letter-spacing: 0.12em; text-transform: uppercase; color: var(--muted); }
    .table-count-badge { background: rgba(80,70,230,0.1); border: 1px solid rgba(80,70,230,0.2); color: var(--accent); font-family: 'DM Mono', monospace; font-size: 0.75rem; padding: 0.15rem 0.6rem; border-radius: 2px; }

    table { width: 100%; border-collapse: collapse; }
    thead tr { background: #0d0d0d; }
    th { padding: 0.85rem 1.5rem; text-align: left; font-size: 0.68rem; letter-spacing: 0.18em; text-transform: uppercase; color: var(--muted); font-weight: 500; border-bottom: 1px solid var(--border); white-space: nowrap; }
    td { padding: 1.1rem 1.5rem; font-size: 0.88rem; border-bottom: 1px solid rgba(255,255,255,0.04); vertical-align: middle; }
    tr:last-child td { border-bottom: none; }
    tbody tr { transition: background 0.15s; }
    tbody tr:hover td { background: rgba(255,255,255,0.02); }

    .row-id { font-family: 'DM Mono', monospace; font-size: 0.75rem; color: var(--muted); }
    .vehicle-tag { display: inline-flex; align-items: center; gap: 0.5rem; font-size: 0.82rem; color: var(--text); background: rgba(255,255,255,0.04); border: 1px solid var(--border); padding: 0.3rem 0.85rem; border-radius: 2px; }
    .vehicle-tag svg { width: 13px; height: 13px; color: var(--accent); }

    .status-dot { display: inline-flex; align-items: center; gap: 0.5rem; font-size: 0.78rem; font-weight: 500; letter-spacing: 0.05em; }
    .status-dot::before { content: ''; width: 7px; height: 7px; border-radius: 50%; background: currentColor; flex-shrink: 0; }
    .s-pending   { color: var(--orange); }
    .s-ongoing   { color: var(--blue); }
    .s-confirmed { color: var(--accent); }
    .s-completed { color: var(--green); }
    .s-cancelled { color: var(--red); }
    .s-default   { color: var(--muted); }

    .comment-cell { font-size: 0.82rem; color: var(--muted); max-width: 220px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap; }

    .empty-row td { padding: 4rem; text-align: center; color: var(--muted); }
    .empty-row td svg { width: 40px; height: 40px; display: block; margin: 0 auto 1rem; opacity: 0.3; }
    .empty-row td p { font-size: 0.88rem; }

    @media (max-width: 768px) {
        .page-wrap { padding: 2rem 1.25rem; }
        .page-header { flex-direction: column; align-items: flex-start; gap: 1rem; }
        .stat-strip { flex-wrap: wrap; }
        .table-container { overflow-x: auto; }
        .topbar { padding: 1rem 1.25rem; }
    }
</style>

<div class="topbar">
    <div class="topbar-left">
        <a href="{{ route('home') }}" class="topbar-logo">Szerviz<span>napló</span></a>
        <div class="topbar-divider"></div>
        <div class="breadcrumb">
            <a href="{{ route('dashboard') }}">Dashboard</a>
            <span>/</span>
            <span class="current">Javítások</span>
        </div>
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

    <div class="page-header">
        <div>
            <div class="page-tag">Javításkezelés</div>
            <h1 class="page-title">Javításaim</h1>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="16" height="16"><polyline points="20 6 9 17 4 12"/></svg>
            {{ session('success') }}
        </div>
    @endif

    <div class="info-banner">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
        A javítások státuszát a szerelők kezelik. Ha kérdésed van, vedd fel velük a kapcsolatot.
    </div>

    @php
        $total   = count($repairs);
        $ongoing = $repairs->filter(fn($r) => in_array($r->status_name, ['Függőben', 'Folyamatban']))->count();
        $done    = $repairs->where('status_name', 'Elvégezve')->count();
    @endphp

    <div class="stat-strip">
        <div class="stat-strip-item total">
            <div class="stat-strip-num">{{ $total }}</div>
            <div class="stat-strip-label">Összes javítás</div>
        </div>
        <div class="stat-strip-item ongoing">
            <div class="stat-strip-num">{{ $ongoing }}</div>
            <div class="stat-strip-label">Folyamatban</div>
        </div>
        <div class="stat-strip-item done">
            <div class="stat-strip-num">{{ $done }}</div>
            <div class="stat-strip-label">Elvégezve</div>
        </div>
    </div>

    <div class="table-container">
        <div class="table-toolbar">
            <span class="table-toolbar-title">Javítások listája</span>
            <span class="table-count-badge">{{ $total }}</span>
        </div>
        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Jármű</th>
                    <th>Státusz</th>
                    <th>Megjegyzés</th>
                </tr>
            </thead>
            <tbody>
                @forelse($repairs as $r)
                    @php
                        $sc = match($r->status_name) {
                            'Függőben'      => 's-pending',
                            'Folyamatban'   => 's-ongoing',
                            'Visszaigazolt' => 's-confirmed',
                            'Elvégezve'     => 's-completed',
                            'Lemondva'      => 's-cancelled',
                            default         => 's-default',
                        };
                        $comment = $r->photos_comments ? (json_decode($r->photos_comments)->comment ?? '—') : '—';
                    @endphp
                    <tr>
                        <td><span class="row-id">#{{ $r->id }}</span></td>
                        <td>
                            <span class="vehicle-tag">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75"><path d="M7 17H5a2 2 0 01-2-2v-4l2-5h14l2 5v4a2 2 0 01-2 2h-2"/><circle cx="7" cy="17" r="2"/><circle cx="17" cy="17" r="2"/></svg>
                                {{ $r->brand }} {{ $r->model }} · {{ $r->license_plate }}
                            </span>
                        </td>
                        <td><span class="status-dot {{ $sc }}">{{ $r->status_name ?? '—' }}</span></td>
                        <td><span class="comment-cell">{{ $comment }}</span></td>
                    </tr>
                @empty
                    <tr class="empty-row">
                        <td colspan="4">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.25"><path d="M14.7 6.3a1 1 0 000 1.4l1.6 1.6a1 1 0 001.4 0l3.77-3.77a6 6 0 01-7.94 7.94l-6.91 6.91a2.12 2.12 0 01-3-3l6.91-6.91a6 6 0 017.94-7.94l-3.76 3.76z"/></svg>
                            <p>Nincs rögzített javítás</p>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</div>

</x-layout>