<x-layout sitecss="repairs">
    <x-navbar title="Javítások">
    </x-navbar>
<style>

</style>

<div class="topbar">
    <div class="topbar-left">
        <a href="{{ route('home') }}" class="topbar-logo">Szerviz<span>napló</span></a>
        <div class="topbar-divider"></div>
        <div class="breadcrumb">
            <a href="{{ route('dashboard') }}">Dashboard</a>
            <span>/</span>
            <span class="current">Javítások</span>
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

<div class="page-wrap">

    <div class="page-header">
        <div>
            <div class="page-tag">Javításkezelés</div>
            <h1 class="page-title">Javításaim</h1>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="16" height="16"><polyline points="20 6 9 17 4 12"/></svg>
            {{ session('success') }}
        </div>
    @endif

    <div class="info-banner">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
        A javítások státuszát a szerelők kezelik. Ha kérdésed van, vedd fel velük a kapcsolatot.
    </div>

    @php
        $total   = count($repairs);
        $ongoing = $repairs->filter(fn($r) => in_array($r->status_name, ['Függőben', 'Folyamatban']))->count();
        $done    = $repairs->where('status_name', 'Elvégezve')->count();
    @endphp

    <div class="stat-strip">
        <div class="stat-strip-item total">
            <div class="stat-strip-num">{{ $total }}</div>
            <div class="stat-strip-label">Összes javítás</div>
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
                    <th>Státusz</th>
                    <th>Megjegyzés</th>
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
                        <td><span class="status-dot {{ $sc }}">{{ $r->status_name ?? '—' }}</span></td>
                        <td><span class="comment-cell">{{ $comment }}</span></td>
                    </tr>
                @empty
                    <tr class="empty-row">
                        <td colspan="4">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.25"><path d="M14.7 6.3a1 1 0 000 1.4l1.6 1.6a1 1 0 001.4 0l3.77-3.77a6 6 0 01-7.94 7.94l-6.91 6.91a2.12 2.12 0 01-3-3l6.91-6.91a6 6 0 017.94-7.94l-3.76 3.76z"/></svg>
                            <p>Nincs rögzített javítás</p>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</div>

</x-layout>