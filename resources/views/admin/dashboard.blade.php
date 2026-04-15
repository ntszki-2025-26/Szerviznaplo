<x-layout>
<x-navbar title="Adminisztrációs panel" />
<div class="max-w-6xl mx-auto px-4 sm:px-6 py-8 sm:py-12">
    <div class="mb-8 sm:mb-10">
        <div class="flex items-center gap-3 mb-2">
            <div class="w-6 h-px bg-indigo-400"></div>
            <span class="text-xs font-semibold uppercase tracking-widest text-indigo-400">Admin felület</span>
        </div>
        <h1 class="text-2xl sm:text-4xl font-black uppercase tracking-tight">
            Helló, <span class="text-indigo-400">{{ Auth::user()->first_name ?? Auth::user()->username }}</span>!
        </h1>
        <p class="text-gray-400 text-sm mt-1">{{ now()->setTimezone('Europe/Budapest')->isoFormat('YYYY. MMMM D., dddd') }}</p>
    </div>
    <div class="grid grid-cols-2 sm:grid-cols-4 gap-px bg-gray-800 border border-gray-800 mb-8 sm:mb-10">
        <div class="bg-gray-900 px-5 sm:px-8 py-5 sm:py-7 hover:bg-gray-800 transition-colors">
            <div class="text-xs uppercase tracking-widest text-gray-500 mb-2 sm:mb-3">Összes felhasználó</div>
            <div class="font-mono text-3xl sm:text-4xl font-medium">{{ $totalUsers }}</div>
        </div>
        <div class="bg-gray-900 px-5 sm:px-8 py-5 sm:py-7 hover:bg-gray-800 transition-colors">
            <div class="text-xs uppercase tracking-widest text-gray-500 mb-2 sm:mb-3">Adminok</div>
            <div class="font-mono text-3xl sm:text-4xl font-medium text-indigo-400">{{ $adminCount }}</div>
        </div>
        <div class="bg-gray-900 px-5 sm:px-8 py-5 sm:py-7 hover:bg-gray-800 transition-colors">
            <div class="text-xs uppercase tracking-widest text-gray-500 mb-2 sm:mb-3">Szerelők</div>
            <div class="font-mono text-3xl sm:text-4xl font-medium text-amber-400">{{ $mechanicCount }}</div>
        </div>
        <div class="bg-gray-900 px-5 sm:px-8 py-5 sm:py-7 hover:bg-gray-800 transition-colors">
            <div class="text-xs uppercase tracking-widest text-gray-500 mb-2 sm:mb-3">Felhasználók</div>
            <div class="font-mono text-3xl sm:text-4xl font-medium text-green-400">{{ $userCount }}</div>
        </div>
    </div>
    <div class="flex items-center gap-3 mb-5">
        <span class="text-xs font-bold uppercase tracking-widest text-gray-500">Gyors elérés</span>
        <div class="flex-1 h-px bg-gray-800"></div>
    </div>
    <a href="{{ route('admin.users.index') }}"
       class="inline-flex items-center gap-2 border border-indigo-400/30 text-indigo-400 text-xs font-semibold uppercase tracking-widest px-5 py-2.5 hover:bg-indigo-400/10 transition-colors">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="w-4 h-4 shrink-0">
            <path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/>
            <circle cx="9" cy="7" r="4"/>
            <path d="M23 21v-2a4 4 0 00-3-3.87M16 3.13a4 4 0 010 7.75"/>
        </svg>
        Felhasználók kezelése
    </a>
</div>
</x-layout>