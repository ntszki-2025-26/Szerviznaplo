<x-layout sitecss="mechanic_faults">

<div class="topbar">
    <div class="topbar-left">
        <a href="{{ route('home') }}" class="topbar-logo">Szerviz<span>napló</span></a>
        <span class="role-badge">Szerelő</span>
        <div class="topbar-divider"></div>
        <nav class="topbar-nav">
            <a href="{{ route('mechanic.dashboard') }}">Dashboard</a>
            <a href="{{ route('mechanic.repairs') }}">Javítások</a>
            <a href="{{ route('mechanic.faults') }}" class="active">Hibák</a>
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

<div class="page-wrap">
    <div class="page-header">
        <div>
            <div class="page-tag">Szerelői felület</div>
            <h1 class="page-title">Összes hiba</h1>
        </div>
    </div>

    <div class="table-container">
        <div class="table-toolbar">
            <span class="table-toolbar-title">Hibabejelentések</span>
            <span class="table-count-badge">{{ count($faults) }}</span>
        </div>
        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Jármű</th>
                    <th>Tulajdonos</th>
                    <th>Leírás</th>
                    <th>Kategória</th>
                    <th>Becsült idő</th>
                </tr>
            </thead>
            <tbody>
                @forelse($faults as $f)
                    @php
                        $catClass = match($f->category) {
                            'Mechanikai'  => 'cat-mechanical',
                            'Elektromos'  => 'cat-electrical',
                            'Karosszéria' => 'cat-bodywork',
                            default       => 'cat-other',
                        };
                    @endphp
                    <tr>
                        <td><span class="row-id">#{{ $f->id }}</span></td>
                        <td>
                            <span class="vehicle-tag">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75"><path d="M7 17H5a2 2 0 01-2-2v-4l2-5h14l2 5v4a2 2 0 01-2 2h-2"/><circle cx="7" cy="17" r="2"/><circle cx="17" cy="17" r="2"/></svg>
                                {{ $f->brand }} {{ $f->model }} · {{ $f->license_plate }}
                            </span>
                        </td>
                        <td><span class="user-tag">{{ $f->username }}</span></td>
                        <td>{{ $f->description }}</td>
                        <td><span class="category-badge {{ $catClass }}">{{ $f->category }}</span></td>
                        <td>{{ $f->estimated_time ?? '—' }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="empty-row">Nincs bejelentett hiba</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

</x-layout>