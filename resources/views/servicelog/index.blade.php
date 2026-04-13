<x-layout>
<x-navbar title="Szerviz előzmények" />

<div class="max-w-[1200px] mx-auto px-8 py-12">

    <div class="mb-10 pb-6 border-b border-[#222]">
        <div class="text-[0.7rem] tracking-[0.2em] uppercase text-[#5046E6] mb-1">Előzmények</div>
        <h1 class="font-['Barlow_Condensed'] font-black text-[2.5rem] uppercase tracking-wide text-[#f0ede8]">
            Szerviz előzmények
        </h1>
    </div>

    @if(count($vehicles) == 0)
        <div class="mb-6 px-4 py-3 rounded border border-[#5046E6]/30 bg-[#5046E6]/10 text-[#5046E6] text-sm">
            Még nincs regisztrált járműved.
            <a href="{{ route('vehicles.index') }}" class="underline ml-1">Adj hozzá egyet!</a>
        </div>
    @endif

    <div class="mb-8">
        <div class="flex items-center gap-3 mb-4">
            <span class="font-['Barlow_Condensed'] font-bold text-[1rem] uppercase tracking-[0.12em] text-[#888]">Javítások</span>
            <div class="flex-1 h-px bg-[#222]"></div>
        </div>
        <div class="bg-[#121212] border border-[#222] rounded-lg overflow-hidden">
            @if(count($repairs) > 0)
            <table class="w-full border-collapse">
                <thead>
                    <tr class="border-b border-[#222]">
                        <th class="px-6 py-3 text-left text-[#888] text-[0.68rem] uppercase tracking-[0.18em] font-medium">Jármű</th>
                        <th class="px-6 py-3 text-left text-[#888] text-[0.68rem] uppercase tracking-[0.18em] font-medium">Rendszám</th>
                        <th class="px-6 py-3 text-left text-[#888] text-[0.68rem] uppercase tracking-[0.18em] font-medium">Km állás</th>
                        <th class="px-6 py-3 text-left text-[#888] text-[0.68rem] uppercase tracking-[0.18em] font-medium">Státusz</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-[#222]">
                    @foreach($repairs as $repair)
                    @php
                        $sc = match($repair->status_name) {
                            'Függőben'    => 'text-orange-400',
                            'Folyamatban' => 'text-blue-400',
                            'Elvégezve'   => 'text-[#4caf7d]',
                            'Lemondva'    => 'text-red-400',
                            default       => 'text-[#888]',
                        };
                    @endphp
                    <tr class="hover:bg-[#1a1a1a] transition-colors">
                        <td class="px-6 py-4 text-sm text-[#f0ede8]">{{ $repair->brand }} {{ $repair->model }}</td>
                        <td class="px-6 py-4 text-sm font-mono text-[#f0ede8]">{{ $repair->license_plate }}</td>
                        <td class="px-6 py-4 text-sm text-[#f0ede8]">{{ $repair->mileage ? $repair->mileage . ' km' : '-' }}</td>
                        <td class="px-6 py-4">
                            <span class="inline-flex items-center gap-2 text-sm font-medium {{ $sc }}">
                                <span class="w-1.5 h-1.5 rounded-full bg-current"></span>
                                {{ $repair->status_name }}
                            </span>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @else
                <div class="px-6 py-8 text-center text-[#555] text-sm italic">Nincs még javítás rögzítve.</div>
            @endif
        </div>
    </div>

    <div class="mb-8">
        <div class="flex items-center gap-3 mb-4">
            <span class="font-['Barlow_Condensed'] font-bold text-[1rem] uppercase tracking-[0.12em] text-[#888]">Időpontjaim</span>
            <div class="flex-1 h-px bg-[#222]"></div>
        </div>
        <div class="bg-[#121212] border border-[#222] rounded-lg overflow-hidden">
            @if(count($appointments) > 0)
            <table class="w-full border-collapse">
                <thead>
                    <tr class="border-b border-[#222]">
                        <th class="px-6 py-3 text-left text-[#888] text-[0.68rem] uppercase tracking-[0.18em] font-medium">Jármű</th>
                        <th class="px-6 py-3 text-left text-[#888] text-[0.68rem] uppercase tracking-[0.18em] font-medium">Rendszám</th>
                        <th class="px-6 py-3 text-left text-[#888] text-[0.68rem] uppercase tracking-[0.18em] font-medium">Időpont dátuma</th>
                        <th class="px-6 py-3 text-left text-[#888] text-[0.68rem] uppercase tracking-[0.18em] font-medium">Státusz</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-[#222]">
                    @foreach($appointments as $appointment)
                    @php
                        $sc = match($appointment->status_name) {
                            'Függőben'      => 'text-orange-400',
                            'Visszaigazolt' => 'text-[#5046E6]',
                            'Elvégezve'     => 'text-[#4caf7d]',
                            'Lemondva'      => 'text-red-400',
                            default         => 'text-[#888]',
                        };
                    @endphp
                    <tr class="hover:bg-[#1a1a1a] transition-colors">
                        <td class="px-6 py-4 text-sm text-[#f0ede8]">{{ $appointment->brand }} {{ $appointment->model }}</td>
                        <td class="px-6 py-4 text-sm font-mono text-[#f0ede8]">{{ $appointment->license_plate }}</td>
                        <td class="px-6 py-4 text-sm text-[#f0ede8]">{{ \Carbon\Carbon::parse($appointment->appointment_date)->format('Y. m. d.') }}</td>
                        <td class="px-6 py-4">
                            <span class="inline-flex items-center gap-2 text-sm font-medium {{ $sc }}">
                                <span class="w-1.5 h-1.5 rounded-full bg-current"></span>
                                {{ $appointment->status_name }}
                            </span>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @else
                <div class="px-6 py-8 text-center text-[#555] text-sm italic">Nincs még foglalt időpont.</div>
            @endif
        </div>
    </div>

    {{-- HIBÁK --}}
    <div class="mb-8">
        <div class="flex items-center gap-3 mb-4">
            <span class="font-['Barlow_Condensed'] font-bold text-[1rem] uppercase tracking-[0.12em] text-[#888]">Bejelentett hibák</span>
            <div class="flex-1 h-px bg-[#222]"></div>
        </div>
        <div class="bg-[#121212] border border-[#222] rounded-lg overflow-hidden">
            @if(count($faults) > 0)
            <table class="w-full border-collapse">
                <thead>
                    <tr class="border-b border-[#222]">
                        <th class="px-6 py-3 text-left text-[#888] text-[0.68rem] uppercase tracking-[0.18em] font-medium">Jármű</th>
                        <th class="px-6 py-3 text-left text-[#888] text-[0.68rem] uppercase tracking-[0.18em] font-medium">Rendszám</th>
                        <th class="px-6 py-3 text-left text-[#888] text-[0.68rem] uppercase tracking-[0.18em] font-medium">Kategória</th>
                        <th class="px-6 py-3 text-left text-[#888] text-[0.68rem] uppercase tracking-[0.18em] font-medium">Leírás</th>
                        <th class="px-6 py-3 text-left text-[#888] text-[0.68rem] uppercase tracking-[0.18em] font-medium">Becsült idő</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-[#222]">
                    @foreach($faults as $fault)
                    <tr class="hover:bg-[#1a1a1a] transition-colors">
                        <td class="px-6 py-4 text-sm text-[#f0ede8]">{{ $fault->brand }} {{ $fault->model }}</td>
                        <td class="px-6 py-4 text-sm font-mono text-[#f0ede8]">{{ $fault->license_plate }}</td>
                        <td class="px-6 py-4 text-sm text-[#f0ede8]">{{ $fault->category ?? '-' }}</td>
                        <td class="px-6 py-4 text-sm text-[#f0ede8]">{{ $fault->description ?? '-' }}</td>
                        <td class="px-6 py-4 text-sm text-[#f0ede8]">{{ $fault->estimated_time ?? '-' }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @else
                <div class="px-6 py-8 text-center text-[#555] text-sm italic">Nincs még bejelentett hiba.</div>
            @endif
        </div>
    </div>

</div>
</x-layout>