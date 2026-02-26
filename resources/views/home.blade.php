<x-layout.layout>

<section class="bg-gray-900 text-white">
    <div class="max-w-7xl mx-auto px-6 py-24 text-center">
        <h1 class="text-5xl font-bold mb-6">
            Online Autószerviz Rendszer
        </h1>
        <p class="text-xl text-gray-300 mb-8">
            Időpontfoglalás, javításkövetés és digitális szerviznapló egy helyen.
        </p>

        <div class="flex justify-center gap-4">
            <a href="{{ route('register') }}"
               class="bg-blue-600 hover:bg-blue-700 px-6 py-3 rounded-lg text-lg font-semibold">
                Regisztráció
            </a>

            <a href="{{ route('login') }}"
               class="bg-gray-700 hover:bg-gray-600 px-6 py-3 rounded-lg text-lg">
                Bejelentkezés
            </a>
        </div>
    </div>
</section>

</x-layout.layout>