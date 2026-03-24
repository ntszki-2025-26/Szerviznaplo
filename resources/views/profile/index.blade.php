blade

<x-layout>
    <x-navbar title="Profilom" />

    <div class="max-w-[1000px] mx-auto px-8 py-12">

        <div class="mb-10 pb-6 border-b border-[#222]">
            <div class="text-[0.7rem] tracking-[0.2em] uppercase text-[#5046E6] mb-1">Fiók</div>
            <h1 class="font-['Barlow_Condensed'] font-black text-[2.5rem] uppercase tracking-wide">
                Profilom
            </h1>
        </div>

        <div class="flex flex-wrap bg-[#121212] border border-[#222] rounded-lg p-8 mb-6 gap-8 items-center">

            <div class="flex items-center gap-6 flex-1 min-w-[250px]">
                <div class="w-20 h-20 rounded-full bg-gradient-to-br from-[#5046E6] to-[#7c73ff] flex items-center justify-center font-['Barlow_Condensed'] font-bold text-[1.8rem] text-[#0a0a0a] shrink-0">
                    {{ strtoupper(substr(Auth::user()->first_name ?? Auth::user()->username, 0, 1)) }}
                </div>
                <div class="flex flex-col gap-1">
                    <div class="text-2xl font-bold">
                        {{ Auth::user()->last_name }} {{ Auth::user()->first_name }}
                    </div>
                    <div class="text-[0.85rem] text-[#888]">
                        {{ Auth::user()->email }}
                    </div>
                    <div class="text-[0.75rem] text-[#888] tracking-[0.1em] uppercase mt-1">
                        {{ Auth::user()->is_admin ? 'Adminisztrátor' : 'Felhasználó' }}
                    </div>
                </div>
            </div>

            <div class="flex gap-3 flex-wrap">
                <button type="button"
                    class="px-6 py-[0.7rem] rounded bg-[#5046E6] text-[#0a0a0a] font-['Barlow_Condensed'] font-semibold text-sm uppercase tracking-[0.08em] cursor-pointer transition-all duration-200 hover:bg-[#7c73ff] hover:-translate-y-px">
                    Profil módosítása
                </button>
                <button type="button"
                    class="px-6 py-[0.7rem] rounded bg-transparent border border-[#222] text-[#888] font-['Barlow_Condensed'] font-semibold text-sm uppercase tracking-[0.08em] cursor-pointer transition-all duration-200 hover:border-[#c0392b] hover:text-[#c0392b] hover:-translate-y-px">
                    Fiók törlése
                </button>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">

            <div class="bg-[#121212] border border-[#222] rounded-lg p-6">
                <div class="text-[0.7rem] tracking-[0.2em] uppercase text-[#888] mb-4">Személyes adatok</div>
                <div class="flex justify-between items-center py-3 border-b border-[#222] text-[0.88rem]">
                    <span class="text-[#888]">Felhasználónév</span>
                    <span class="text-[#5046E6]">{{ Auth::user()->username }}</span>
                </div>
                <div class="flex justify-between items-center py-3 border-b border-[#222] text-[0.88rem]">
                    <span class="text-[#888]">Teljes név</span>
                    <span>{{ Auth::user()->last_name }} {{ Auth::user()->first_name }}</span>
                </div>
                <div class="flex justify-between items-center py-3 text-[0.88rem]">
                    <span class="text-[#888]">E-mail cím</span>
                    <span>{{ Auth::user()->email }}</span>
                </div>
            </div>

            <div class="bg-[#121212] border border-[#222] rounded-lg p-6">
                <div class="text-[0.7rem] tracking-[0.2em] uppercase text-[#888] mb-4">Fiók állapot</div>
                <div class="flex justify-between items-center py-3 border-b border-[#222] text-[0.88rem]">
                    <span class="text-[#888]">Státusz</span>
                    <span class="flex items-center gap-2">
                        <span class="w-2 h-2 rounded-full bg-[#4caf7d] inline-block"></span>
                        Aktív
                    </span>
                </div>
                <div class="flex justify-between items-center py-3 border-b border-[#222] text-[0.88rem]">
                    <span class="text-[#888]">Jogosultság</span>
                    <span>{{ Auth::user()->is_admin ? 'Adminisztrátor' : 'Felhasználó' }}</span>
                </div>
                <div class="flex justify-between items-center py-3 text-[0.88rem]">
                    <span class="text-[#888]">Regisztráció</span>
                    <span>{{ Auth::user()->created_at->format('Y. m. d.') }}</span>
                </div>
            </div>
        </div>

        <div class="bg-[#121212] border border-[#222] rounded-lg p-6">
            <div class="text-[0.7rem] tracking-[0.2em] uppercase text-[#888] mb-4">Járműveid</div>
            <table class="w-full border-collapse">
                <thead>
                    <tr>
                        <th class="px-4 py-3 border-b border-[#222] text-left text-[#888] text-[0.75rem] uppercase tracking-[0.1em] font-medium">Gyártmány</th>
                        <th class="px-4 py-3 border-b border-[#222] text-left text-[#888] text-[0.75rem] uppercase tracking-[0.1em] font-medium">Modell</th>
                        <th class="px-4 py-3 border-b border-[#222] text-left text-[#888] text-[0.75rem] uppercase tracking-[0.1em] font-medium">Rendszám</th>
                        <th class="px-4 py-3 border-b border-[#222] text-left text-[#888] text-[0.75rem] uppercase tracking-[0.1em] font-medium">Évjárat</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="hover:bg-[#1a1a1a] transition-colors duration-150">
                        <td class="px-4 py-3 border-b border-[#222] text-[#555] italic text-sm" colspan="4">
                            Még nem adtál hozzá járművet.
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

    </div>
</x-layout>