@props(['title' => null])

<link href="https://fonts.googleapis.com/css2?family=Barlow+Condensed:wght@300;500;700;900&family=Barlow:wght@300;400;500&display=swap" rel="stylesheet">

<header class="flex items-center justify-between px-12 py-10 border-b border-[#222] bg-[#121212]">

    <a href="{{ route('home') }}"
       class="font-['Barlow_Condensed'] font-bold text-[1.3rem] tracking-[0.08em] uppercase no-underline text-[#f0ede8]">
        Szerviz<span class="text-[#5046E6]">Napló</span>
        @if($title)
            <span class="text-[#888] font-light text-[1rem]"> / {{ $title }}</span>
        @endif
    </a>

    <div class="flex items-center gap-6">


        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit"
                class="inline-flex items-center gap-[0.4rem] bg-transparent border border-[#222] text-[#888] font-['Barlow'] text-[0.8rem] tracking-[0.1em] uppercase px-4 py-[0.45rem] rounded-sm cursor-pointer transition-colors duration-200 hover:border-[#c0392b] hover:text-[#c0392b]">
                <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M9 21H5a2 2 0 01-2-2V5a2 2 0 012-2h4"/>
                    <polyline points="16 17 21 12 16 7"/>
                    <line x1="21" y1="12" x2="9" y2="12"/>
                </svg>
                Kilépés
            </button>
        </form>

    </div>
</header>