<x-layout sitecss="dashboard">
    <x-navbar title="dashboard" />
<div class="dashboard">

    
    <div class="greeting">
        <div class="greeting-tag">Üdvözöljük</div>
        <h1>Helló, <span>{{ Auth::user()->username }}</span>!</h1>
        <p class="greeting-sub">{{ now()->isoFormat('YYYY. MMMM D., dddd') }} — Jó munkát kívánunk.</p>
    </div>

  
    <div class="stats-row">
        <div class="stat-card">
            <div class="stat-card-label">Járműveim</div>
            <div class="stat-card-num">{{ $vehicleCount ?? '—' }}</div>
            <svg class="stat-card-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                <path d="M7 17H5a2 2 0 01-2-2v-4l2-5h14l2 5v4a2 2 0 01-2 2h-2"/>
                <circle cx="7" cy="17" r="2"/><circle cx="17" cy="17" r="2"/>
                <path d="M5 10h14"/>
            </svg>
        </div>
        <div class="stat-card">
            <div class="stat-card-label">Aktív hibák</div>
            <div class="stat-card-num">{{ $faultCount ?? '—' }}</div>
            <svg class="stat-card-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                <path d="M12 9v4M12 17h.01"/>
                <path d="M10.29 3.86L1.82 18a2 2 0 001.71 3h16.94a2 2 0 001.71-3L13.71 3.86a2 2 0 00-3.42 0z"/>
            </svg>
        </div>
        <div class="stat-card">
            <div class="stat-card-label">Folyamatban lévő javítás</div>
            <div class="stat-card-num">{{ $pendingRepairCount ?? '0' }}</div>
<div style="font-size:0.72rem;color:var(--muted);margin-top:0.3rem">
    {{ $pendingRepairNames ?? '' }}
</div>
            <svg class="stat-card-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                <path d="M14.7 6.3a1 1 0 000 1.4l1.6 1.6a1 1 0 001.4 0l3.77-3.77a6 6 0 01-7.94 7.94l-6.91 6.91a2.12 2.12 0 01-3-3l6.91-6.91a6 6 0 017.94-7.94l-3.76 3.76z"/>
            </svg>
        </div>
        <div class="stat-card">
            <div class="stat-card-label">Következő időpontom</div>
           <div class="stat-card-num">{{ $nextAppointmentFormatted ?? '—' }}</div>
            <svg class="stat-card-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                <rect x="3" y="4" width="18" height="18" rx="2"/>
                <line x1="16" y1="2" x2="16" y2="6"/>
                <line x1="8" y1="2" x2="8" y2="6"/>
                <line x1="3" y1="10" x2="21" y2="10"/>
            </svg>
        </div>
    </div>

   
<div class="section-title">Gyors műveletek</div>
<div class="actions-grid">
    <a href="{{ route('vehicles.index') }}" class="action-card">
        <div class="action-icon">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                <path d="M7 17H5a2 2 0 01-2-2v-4l2-5h14l2 5v4a2 2 0 01-2 2h-2"/>
                <circle cx="7" cy="17" r="2"/><circle cx="17" cy="17" r="2"/>
            </svg>
        </div>
        <div>
            <div class="action-title">Jármű hozzáadása</div>
            <div class="action-desc">Új jármű regisztrálása</div>
        </div>
    </a>
    <a href="{{ route('faults.index') }}" class="action-card" title="Hamarosan...">
        <div class="action-icon">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                <path d="M12 9v4M12 17h.01"/>
                <path d="M10.29 3.86L1.82 18a2 2 0 001.71 3h16.94a2 2 0 001.71-3L13.71 3.86a2 2 0 00-3.42 0z"/>
            </svg>
        </div>
        <div>
            <div class="action-title">Hiba bejelentése</div>
            <div class="action-desc">Fotóval és leírással</div>
        </div>
    </a>
    <a href="{{ route('appointments.index') }}" class="action-card" title="Hamarosan...">
        <div class="action-icon">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                <rect x="3" y="4" width="18" height="18" rx="2"/>
                <line x1="16" y1="2" x2="16" y2="6"/>
                <line x1="8" y1="2" x2="8" y2="6"/>
                <line x1="3" y1="10" x2="21" y2="10"/>
            </svg>
        </div>
        <div>
            <div class="action-title">Időpont foglalása</div>
            <div class="action-desc">Szerviz időpont kérése</div>
        </div>
    </a>
    <a href="{{ route('servicelog.index') }}" class="action-card" title="Hamarosan...">
        <div class="action-icon">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                <path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8z"/>
                <polyline points="14 2 14 8 20 8"/>
                <line x1="16" y1="13" x2="8" y2="13"/>
                <line x1="16" y1="17" x2="8" y2="17"/>
            </svg>
        </div>
        <div>
            <div class="action-title">Szerviznapló</div>
            <div class="action-desc">Előzmények megtekintése</div>
        </div>
    </a>
    <a href="{{ route('repairs.index') }}" class="action-card" title="Hamarosan...">
        <div class="action-icon">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                <path d="M14.7 6.3a1 1 0 000 1.4l1.6 1.6a1 1 0 001.4 0l3.77-3.77a6 6 0 01-7.94 7.94l-6.91 6.91a2.12 2.12 0 01-3-3l6.91-6.91a6 6 0 017.94-7.94l-3.76 3.76z"/>
            </svg>
        </div>
        <div>
            <div class="action-title">Javítások</div>
            <div class="action-desc">Aktív javítások állapota</div>
        </div>
    </a>
    <a href="{{ route('profile.index') }}" class="action-card">
        <div class="action-icon">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                <path d="M20 21v-2a4 4 0 00-4-4H8a4 4 0 00-4 4v2"/>
                <circle cx="12" cy="7" r="4"/>
            </svg>
        </div>
        <div>
            <div class="action-title">Profilom</div>
            <div class="action-desc">Adatok szerkesztése</div>
        </div>
    </a>
</div>

  
    <div class="section-title">Fiók adatok</div>
    <div class="info-row">
        <div class="info-box">
            <div class="info-box-title">Személyes adatok</div>
            <div class="info-item">
                <span class="info-item-label">Felhasználónév</span>
                <span class="info-item-val accent">{{ Auth::user()->username }}</span>
            </div>
            <div class="info-item">
                <span class="info-item-label">Teljes név</span>
                <span class="info-item-val">{{ Auth::user()->last_name }} {{ Auth::user()->first_name }}</span>
            </div>
            <div class="info-item">
                <span class="info-item-label">E-mail cím</span>
                <span class="info-item-val">{{ Auth::user()->email }}</span>
            </div>
        </div>
        <div class="info-box">
            <div class="info-box-title">Fiók állapot</div>
            <div class="info-item">
                <span class="info-item-label">Státusz</span>
                <span class="info-item-val"><span class="status-dot"></span>Aktív</span>
            </div>
            <div class="info-item">
                <span class="info-item-label">Jogosultság</span>
                <span class="info-item-val">{{ Auth::user()->is_admin ? 'Adminisztrátor' : 'Felhasználó' }}</span>
            </div>
            <div class="info-item">
                <span class="info-item-label">Bejelentkezve</span>
                <span class="info-item-val">{{ now()->setTimezone('Europe/Budapest')->format('H:i') }}</span>
            </div>
        </div>
    </div>

</div>
</x-layout>