<x-layout sitecss="vehicles">
    <x-navbar title="Járműveim" />
<div class="modal-backdrop {{ $errors->any() ? 'open' : '' }}" id="addModal">
    <div class="modal">
        <div class="modal-header">
            <span class="modal-title">Jármű hozzáadása</span>
            <button class="modal-close" onclick="closeModal()">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/>
                </svg>
            </button>
        </div>

        <form method="POST" action="{{ route('vehicles.store') }}">
            @csrf
            <div class="modal-body">
                <div class="form-grid">

                    <div class="form-group">
                        <label class="form-label">Márka *</label>
                        <input type="text" name="brand" class="form-input" placeholder="pl. Toyota" value="{{ old('brand') }}" required>
                        @error('brand') <span class="form-error">{{ $message }}</span> @enderror
                    </div>

                    <div class="form-group">
                        <label class="form-label">Modell *</label>
                        <input type="text" name="model" class="form-input" placeholder="pl. Corolla" value="{{ old('model') }}" required>
                        @error('model') <span class="form-error">{{ $message }}</span> @enderror
                    </div>

                    <div class="form-group">
                        <label class="form-label">Évjárat *</label>
                        <input type="number" name="year" class="form-input" placeholder="{{ date('Y') }}" min="1900" max="{{ date('Y') }}" value="{{ old('year') }}" required>
                        @error('year') <span class="form-error">{{ $message }}</span> @enderror
                    </div>

                    <div class="form-group">
                        <label class="form-label">Rendszám *</label>
                        <input type="text" name="license_plate" class="form-input" placeholder="pl. ABC-123" value="{{ old('license_plate') }}" required>
                        @error('license_plate') <span class="form-error">{{ $message }}</span> @enderror
                    </div>

                    <div class="form-group">
                        <label class="form-label">Futott km *</label>
                        <input type="number" name="mileage" class="form-input" placeholder="pl. 85000" min="0" value="{{ old('mileage') }}" required>
                        @error('mileage') <span class="form-error">{{ $message }}</span> @enderror
                    </div>

                    <div class="form-group">
                        <label class="form-label">Alvázszám (VIN)</label>
                        <input type="text" name="vin" class="form-input" placeholder="Opcionális" value="{{ old('vin') }}">
                        @error('vin') <span class="form-error">{{ $message }}</span> @enderror
                    </div>

                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn-cancel" onclick="closeModal()">Mégse</button>
                <button type="submit" class="btn-primary">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/>
                    </svg>
                    Hozzáadás
                </button>
            </div>
        </form>
    </div>
</div>


<div class="page-wrap">

    <div class="page-header">
        <div>
            <div class="page-tag">Járműkezelés</div>
            <h1 class="page-title">Járműveim <span>({{ count($vehicles) }})</span></h1>
        </div>
        <button class="btn-primary" onclick="openModal()">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/>
            </svg>
            Jármű hozzáadása
        </button>
    </div>

   
    @if(session('success'))
        <div class="alert alert-success">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="18" height="18">
                <polyline points="20 6 9 17 4 12"/>
            </svg>
            {{ session('success') }}
        </div>
    @endif

    
    @if(count($vehicles) > 0)
        <div class="vehicle-grid">
            @foreach($vehicles as $vehicle)
                <div class="vehicle-card">
                    <div class="vehicle-card-top">
                        <div>
                            <div class="vehicle-name">{{ $vehicle->brand }} {{ $vehicle->model }}</div>
                            <span class="vehicle-plate">{{ $vehicle->license_plate }}</span>
                        </div>
                        <div class="vehicle-icon">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                                <path d="M7 17H5a2 2 0 01-2-2v-4l2-5h14l2 5v4a2 2 0 01-2 2h-2"/>
                                <circle cx="7" cy="17" r="2"/><circle cx="17" cy="17" r="2"/>
                                <path d="M5 10h14"/>
                            </svg>
                        </div>
                    </div>

                    <div class="vehicle-card-body">
                        <div class="vehicle-detail">
                            <span class="label">Évjárat</span>
                            <span class="value">{{ $vehicle->year }}</span>
                        </div>
                        <div class="vehicle-detail">
                            <span class="label">Futott km</span>
                            <span class="value">{{ number_format($vehicle->mileage, 0, ',', ' ') }} km</span>
                        </div>
                        @if($vehicle->vin)
                        <div class="vehicle-detail full" style="grid-column: 1/-1">
                            <span class="label">Alvázszám (VIN)</span>
                            <span class="value" style="font-size:0.8rem; letter-spacing:0.05em;">{{ $vehicle->vin }}</span>
                        </div>
                        @endif
                    </div>

                    <div class="vehicle-card-footer">
                        <form method="POST" action="{{ route('vehicles.destroy', $vehicle->id) }}"
                              onsubmit="return confirm('Biztosan törlöd ezt a járművet?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn-delete">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <polyline points="3 6 5 6 21 6"/>
                                    <path d="M19 6l-1 14H6L5 6"/>
                                    <path d="M10 11v6M14 11v6"/>
                                    <path d="M9 6V4h6v2"/>
                                </svg>
                                Törlés
                            </button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="empty-state">
            <div class="empty-icon">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                    <path d="M7 17H5a2 2 0 01-2-2v-4l2-5h14l2 5v4a2 2 0 01-2 2h-2"/>
                    <circle cx="7" cy="17" r="2"/><circle cx="17" cy="17" r="2"/>
                    <path d="M5 10h14"/>
                </svg>
            </div>
            <div class="empty-title">Még nincs járműved</div>
            <p class="empty-desc">Add hozzá az első járművedet a nyilvántartáshoz.</p>
            <button class="btn-primary" onclick="openModal()">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="16" height="16">
                    <line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/>
                </svg>
                Jármű hozzáadása
            </button>
        </div>
    @endif

</div>

<script>
    function openModal()  { document.getElementById('addModal').classList.add('open'); }
    function closeModal() { document.getElementById('addModal').classList.remove('open'); }

    
    document.getElementById('addModal').addEventListener('click', function(e) {
        if (e.target === this) closeModal();
    });
</script>

</x-layout>