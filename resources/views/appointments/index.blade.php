<x-layout>
<style>
    @import url('https://fonts.googleapis.com/css2?family=Barlow+Condensed:wght@500;700;900&family=Barlow:wght@300;400;500&family=DM+Mono:wght@400;500&display=swap');

    *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

    :root {
        --bg: #0a0a0a;
        --surface: #121212;
        --border: #222;
        --accent: #5046E6;
        --accent-dim: #5046E6;
        --text: #f0ede8;
        --muted: #888;
        --red: #c0392b;
        --green: #27ae60;
        --orange: #e67e22;
        --blue: #2980b9;
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
    .user-avatar { width: 36px; height: 36px; border-radius: 50%; background: linear-gradient(135deg, var(--accent), var(--accent-dim)); display: flex; align-items: center; justify-content: center; font-family: 'Barlow Condensed', sans-serif; font-weight: 700; font-size: 0.9rem; color: #0a0a0a; text-transform: uppercase; }
    .btn-logout { background: transparent; border: 1px solid var(--border); color: var(--muted); font-family: 'Barlow Condensed', sans-serif; font-weight: 500; font-size: 0.8rem; letter-spacing: 0.12em; text-transform: uppercase; padding: 0.45rem 1rem; border-radius: 2px; cursor: pointer; transition: border-color 0.2s, color 0.2s; }
    .btn-logout:hover { border-color: var(--red); color: var(--red); }


    .page-wrap { max-width: 1200px; margin: 0 auto; padding: 3rem 2.5rem; }

    
    .page-header {
        display: grid;
        grid-template-columns: 1fr auto;
        align-items: end;
        gap: 2rem;
        margin-bottom: 2.5rem;
        padding-bottom: 2rem;
        border-bottom: 1px solid var(--border);
    }

    .page-tag { font-size: 0.72rem; letter-spacing: 0.2em; text-transform: uppercase; color: var(--accent); margin-bottom: 0.5rem; display: flex; align-items: center; gap: 0.5rem; }
    .page-tag::before { content: ''; display: block; width: 1.5rem; height: 1px; background: var(--accent); }
    .page-title { font-family: 'Barlow Condensed', sans-serif; font-weight: 900; font-size: clamp(2rem, 4vw, 3rem); text-transform: uppercase; letter-spacing: -0.01em; line-height: 1; }

    
    .stat-strip {
        display: flex;
        gap: 0;
        border: 1px solid var(--border);
        border-radius: 2px;
        overflow: hidden;
        margin-bottom: 2rem;
    }

    .stat-strip-item {
        flex: 1;
        padding: 1.25rem 1.5rem;
        background: var(--surface);
        border-right: 1px solid var(--border);
        position: relative;
    }

    .stat-strip-item:last-child { border-right: none; }

    .stat-strip-item::after {
        content: '';
        position: absolute;
        top: 0; left: 0;
        width: 3px; height: 100%;
    }

    .stat-strip-item.total::after  { background: var(--accent); }
    .stat-strip-item.pending::after { background: var(--orange); }
    .stat-strip-item.done::after   { background: var(--green); }
    .stat-strip-item.cancelled::after { background: var(--red); }

    .stat-strip-num { font-family: 'DM Mono', monospace; font-size: 2rem; font-weight: 500; line-height: 1; margin-bottom: 0.3rem; }
    .stat-strip-label { font-size: 0.72rem; letter-spacing: 0.12em; text-transform: uppercase; color: var(--muted); }

 
    .btn-primary { background: var(--accent); color: #0a0a0a; font-family: 'Barlow Condensed', sans-serif; font-weight: 700; font-size: 0.9rem; letter-spacing: 0.15em; text-transform: uppercase; padding: 0.8rem 1.75rem; border-radius: 2px; border: none; cursor: pointer; transition: background 0.2s; display: inline-flex; align-items: center; gap: 0.5rem; }
    .btn-primary:hover { background: var(--accent-dim); }
    .btn-primary svg { width: 16px; height: 16px; }


    .alert { padding: 1rem 1.5rem; border-radius: 2px; margin-bottom: 1.5rem; font-size: 0.88rem; display: flex; align-items: center; gap: 0.75rem; }
    .alert-success { background: rgba(39,174,96,0.08); border: 1px solid rgba(39,174,96,0.25); color: #2ecc71; }
    .alert-warning { background: rgba(230,126,34,0.08); border: 1px solid rgba(230,126,34,0.25); color: var(--orange); }

    
    .table-container {
        border: 1px solid var(--border);
        border-radius: 2px;
        overflow: hidden;
    }

    .table-toolbar {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 1rem 1.5rem;
        background: var(--surface);
        border-bottom: 1px solid var(--border);
    }

    .table-toolbar-title {
        font-family: 'Barlow Condensed', sans-serif;
        font-weight: 700;
        font-size: 0.85rem;
        letter-spacing: 0.12em;
        text-transform: uppercase;
        color: var(--muted);
    }

    .table-count-badge {
        background: rgba(232,184,75,0.1);
        border: 1px solid rgba(232,184,75,0.2);
        color: var(--accent);
        font-family: 'DM Mono', monospace;
        font-size: 0.75rem;
        padding: 0.15rem 0.6rem;
        border-radius: 2px;
    }

    table { width: 100%; border-collapse: collapse; }

    thead tr { background: #0d0d0d; }

    th {
        padding: 0.85rem 1.5rem;
        text-align: left;
        font-size: 0.68rem;
        letter-spacing: 0.18em;
        text-transform: uppercase;
        color: var(--muted);
        font-weight: 500;
        border-bottom: 1px solid var(--border);
        white-space: nowrap;
    }

    td {
        padding: 1.1rem 1.5rem;
        font-size: 0.88rem;
        border-bottom: 1px solid rgba(255,255,255,0.04);
        vertical-align: middle;
    }

    tr:last-child td { border-bottom: none; }
    tbody tr { transition: background 0.15s; }
    tbody tr:hover td { background: rgba(255,255,255,0.02); }

    /* DATE */
    .date-block { display: flex; align-items: center; gap: 1rem; }
    .date-cal {
        width: 40px; height: 40px;
        border: 1px solid var(--border);
        border-radius: 2px;
        display: flex; flex-direction: column; align-items: center; justify-content: center;
        background: var(--surface);
        flex-shrink: 0;
    }
    .date-cal-month { font-size: 0.5rem; font-weight: 700; letter-spacing: 0.12em; text-transform: uppercase; color: var(--accent); line-height: 1; padding-top: 2px; }
    .date-cal-day { font-family: 'DM Mono', monospace; font-size: 1.1rem; font-weight: 500; color: var(--text); line-height: 1; }
    .date-full { font-weight: 400; color: var(--text); font-size: 0.88rem; }
    .date-day-name { font-size: 0.75rem; color: var(--muted); margin-top: 0.1rem; }

    
    .vehicle-tag {
        display: inline-flex; align-items: center; gap: 0.5rem;
        font-size: 0.82rem; color: var(--text);
        background: rgba(255,255,255,0.04);
        border: 1px solid var(--border);
        padding: 0.3rem 0.85rem; border-radius: 2px;
        font-weight: 400;
    }
    .vehicle-tag svg { width: 13px; height: 13px; color: var(--accent); }

   
    .status-dot {
        display: inline-flex; align-items: center; gap: 0.5rem;
        font-size: 0.78rem; font-weight: 500; letter-spacing: 0.05em;
    }
    .status-dot::before { content: ''; width: 7px; height: 7px; border-radius: 50%; background: currentColor; flex-shrink: 0; }
    .s-pending   { color: var(--orange); }
    .s-confirmed { color: var(--accent); }
    .s-completed { color: var(--green); }
    .s-cancelled { color: var(--red); }
    .s-default   { color: var(--muted); }

   
    .row-id { font-family: 'DM Mono', monospace; font-size: 0.75rem; color: var(--muted); }

    
    .btn-del { background: transparent; border: 1px solid var(--border); color: var(--muted); font-family: 'Barlow Condensed', sans-serif; font-size: 0.75rem; letter-spacing: 0.08em; text-transform: uppercase; padding: 0.35rem 0.85rem; border-radius: 2px; cursor: pointer; transition: border-color 0.2s, color 0.2s; display: inline-flex; align-items: center; gap: 0.35rem; }
    .btn-del:hover { border-color: var(--red); color: var(--red); }
    .btn-del svg { width: 12px; height: 12px; }

 
    .empty-row td { padding: 4rem; text-align: center; color: var(--muted); }
    .empty-row td svg { width: 40px; height: 40px; display: block; margin: 0 auto 1rem; opacity: 0.3; }
    .empty-row td p { font-size: 0.88rem; }


    .modal-backdrop { position: fixed; inset: 0; background: rgba(0,0,0,0.75); backdrop-filter: blur(4px); z-index: 200; display: none; align-items: center; justify-content: center; }
    .modal-backdrop.open { display: flex; }
    .modal { background: var(--surface); border: 1px solid var(--border); border-radius: 2px; width: 100%; max-width: 440px; margin: 1rem; animation: modalIn 0.2s ease; }
    @keyframes modalIn { from { opacity: 0; transform: translateY(14px); } to { opacity: 1; transform: none; } }
    .modal-header { padding: 1.5rem 2rem; border-bottom: 1px solid var(--border); display: flex; align-items: center; justify-content: space-between; }
    .modal-title { font-family: 'Barlow Condensed', sans-serif; font-weight: 700; font-size: 1.2rem; text-transform: uppercase; letter-spacing: 0.06em; }
    .modal-close { background: none; border: none; color: var(--muted); cursor: pointer; padding: 0.25rem; transition: color 0.2s; }
    .modal-close:hover { color: var(--text); }
    .modal-close svg { width: 20px; height: 20px; }
    .modal-body { padding: 2rem; display: flex; flex-direction: column; gap: 1.25rem; }
    .form-group { display: flex; flex-direction: column; gap: 0.4rem; }
    .form-label { font-size: 0.72rem; letter-spacing: 0.15em; text-transform: uppercase; color: var(--muted); }
    .form-input, .form-select { background: var(--bg); border: 1px solid var(--border); color: var(--text); font-family: 'Barlow', sans-serif; font-size: 0.9rem; padding: 0.7rem 1rem; border-radius: 2px; outline: none; transition: border-color 0.2s; width: 100%; }
    .form-input:focus, .form-select:focus { border-color: var(--accent); }
    .form-select option { background: var(--surface); }
    .form-error { font-size: 0.75rem; color: #e74c3c; }
    .modal-footer { padding: 1.25rem 2rem; border-top: 1px solid var(--border); display: flex; justify-content: flex-end; gap: 0.75rem; }
    .btn-cancel { background: transparent; border: 1px solid var(--border); color: var(--muted); font-family: 'Barlow Condensed', sans-serif; font-size: 0.85rem; letter-spacing: 0.12em; text-transform: uppercase; padding: 0.7rem 1.5rem; border-radius: 2px; cursor: pointer; transition: border-color 0.2s, color 0.2s; }
    .btn-cancel:hover { border-color: var(--text); color: var(--text); }

    @media (max-width: 768px) {
        .page-wrap { padding: 2rem 1.25rem; }
        .page-header { grid-template-columns: 1fr; }
        .stat-strip { flex-wrap: wrap; }
        .stat-strip-item { min-width: 50%; }
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
            <span class="current">Időpontok</span>
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


<div class="modal-backdrop {{ $errors->any() ? 'open' : '' }}" id="addModal">
    <div class="modal">
        <div class="modal-header">
            <span class="modal-title">Időpont foglalása</span>
            <button class="modal-close" onclick="closeModal()">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
            </button>
        </div>
        <form method="POST" action="{{ route('appointments.store') }}">
            @csrf
            <div class="modal-body">
                <div class="form-group">
                    <label class="form-label">Jármű *</label>
                    <select name="vehicle_id" class="form-select" required>
                        <option value="">— Válassz járművet —</option>
                        @foreach($vehicles as $v)
                            <option value="{{ $v->id }}" {{ old('vehicle_id') == $v->id ? 'selected' : '' }}>
                                {{ $v->brand }} {{ $v->model }} ({{ $v->license_plate }})
                            </option>
                        @endforeach
                    </select>
                    @error('vehicle_id') <span class="form-error">{{ $message }}</span> @enderror
                </div>
                <div class="form-group">
                    <label class="form-label">Időpont dátuma *</label>
                    <input type="date" name="appointment_date" class="form-input"
                           min="{{ date('Y-m-d') }}" value="{{ old('appointment_date') }}" required>
                    @error('appointment_date') <span class="form-error">{{ $message }}</span> @enderror
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn-cancel" onclick="closeModal()">Mégse</button>
                <button type="submit" class="btn-primary">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
                    Foglalás
                </button>
            </div>
        </form>
    </div>
</div>


<div class="page-wrap">

    <div class="page-header">
        <div>
            <div class="page-tag">Időpontkezelés</div>
            <h1 class="page-title">Foglalásaim</h1>
        </div>
        @if(count($vehicles) > 0)
            <button class="btn-primary" onclick="openModal()">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
                Új időpont
            </button>
        @endif
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="16" height="16"><polyline points="20 6 9 17 4 12"/></svg>
            {{ session('success') }}
        </div>
    @endif

    @if(count($vehicles) == 0)
        <div class="alert alert-warning">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="16" height="16"><path d="M12 9v4M12 17h.01"/><path d="M10.29 3.86L1.82 18a2 2 0 001.71 3h16.94a2 2 0 001.71-3L13.71 3.86a2 2 0 00-3.42 0z"/></svg>
            Még nincs regisztrált járműved.
            <a href="{{ route('vehicles.index') }}" style="color:var(--accent);text-decoration:underline;margin-left:0.25rem">Adj hozzá egyet!</a>
        </div>
    @endif

    
    @php
        $total     = count($appointments);
        $pending   = $appointments->where('status_name', 'Függőben')->count();
        $done      = $appointments->where('status_name', 'Elvégezve')->count();
        $cancelled = $appointments->where('status_name', 'Lemondva')->count();
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
        <div class="stat-strip-item done">
            <div class="stat-strip-num">{{ $done }}</div>
            <div class="stat-strip-label">Elvégezve</div>
        </div>
        <div class="stat-strip-item cancelled">
            <div class="stat-strip-num">{{ $cancelled }}</div>
            <div class="stat-strip-label">Lemondva</div>
        </div>
    </div>

 
    <div class="table-container">
        <div class="table-toolbar">
            <span class="table-toolbar-title">Foglalások</span>
            <span class="table-count-badge">{{ $total }}</span>
        </div>

        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Dátum</th>
                    <th>Jármű</th>
                    <th>Státusz</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @forelse($appointments as $a)
                    @php
                        $sc = match($a->status_name) {
                            'Függőben'      => 's-pending',
                            'Visszaigazolt' => 's-confirmed',
                            'Elvégezve'     => 's-completed',
                            'Lemondva'      => 's-cancelled',
                            default         => 's-default',
                        };
                        $dt = \Carbon\Carbon::parse($a->appointment_date);
                    @endphp
                    <tr>
                        <td><span class="row-id">#{{ $a->id }}</span></td>
                        <td>
                            <div class="date-block">
                                <div class="date-cal">
                                    <div class="date-cal-month">{{ $dt->format('M') }}</div>
                                    <div class="date-cal-day">{{ $dt->format('d') }}</div>
                                </div>
                                <div>
                                    <div class="date-full">{{ $dt->format('Y. m. d.') }}</div>
                                    <div class="date-day-name">{{ $dt->translatedFormat('l') }}</div>
                                </div>
                            </div>
                        </td>
                        <td>
                            <span class="vehicle-tag">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75"><path d="M7 17H5a2 2 0 01-2-2v-4l2-5h14l2 5v4a2 2 0 01-2 2h-2"/><circle cx="7" cy="17" r="2"/><circle cx="17" cy="17" r="2"/></svg>
                                {{ $a->brand }} {{ $a->model }} · {{ $a->license_plate }}
                            </span>
                        </td>
                        <td>
                            <span class="status-dot {{ $sc }}">{{ $a->status_name ?? 'Függőben' }}</span>
                        </td>
                        <td>
                            <form method="POST" action="{{ route('appointments.destroy', $a->id) }}"
                                  onsubmit="return confirm('Biztosan törlöd ezt az időpontot?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn-del">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="3 6 5 6 21 6"/><path d="M19 6l-1 14H6L5 6"/></svg>
                                    Törlés
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr class="empty-row">
                        <td colspan="5">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.25"><rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                            <p>Nincs még foglalt időpontod</p>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</div>

<script>
    function openModal()  { document.getElementById('addModal').classList.add('open'); }
    function closeModal() { document.getElementById('addModal').classList.remove('open'); }
    document.getElementById('addModal').addEventListener('click', function(e) {
        if (e.target === this) closeModal();
    });
</script>

</x-layout>