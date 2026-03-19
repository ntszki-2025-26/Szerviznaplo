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

    .page-header { display: flex; align-items: flex-end; justify-content: space-between; margin-bottom: 2.5rem; padding-bottom: 2rem; border-bottom: 1px solid var(--border); }
    .page-tag { font-size: 0.72rem; letter-spacing: 0.2em; text-transform: uppercase; color: var(--accent); margin-bottom: 0.5rem; display: flex; align-items: center; gap: 0.5rem; }
    .page-tag::before { content: ''; display: block; width: 1.5rem; height: 1px; background: var(--accent); }
    .page-title { font-family: 'Barlow Condensed', sans-serif; font-weight: 900; font-size: clamp(2rem, 4vw, 3rem); text-transform: uppercase; letter-spacing: -0.01em; line-height: 1; }

    .alert { padding: 1rem 1.5rem; border-radius: 2px; margin-bottom: 1.5rem; font-size: 0.88rem; display: flex; align-items: center; gap: 0.75rem; }
    .alert-success { background: rgba(39,174,96,0.08); border: 1px solid rgba(39,174,96,0.25); color: #2ecc71; }

    .stat-strip { display: flex; border: 1px solid var(--border); border-radius: 2px; overflow: hidden; margin-bottom: 2rem; }
    .stat-strip-item { flex: 1; padding: 1.25rem 1.5rem; background: var(--surface); border-right: 1px solid var(--border); position: relative; }
    .stat-strip-item:last-child { border-right: none; }
    .stat-strip-item::after { content: ''; position: absolute; top: 0; left: 0; width: 3px; height: 100%; }
    .stat-strip-item.total::after  { background: var(--accent); }
    .stat-strip-item.pending::after { background: var(--orange); }
    .stat-strip-item.ongoing::after { background: var(--blue); }
    .stat-strip-item.done::after   { background: var(--green); }
    .stat-strip-num { font-family: 'DM Mono', monospace; font-size: 2rem; font-weight: 500; line-height: 1; margin-bottom: 0.3rem; }
    .stat-strip-label { font-size: 0.72rem; letter-spacing: 0.12em; text-transform: uppercase; color: var(--muted); }

    .table-container { border: 1px solid var(--border); border-radius: 2px; overflow: hidden; }
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
    .comment-cell { font-size: 0.82rem; color: var(--muted); max-width: 160px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap; }

    .status-dot { display: inline-flex; align-items: center; gap: 0.5rem; font-size: 0.78rem; font-weight: 500; }
    .status-dot::before { content: ''; width: 7px; height: 7px; border-radius: 50%; background: currentColor; flex-shrink: 0; }
    .s-pending   { color: var(--orange); }
    .s-ongoing   { color: var(--blue); }
    .s-confirmed { color: var(--accent); }
    .s-completed { color: var(--green); }
    .s-cancelled { color: var(--red); }
    .s-default   { color: var(--muted); }

    .btn-edit { background: transparent; border: 1px solid var(--border); color: var(--muted); font-family: 'Barlow Condensed', sans-serif; font-size: 0.75rem; letter-spacing: 0.08em; text-transform: uppercase; padding: 0.35rem 0.85rem; border-radius: 2px; cursor: pointer; transition: border-color 0.2s, color 0.2s; display: inline-flex; align-items: center; gap: 0.35rem; }
    .btn-edit:hover { border-color: var(--accent); color: var(--accent); }
    .btn-edit svg { width: 12px; height: 12px; }

    .empty-row td { padding: 4rem; text-align: center; color: var(--muted); font-size: 0.88rem; }

    .modal-backdrop { position: fixed; inset: 0; background: rgba(0,0,0,0.75); backdrop-filter: blur(4px); z-index: 200; display: none; align-items: center; justify-content: center; }
    .modal-backdrop.open { display: flex; }
    .modal { background: var(--surface); border: 1px solid var(--border); border-radius: 2px; width: 100%; max-width: 480px; margin: 1rem; animation: modalIn 0.2s ease; }
    @keyframes modalIn { from { opacity: 0; transform: translateY(14px); } to { opacity: 1; transform: none; } }
    .modal-header { padding: 1.5rem 2rem; border-bottom: 1px solid var(--border); display: flex; align-items: center; justify-content: space-between; }
    .modal-title { font-family: 'Barlow Condensed', sans-serif; font-weight: 700; font-size: 1.2rem; text-transform: uppercase; letter-spacing: 0.06em; }
    .modal-subtitle { font-size: 0.78rem; color: var(--muted); margin-top: 0.25rem; }
    .modal-close { background: none; border: none; color: var(--muted); cursor: pointer; padding: 0.25rem; transition: color 0.2s; }
    .modal-close:hover { color: var(--text); }
    .modal-close svg { width: 20px; height: 20px; }
    .modal-body { padding: 2rem; display: flex; flex-direction: column; gap: 1.25rem; }
    .form-group { display: flex; flex-direction: column; gap: 0.4rem; }
    .form-label { font-size: 0.72rem; letter-spacing: 0.15em; text-transform: uppercase; color: var(--muted); }
    .form-select, .form-textarea { background: var(--bg); border: 1px solid var(--border); color: var(--text); font-family: 'Barlow', sans-serif; font-size: 0.9rem; padding: 0.7rem 1rem; border-radius: 2px; outline: none; transition: border-color 0.2s; width: 100%; }
    .form-textarea { resize: vertical; min-height: 90px; }
    .form-select:focus, .form-textarea:focus { border-color: var(--accent); }
    .form-select option { background: var(--surface); }
    .modal-footer { padding: 1.25rem 2rem; border-top: 1px solid var(--border); display: flex; justify-content: flex-end; gap: 0.75rem; }
    .btn-primary { background: var(--accent); color: #0a0a0a; font-family: 'Barlow Condensed', sans-serif; font-weight: 700; font-size: 0.9rem; letter-spacing: 0.15em; text-transform: uppercase; padding: 0.7rem 1.75rem; border-radius: 2px; border: none; cursor: pointer; transition: background 0.2s; }
    .btn-primary:hover { background: var(--accent-dim); }
    .btn-cancel { background: transparent; border: 1px solid var(--border); color: var(--muted); font-family: 'Barlow Condensed', sans-serif; font-size: 0.85rem; letter-spacing: 0.12em; text-transform: uppercase; padding: 0.7rem 1.5rem; border-radius: 2px; cursor: pointer; transition: border-color 0.2s, color 0.2s; }
    .btn-cancel:hover { border-color: var(--text); color: var(--text); }

    @media (max-width: 768px) {
        .page-wrap { padding: 2rem 1.25rem 6rem; }
        .table-container { overflow-x: auto; }
        .topbar { padding: 1rem 1.25rem; }
        .stat-strip { flex-wrap: wrap; }
    }
</style>

<div class="topbar">
    <div class="topbar-left">
        <a href="{{ route('home') }}" class="topbar-logo">Szerviz<span>napló</span></a>
        <span class="role-badge">Szerelő</span>
        <div class="topbar-divider"></div>
        <nav class="topbar-nav">
            <a href="{{ route('mechanic.dashboard') }}">Dashboard</a>
            <a href="{{ route('mechanic.repairs') }}" class="active">Javítások</a>
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

<div class="modal-backdrop" id="editModal">
    <div class="modal">
        <div class="modal-header">
            <div>
                <div class="modal-title">Státusz frissítése</div>
                <div class="modal-subtitle" id="modalSubtitle"></div>
            </div>
            <button class="modal-close" onclick="closeModal()">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
            </button>
        </div>
        <form method="POST" id="editForm">
            @csrf
            <div class="modal-body">
                <div class="form-group">
                    <label class="form-label">Státusz *</label>
                    <select name="status_repairs_id" class="form-select" id="statusSelect" required>
                        @foreach($statuses as $s)
                            <option value="{{ $s->id }}">{{ $s->status }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label class="form-label">Megjegyzés</label>
                    <textarea name="comment" class="form-textarea" id="commentField" placeholder="Szerelői megjegyzés..."></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn-cancel" onclick="closeModal()">Mégse</button>
                <button type="submit" class="btn-primary">Mentés</button>
            </div>
        </form>
    </div>
</div>

<div class="page-wrap">

    <div class="page-header">
        <div>
            <div class="page-tag">Szerelői felület</div>
            <h1 class="page-title">Összes javítás</h1>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="16" height="16"><polyline points="20 6 9 17 4 12"/></svg>
            {{ session('success') }}
        </div>
    @endif

    @php
        $total   = count($repairs);
        $pending = $repairs->where('status_name', 'Függőben')->count();
        $ongoing = $repairs->where('status_name', 'Folyamatban')->count();
        $done    = $repairs->where('status_name', 'Elvégezve')->count();
    @endphp

    <div class="stat-strip">
        <div class="stat-strip-item total">
            <div class="stat-strip-num">{{ $total }}</div>
            <div class="stat-strip-label">Összes</div>
        </div>
        <div class="stat-strip-item pending">
            <div class="stat-strip-num">{{ $pending }}</div>
            <div class="stat-strip-label">Függőben</div>
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
                    <th>Tulajdonos</th>
                    <th>Státusz</th>
                    <th>Megjegyzés</th>
                    <th></th>
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
                        <td><span class="user-tag">{{ $r->username }}</span></td>
                        <td><span class="status-dot {{ $sc }}">{{ $r->status_name ?? '—' }}</span></td>
                        <td><span class="comment-cell">{{ $comment }}</span></td>
                        <td>
                            <button class="btn-edit" onclick="openModal({{ $r->id }}, '{{ $r->brand }} {{ $r->model }}', {{ $r->status_repairs_id }}, '{{ addslashes($comment === '—' ? '' : $comment) }}')">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M11 4H4a2 2 0 00-2 2v14a2 2 0 002 2h14a2 2 0 002-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 013 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
                                Szerkesztés
                            </button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="empty-row">Nincs javítás</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</div>

<script>
    function openModal(id, vehicle, statusId, comment) {
        document.getElementById('editForm').action = '/mechanic/repairs/' + id + '/status';
        document.getElementById('modalSubtitle').textContent = vehicle;
        document.getElementById('statusSelect').value = statusId;
        document.getElementById('commentField').value = comment;
        document.getElementById('editModal').classList.add('open');
    }

    function closeModal() {
        document.getElementById('editModal').classList.remove('open');
    }

    document.getElementById('editModal').addEventListener('click', function(e) {
        if (e.target === this) closeModal();
    });
</script>

</x-layout>