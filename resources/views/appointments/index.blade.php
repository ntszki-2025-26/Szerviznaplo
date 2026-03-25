<x-layout sitecss="appointments">
    <x-navbar title="Időpontok">
    </x-navbar>
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