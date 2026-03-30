<x-layout sitecss="servicelog">
    <x-navbar title="Szerviz előzmények" />

    <div class="page-wrap">

        <div class="page-header">
            <div>
                <div class="page-tag">Előzmények</div>
                <h1 class="page-title">Szerviz előzmények</h1>
            </div>
        </div>

        @if(count($vehicles) == 0)
            <div class="alert alert-warning">
                Még nincs regisztrált járműved.
                <a href="{{ route('vehicles.index') }}" style="color:var(--accent);text-decoration:underline;margin-left:0.25rem">Adj hozzá egyet!</a>
            </div>
        @endif

        {{-- JAVÍTÁSOK --}}
        <div class="table-container">
            <div class="table-header">
                <h2 class="table-title">Javítások</h2>
            </div>
            @if(count($repairs) > 0)
            <table class="table">
                <thead>
                    <tr>
                        <th>Jármű</th>
                        <th>Rendszám</th>
                        <th>Km állás</th>
                        <th>Státusz</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($repairs as $repair)
                    <tr>
                        <td>{{ $repair->brand }} {{ $repair->model }}</td>
                        <td>{{ $repair->license_plate }}</td>
                        <td>{{ $repair->mileage ? $repair->mileage . ' km' : '-' }}</td>
                        <td>
                            <span class="badge badge-{{ strtolower($repair->status_name) }}">
                                {{ $repair->status_name }}
                            </span>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @else
                <div class="alert alert-warning">Nincs még javítás rögzítve.</div>
            @endif
        </div>

        {{-- IDŐPONTOK --}}
        <div class="table-container">
            <div class="table-header">
                <h2 class="table-title">Időpontjaim</h2>
            </div>
            @if(count($appointments) > 0)
            <table class="table">
                <thead>
                    <tr>
                        <th>Jármű</th>
                        <th>Rendszám</th>
                        <th>Időpont dátuma</th>
                        <th>Státusz</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($appointments as $appointment)
                    <tr>
                        <td>{{ $appointment->brand }} {{ $appointment->model }}</td>
                        <td>{{ $appointment->license_plate }}</td>
                        <td>{{ \Carbon\Carbon::parse($appointment->appointment_date)->format('Y. m. d.') }}</td>
                        <td>
                            <span class="badge badge-{{ strtolower($appointment->status_name) }}">
                                {{ $appointment->status_name }}
                            </span>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @else
                <div class="alert alert-warning">Nincs még foglalt időpont.</div>
            @endif
        </div>

        {{-- HIBÁK --}}
        <div class="table-container">
            <div class="table-header">
                <h2 class="table-title">Bejelentett hibák</h2>
            </div>
            @if(count($faults) > 0)
            <table class="table">
                <thead>
                    <tr>
                        <th>Jármű</th>
                        <th>Rendszám</th>
                        <th>Kategória</th>
                        <th>Leírás</th>
                        <th>Becsült idő</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($faults as $fault)
                    <tr>
                        <td>{{ $fault->brand }} {{ $fault->model }}</td>
                        <td>{{ $fault->license_plate }}</td>
                        <td>{{ $fault->category ?? '-' }}</td>
                        <td>{{ $fault->description ?? '-' }}</td>
                        <td>{{ $fault->estimated_time ?? '-' }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @else
                <div class="alert alert-warning">Nincs még bejelentett hiba.</div>
            @endif
        </div>

    </div>
</x-layout>
