<x-layout sitecss="mechanic_repairs">

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
            <button class="modal-close" onclick="closeModal('editModal')">
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
                <button type="button" class="btn-cancel" onclick="closeModal('editModal')">Mégse</button>
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
        <button class="btn-primary" onclick="openModal('addModal')" style="font-size:0.8rem;padding:0.6rem 1.25rem;">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
            Javítás létrehozása
        </button>
    </div>

    <div class="modal-backdrop" id="addModal">
        <div class="modal">
            <div class="modal-header">
                <div class="modal-title">Javítás létrehozása</div>
                <button class="modal-close" onclick="closeModal('addModal')">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
                </button>
            </div>
            <form method="POST" action="{{ route('mechanic.repairs.store') }}">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label class="form-label">Jármű *</label>
                        <select name="vehicle_id" class="form-select" required>
                            <option value="">— Válassz járművet —</option>
                            @foreach($vehicles as $v)
                                <option value="{{ $v->id }}">{{ $v->brand }} {{ $v->model }} · {{ $v->license_plate }} ({{ $v->username }})</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Státusz *</label>
                        <select name="status_repairs_id" class="form-select" required>
                            <option value="">— Válassz státuszt —</option>
                            @foreach($statuses as $s)
                                <option value="{{ $s->id }}">{{ $s->status }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Megjegyzés</label>
                        <textarea name="comment" class="form-textarea" placeholder="Javítás részletei..."></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn-cancel" onclick="closeModal('addModal')">Mégse</button>
                    <button type="submit" class="btn-primary">Létrehozás</button>
                </div>
            </form>
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
                            <button class="btn-edit" onclick="openEditModal({{ $r->id }}, '{{ $r->brand }} {{ $r->model }}', {{ $r->status_repairs_id }}, '{{ addslashes($comment === '—' ? '' : $comment) }}')">
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
    function openModal(id)  { document.getElementById(id).classList.add('open'); }
    function closeModal(id) { document.getElementById(id).classList.remove('open'); }

    function openEditModal(id, vehicle, statusId, comment) {
        document.getElementById('editForm').action = '/mechanic/repairs/' + id + '/status';
        document.getElementById('modalSubtitle').textContent = vehicle;
        document.getElementById('statusSelect').value = statusId;
        document.getElementById('commentField').value = comment;
        openModal('editModal');
    }

    document.getElementById('editModal').addEventListener('click', function(e) {
        if (e.target === this) closeModal('editModal');
    });

    document.getElementById('addModal').addEventListener('click', function(e) {
        if (e.target === this) closeModal('addModal');
    });
</script>

</x-layout>