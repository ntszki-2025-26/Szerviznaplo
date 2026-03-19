<x-layout>
<style>
    @import url('https://fonts.googleapis.com/css2?family=Barlow+Condensed:wght@500;700;900&family=Barlow:wght@300;400;500&display=swap');

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
        padding: 1.25rem 2.5rem;
        border-bottom: 1px solid var(--border);
        background: var(--surface);
        position: sticky;
        top: 0;
        z-index: 50;
    }

    .topbar-left { display: flex; align-items: center; gap: 1.25rem; }

    .topbar-logo {
        font-family: 'Barlow Condensed', sans-serif;
        font-weight: 700; font-size: 1.3rem;
        letter-spacing: 0.08em; text-transform: uppercase;
        color: var(--text); text-decoration: none;
    }
    .topbar-logo span { color: var(--accent); }

    .topbar-divider { width: 1px; height: 20px; background: var(--border); }

    .breadcrumb { display: flex; align-items: center; gap: 0.5rem; font-size: 0.78rem; letter-spacing: 0.12em; text-transform: uppercase; }
    .breadcrumb a { color: var(--muted); text-decoration: none; transition: color 0.2s; }
    .breadcrumb a:hover { color: var(--text); }
    .breadcrumb span { color: var(--border); }
    .breadcrumb .current { color: var(--accent); }

    .topbar-right { display: flex; align-items: center; gap: 1.5rem; }

    .user-avatar {
        width: 36px; height: 36px; border-radius: 50%;
        background: linear-gradient(135deg, var(--accent), var(--accent-dim));
        display: flex; align-items: center; justify-content: center;
        font-family: 'Barlow Condensed', sans-serif;
        font-weight: 700; font-size: 0.9rem; color: #0a0a0a; text-transform: uppercase;
    }

    .user-name { font-size: 0.88rem; font-weight: 500; }

    .btn-logout {
        background: transparent; border: 1px solid var(--border);
        color: var(--muted); font-family: 'Barlow Condensed', sans-serif;
        font-weight: 500; font-size: 0.8rem; letter-spacing: 0.12em; text-transform: uppercase;
        padding: 0.45rem 1rem; border-radius: 2px; cursor: pointer;
        transition: border-color 0.2s, color 0.2s;
    }
    .btn-logout:hover { border-color: var(--red); color: var(--red); }

    /* PAGE */
    .page-wrap { max-width: 1200px; margin: 0 auto; padding: 3rem 2.5rem; }

    .page-header {
        display: flex; align-items: flex-end; justify-content: space-between;
        margin-bottom: 2.5rem; padding-bottom: 2rem; border-bottom: 1px solid var(--border);
    }

    .page-tag {
        font-size: 0.72rem; letter-spacing: 0.2em; text-transform: uppercase;
        color: var(--accent); margin-bottom: 0.5rem;
        display: flex; align-items: center; gap: 0.5rem;
    }
    .page-tag::before { content: ''; display: block; width: 1.5rem; height: 1px; background: var(--accent); }

    .page-title {
        font-family: 'Barlow Condensed', sans-serif; font-weight: 900;
        font-size: clamp(2rem, 4vw, 3rem); text-transform: uppercase;
        letter-spacing: -0.01em; line-height: 1;
    }
    .page-title span { color: var(--accent); }

   
    .btn-primary {
        background: var(--accent); color: #0a0a0a;
        font-family: 'Barlow Condensed', sans-serif;
        font-weight: 700; font-size: 0.9rem; letter-spacing: 0.15em; text-transform: uppercase;
        text-decoration: none; padding: 0.8rem 1.75rem; border-radius: 2px; border: none;
        cursor: pointer; transition: background 0.2s, transform 0.2s;
        display: inline-flex; align-items: center; gap: 0.5rem;
    }
    .btn-primary:hover { background: var(--accent-dim); transform: translateY(-1px); }
    .btn-primary svg { width: 16px; height: 16px; }

    .alert {
        padding: 1rem 1.5rem; border-radius: 2px; margin-bottom: 2rem;
        font-size: 0.88rem; display: flex; align-items: center; gap: 0.75rem;
    }
    .alert-success { background: rgba(39,174,96,0.1); border: 1px solid rgba(39,174,96,0.3); color: #2ecc71; }
    .alert-warning { background: rgba(230,126,34,0.1); border: 1px solid rgba(230,126,34,0.3); color: var(--orange); }

    
    .no-vehicles {
        padding: 2rem; border: 1px solid rgba(230,126,34,0.3);
        background: rgba(230,126,34,0.06); border-radius: 2px;
        display: flex; align-items: center; gap: 1rem;
        margin-bottom: 2rem;
    }
    .no-vehicles svg { width: 24px; height: 24px; color: var(--orange); flex-shrink: 0; }
    .no-vehicles p { font-size: 0.9rem; color: var(--orange); }
    .no-vehicles a { color: var(--accent); text-decoration: underline; }

    
    .fault-table-wrap {
        border: 1px solid var(--border);
        border-radius: 2px;
        overflow: hidden;
        margin-bottom: 3rem;
    }

    .fault-table {
        width: 100%;
        border-collapse: collapse;
    }

    .fault-table th {
        background: var(--surface);
        padding: 0.9rem 1.25rem;
        text-align: left;
        font-size: 0.7rem;
        letter-spacing: 0.18em;
        text-transform: uppercase;
        color: var(--muted);
        border-bottom: 1px solid var(--border);
        font-weight: 500;
    }

    .fault-table td {
        padding: 1rem 1.25rem;
        font-size: 0.88rem;
        border-bottom: 1px solid rgba(255,255,255,0.04);
        vertical-align: middle;
    }

    .fault-table tr:last-child td { border-bottom: none; }
    .fault-table tr:hover td { background: var(--surface); }

    .vehicle-tag {
        display: inline-flex; align-items: center; gap: 0.4rem;
        font-size: 0.78rem; color: var(--accent);
        background: rgba(232,184,75,0.08);
        border: 1px solid rgba(232,184,75,0.2);
        padding: 0.2rem 0.6rem; border-radius: 2px;
    }

    .category-badge {
        font-size: 0.72rem; letter-spacing: 0.1em; text-transform: uppercase;
        padding: 0.25rem 0.65rem; border-radius: 2px; font-weight: 500;
    }

    .cat-mechanical  { background: rgba(192,57,43,0.12);  color: #e74c3c; }
    .cat-electrical  { background: rgba(52,152,219,0.12); color: #3498db; }
    .cat-bodywork    { background: rgba(155,89,182,0.12); color: #9b59b6; }
    .cat-other       { background: rgba(136,136,136,0.12); color: var(--muted); }

    .qr-code {
        font-family: monospace; font-size: 0.72rem;
        color: var(--muted); letter-spacing: 0.05em;
    }

    .photo-thumb {
        width: 40px; height: 40px; object-fit: cover;
        border-radius: 2px; border: 1px solid var(--border);
    }

    .no-photo {
        width: 40px; height: 40px;
        background: var(--surface); border: 1px solid var(--border);
        border-radius: 2px; display: flex; align-items: center; justify-content: center;
        color: var(--border);
    }
    .no-photo svg { width: 16px; height: 16px; }

    .btn-delete {
        background: transparent; border: 1px solid var(--border);
        color: var(--muted); font-family: 'Barlow Condensed', sans-serif;
        font-size: 0.75rem; letter-spacing: 0.1em; text-transform: uppercase;
        padding: 0.35rem 0.85rem; border-radius: 2px;
        cursor: pointer; transition: border-color 0.2s, color 0.2s;
        display: inline-flex; align-items: center; gap: 0.35rem;
    }
    .btn-delete:hover { border-color: var(--red); color: var(--red); }
    .btn-delete svg { width: 12px; height: 12px; }

  
    .empty-state {
        text-align: center; padding: 5rem 2rem;
        border: 1px dashed var(--border); border-radius: 2px;
    }
    .empty-icon {
        width: 64px; height: 64px;
        background: rgba(232,184,75,0.06); border: 1px solid var(--border);
        border-radius: 50%; display: flex; align-items: center; justify-content: center;
        margin: 0 auto 1.5rem; color: var(--muted);
    }
    .empty-icon svg { width: 28px; height: 28px; }
    .empty-title { font-family: 'Barlow Condensed', sans-serif; font-weight: 700; font-size: 1.5rem; text-transform: uppercase; margin-bottom: 0.5rem; }
    .empty-desc { color: var(--muted); font-size: 0.88rem; margin-bottom: 2rem; }

   
    .modal-backdrop {
        position: fixed; inset: 0;
        background: rgba(0,0,0,0.75); backdrop-filter: blur(4px);
        z-index: 200; display: none; align-items: center; justify-content: center;
    }
    .modal-backdrop.open { display: flex; }

    .modal {
        background: var(--surface); border: 1px solid var(--border);
        border-radius: 2px; width: 100%; max-width: 560px; margin: 1rem;
        animation: modalIn 0.2s ease;
    }
    @keyframes modalIn { from { opacity: 0; transform: translateY(16px); } to { opacity: 1; transform: translateY(0); } }

    .modal-header {
        padding: 1.5rem 2rem; border-bottom: 1px solid var(--border);
        display: flex; align-items: center; justify-content: space-between;
    }
    .modal-title { font-family: 'Barlow Condensed', sans-serif; font-weight: 700; font-size: 1.3rem; text-transform: uppercase; letter-spacing: 0.05em; }
    .modal-close { background: none; border: none; color: var(--muted); cursor: pointer; transition: color 0.2s; padding: 0.25rem; }
    .modal-close:hover { color: var(--text); }
    .modal-close svg { width: 20px; height: 20px; }

    .modal-body { padding: 2rem; }

    .form-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; }
    .form-group { display: flex; flex-direction: column; gap: 0.4rem; }
    .form-group.full { grid-column: 1 / -1; }

    .form-label { font-size: 0.72rem; letter-spacing: 0.15em; text-transform: uppercase; color: var(--muted); }

    .form-input, .form-select {
        background: var(--bg); border: 1px solid var(--border);
        color: var(--text); font-family: 'Barlow', sans-serif;
        font-size: 0.9rem; padding: 0.65rem 1rem; border-radius: 2px;
        outline: none; transition: border-color 0.2s; width: 100%;
    }
    .form-input:focus, .form-select:focus { border-color: var(--accent); }
    .form-input::placeholder { color: var(--muted); }
    .form-select option { background: var(--surface); }

    .form-error { font-size: 0.75rem; color: #e74c3c; margin-top: 0.2rem; }

   
    .file-upload {
        border: 1px dashed var(--border); border-radius: 2px;
        padding: 1.5rem; text-align: center; cursor: pointer;
        transition: border-color 0.2s;
        position: relative;
    }
    .file-upload:hover { border-color: var(--accent); }
    .file-upload input { position: absolute; inset: 0; opacity: 0; cursor: pointer; width: 100%; }
    .file-upload-icon { color: var(--muted); margin-bottom: 0.5rem; }
    .file-upload-icon svg { width: 28px; height: 28px; }
    .file-upload p { font-size: 0.82rem; color: var(--muted); }
    .file-upload span { color: var(--accent); }

    .modal-footer {
        padding: 1.25rem 2rem; border-top: 1px solid var(--border);
        display: flex; justify-content: flex-end; gap: 0.75rem;
    }
    .btn-cancel {
        background: transparent; border: 1px solid var(--border);
        color: var(--muted); font-family: 'Barlow Condensed', sans-serif;
        font-size: 0.85rem; letter-spacing: 0.12em; text-transform: uppercase;
        padding: 0.7rem 1.5rem; border-radius: 2px;
        cursor: pointer; transition: border-color 0.2s, color 0.2s;
    }
    .btn-cancel:hover { border-color: var(--text); color: var(--text); }

    @media (max-width: 768px) {
        .page-wrap { padding: 2rem 1.25rem; }
        .page-header { flex-direction: column; align-items: flex-start; gap: 1.25rem; }
        .fault-table-wrap { overflow-x: auto; }
        .form-grid { grid-template-columns: 1fr; }
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
            <span class="current">Hibabejelentés</span>
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


<div class="modal-backdrop {{ $errors->any() ? 'open' : '' }}" id="addModal">
    <div class="modal">
        <div class="modal-header">
            <span class="modal-title">Hiba bejelentése</span>
            <button class="modal-close" onclick="closeModal()">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/>
                </svg>
            </button>
        </div>

        <form method="POST" action="{{ route('faults.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="modal-body">
                <div class="form-grid">

                    <div class="form-group full">
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

                    <div class="form-group full">
                        <label class="form-label">Leírás *</label>
                        <input type="text" name="description" class="form-input"
                               placeholder="Rövid leírás a hibáról..." value="{{ old('description') }}" required>
                        @error('description') <span class="form-error">{{ $message }}</span> @enderror
                    </div>

                    <div class="form-group">
                        <label class="form-label">Kategória *</label>
                        <select name="category" class="form-select" required>
                            <option value="">— Válassz —</option>
                            <option value="Mechanikai"  {{ old('category') == 'Mechanikai'  ? 'selected' : '' }}>Mechanikai</option>
                            <option value="Elektromos"  {{ old('category') == 'Elektromos'  ? 'selected' : '' }}>Elektromos</option>
                            <option value="Karosszéria" {{ old('category') == 'Karosszéria' ? 'selected' : '' }}>Karosszéria</option>
                            <option value="Egyéb"       {{ old('category') == 'Egyéb'       ? 'selected' : '' }}>Egyéb</option>
                        </select>
                        @error('category') <span class="form-error">{{ $message }}</span> @enderror
                    </div>

                    

                    <div class="form-group full">
                        <label class="form-label">Fotó (opcionális)</label>
                        <div class="file-upload">
                            <input type="file" name="photo" onchange="updateFileName(this)">
                            <div class="file-upload-icon">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                                    <path d="M21 15v4a2 2 0 01-2 2H5a2 2 0 01-2-2v-4"/>
                                    <polyline points="17 8 12 3 7 8"/>
                                    <line x1="12" y1="3" x2="12" y2="15"/>
                                </svg>
                            </div>
                            <p id="fileLabel"><span>Kattints a feltöltéshez</span> vagy húzd ide</p>
                        </div>
                        @error('photo') <span class="form-error">{{ $message }}</span> @enderror
                    </div>

                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn-cancel" onclick="closeModal()">Mégse</button>
                <button type="submit" class="btn-primary">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/>
                    </svg>
                    Bejelentés
                </button>
            </div>
        </form>
    </div>
</div>


<div class="page-wrap">

    <div class="page-header">
        <div>
            <div class="page-tag">Hibakezelés</div>
            <h1 class="page-title">Hibabejelentés <span>({{ count($faults) }})</span></h1>
        </div>
        @if(count($vehicles) > 0)
            <button class="btn-primary" onclick="openModal()">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/>
                </svg>
                Hiba bejelentése
            </button>
        @endif
    </div>

   
    @if(session('success'))
        <div class="alert alert-success">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="18" height="18">
                <polyline points="20 6 9 17 4 12"/>
            </svg>
            {{ session('success') }}
        </div>
    @endif

    

    @if(count($vehicles) == 0)
        <div class="no-vehicles">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                <path d="M12 9v4M12 17h.01"/>
                <path d="M10.29 3.86L1.82 18a2 2 0 001.71 3h16.94a2 2 0 001.71-3L13.71 3.86a2 2 0 00-3.42 0z"/>
            </svg>
            <p>Még nincs regisztrált járműved. Hibát csak meglévő járműhöz lehet bejelenteni.
                <a href="{{ route('vehicles.index') }}">Adj hozzá járművet!</a>
            </p>
        </div>
    @endif


    @if(count($faults) > 0)
        <div class="fault-table-wrap">
            <table class="fault-table">
                <thead>
                    <tr>
                        <th>Fotó</th>
                        <th>Jármű</th>
                        <th>Leírás</th>
                        <th>Kategória</th>
                        <th>QR kód</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($faults as $fault)
                        <tr>
                            <td>
                                @if($fault->photo)
                                    <img src="storage/{{ $fault->photo }}" class="photo-thumb" alt="Fotó">
                                @else
                                    <div class="no-photo">
                                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                                            <rect x="3" y="3" width="18" height="18" rx="2"/>
                                            <circle cx="8.5" cy="8.5" r="1.5"/>
                                            <polyline points="21 15 16 10 5 21"/>
                                        </svg>
                                    </div>
                                @endif
                            </td>
                            <td>
                                <span class="vehicle-tag">
                                    {{ $fault->brand }} {{ $fault->model }} · {{ $fault->license_plate }}
                                </span>
                            </td>
                            <td>{{ $fault->description }}</td>
                            <td>
                                @php
                                    $catClass = match($fault->category) {
                                        'Mechanikai'  => 'cat-mechanical',
                                        'Elektromos'  => 'cat-electrical',
                                        'Karosszéria' => 'cat-bodywork',
                                        default       => 'cat-other',
                                    };
                                @endphp
                                <span class="category-badge {{ $catClass }}">{{ $fault->category }}</span>
                            </td>
                            <td>{{ $fault->estimated_time ?? '—' }}</td>
                            <td><span class="qr-code">{{ $fault->qr_code }}</span></td>
                            <td>
                                <form method="POST" action="{{ route('faults.destroy', $fault->id) }}"
                                      onsubmit="return confirm('Biztosan törlöd ezt a hibát?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-delete">
                                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                            <polyline points="3 6 5 6 21 6"/>
                                            <path d="M19 6l-1 14H6L5 6"/>
                                            <path d="M10 11v6M14 11v6"/>
                                        </svg>
                                        Törlés
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <div class="empty-state">
            <div class="empty-icon">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                    <path d="M12 9v4M12 17h.01"/>
                    <path d="M10.29 3.86L1.82 18a2 2 0 001.71 3h16.94a2 2 0 001.71-3L13.71 3.86a2 2 0 00-3.42 0z"/>
                </svg>
            </div>
            <div class="empty-title">Nincs bejelentett hiba</div>
            <p class="empty-desc">Ha valami problémát észlelsz a járművedden, jelentsd be itt.</p>
            @if(count($vehicles) > 0)
                <button class="btn-primary" onclick="openModal()">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="16" height="16">
                        <line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/>
                    </svg>
                    Hiba bejelentése
                </button>
            @endif
        </div>
    @endif

</div>

<script>
    function openModal()  { document.getElementById('addModal').classList.add('open'); }
    function closeModal() { document.getElementById('addModal').classList.remove('open'); }

    document.getElementById('addModal').addEventListener('click', function(e) {
        if (e.target === this) closeModal();
    });

    function updateFileName(input) {
        const label = document.getElementById('fileLabel');
        if (input.files && input.files[0]) {
            label.innerHTML = '<span>' + input.files[0].name + '</span>';
        }
    }
</script>

</x-layout>