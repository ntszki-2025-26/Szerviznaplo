<x-layout sitecss="faults">
    <x-navbar title="Hibabejelentés">
    </x-navbar>

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