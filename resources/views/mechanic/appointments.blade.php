<x-layout sitecss="mechanic_appointments">

<div class="topbar">
    <div class="topbar-left">
        <a href="{{ route('home') }}" class="topbar-logo">Szerviz<span>napló</span></a>
        <span class="role-badge">Szerelő</span>
        <div class="topbar-divider"></div>
        <nav class="topbar-nav">
            <a href="{{ route('mechanic.dashboard') }}">Dashboard</a>
            <a href="{{ route('mechanic.repairs') }}">Javítások</a>
            <a href="{{ route('mechanic.faults') }}">Hibák</a>
            <a href="{{ route('mechanic.appointments') }}" class="active">Időpontok</a>
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
                    <select name="status_appointments_id" class="form-select" id="statusSelect" required>
                        @foreach($statuses as $s)
                            <option value="{{ $s->id }}">{{ $s->status }}</option>
                        @endforeach
                    </select>
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
            <h1 class="page-title">Időpontok</h1>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="16" height="16"><polyline points="20 6 9 17 4 12"/></svg>
            {{ session('success') }}
        </div>
    @endif

    <div class="table-container">
        <div class="table-toolbar">
            <span class="table-toolbar-title">Összes időpont</span>
            <span class="table-count-badge">{{ count($appointments) }}</span>
        </div>
        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Dátum</th>
                    <th>Jármű</th>
                    <th>Tulajdonos</th>
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
                    @endphp
                    <tr>
                        <td><span class="row-id">#{{ $a->id }}</span></td>
                        <td><span class="date-text">{{ \Carbon\Carbon::parse($a->appointment_date)->format('Y. m. d.') }}</span></td>
                        <td>
                            <span class="vehicle-tag">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75"><path d="M7 17H5a2 2 0 01-2-2v-4l2-5h14l2 5v4a2 2 0 01-2 2h-2"/><circle cx="7" cy="17" r="2"/><circle cx="17" cy="17" r="2"/></svg>
                                {{ $a->brand }} {{ $a->model }} · {{ $a->license_plate }}
                            </span>
                        </td>
                        <td><span class="user-tag">{{ $a->username }}</span></td>
                        <td><span class="status-dot {{ $sc }}">{{ $a->status_name ?? 'Függőben' }}</span></td>
                        <td>
                            <button class="btn-edit" onclick="openModal({{ $a->id }}, '{{ $a->username }} - {{ \Carbon\Carbon::parse($a->appointment_date)->format('Y. m. d.') }}', {{ $a->status_appointments_id ?? 1 }})">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M11 4H4a2 2 0 00-2 2v14a2 2 0 002 2h14a2 2 0 002-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 013 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
                                Szerkesztés
                            </button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="empty-row">Nincs időpont</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<script>
    function openModal(id, label, statusId) {
        document.getElementById('editForm').action = '/mechanic/appointments/' + id + '/status';
        document.getElementById('modalSubtitle').textContent = label;
        document.getElementById('statusSelect').value = statusId;
        document.getElementById('editModal').classList.add('open');
    }
    function closeModal() { document.getElementById('editModal').classList.remove('open'); }
    document.getElementById('editModal').addEventListener('click', function(e) {
        if (e.target === this) closeModal();
    });
</script>

</x-layout>