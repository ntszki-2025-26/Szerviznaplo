<x-layout sitecss="mechanic_dashboard">
<x-navbar title="dashboard" />
<div class="page-wrap">

    <div class="greeting">
        <div class="greeting-tag">Szerelői felület</div>
        <h1>Helló, <span>{{ Auth::user()->first_name ?? Auth::user()->username }}</span>!</h1>
        <p class="greeting-sub">{{ now()->setTimezone('Europe/Budapest')->isoFormat('YYYY. MMMM D., dddd') }}</p>
    </div>

    <div class="stats-row">
        <div class="stat-card">
            <div class="stat-card-label">Összes javítás</div>
            <div class="stat-card-num">{{ $totalRepairs }}</div>
        </div>
        <div class="stat-card">
            <div class="stat-card-label">Függőben</div>
            <div class="stat-card-num orange">{{ $pendingRepairs }}</div>
        </div>
        <div class="stat-card">
            <div class="stat-card-label">Folyamatban</div>
            <div class="stat-card-num blue">{{ $ongoingRepairs }}</div>
        </div>
        <div class="stat-card">
            <div class="stat-card-label">Elvégezve</div>
            <div class="stat-card-num green">{{ $doneRepairs }}</div>
        </div>
    </div>

    <div class="section-title">Legutóbbi javítások</div>

    <div class="table-container">
        <div class="table-toolbar">
            <span class="table-toolbar-title">Legutóbbi 5 javítás</span>
            <a href="{{ route('mechanic.repairs') }}" class="btn-link">Összes megtekintése</a>
        </div>
        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Jármű</th>
                    <th>Tulajdonos</th>
                    <th>Státusz</th>
                </tr>
            </thead>
            <tbody>
                @forelse($recentRepairs as $r)
                    @php
                        $sc = match($r->status_name) {
                            'Függőben'      => 's-pending',
                            'Folyamatban'   => 's-ongoing',
                            'Visszaigazolt' => 's-confirmed',
                            'Elvégezve'     => 's-completed',
                            'Lemondva'      => 's-cancelled',
                            default         => 's-default',
                        };
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
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" style="padding:2rem;text-align:center;color:var(--muted);font-size:0.88rem">Nincs javítás</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</div>

</x-layout>