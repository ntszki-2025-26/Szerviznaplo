<x-layout>
<x-navbar title="Felhasználók kezelése" />
<div class="max-w-6xl mx-auto px-6 py-8">

    <div class="mb-8">
        <div class="text-xs font-semibold uppercase tracking-widest text-indigo-400 mb-1">Admin felület</div>
        <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Felhasználók kezelése</h1>
    </div>

    @if(session('success'))
        <div class="flex items-center gap-2 bg-green-50 border border-green-200 text-green-700 rounded-xl px-4 py-3 mb-6 text-sm">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="16" height="16"><polyline points="20 6 9 17 4 12"/></svg>
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white dark:bg-gray-900 rounded-2xl border border-gray-200 dark:border-gray-700 overflow-hidden shadow-sm">
        <div class="flex items-center justify-between px-6 py-4 border-b border-gray-100 dark:border-gray-800">
            <span class="font-semibold text-gray-800 dark:text-gray-100">Összes felhasználó</span>
            <span class="bg-indigo-100 text-indigo-700 text-xs font-bold px-2.5 py-1 rounded-full">{{ count($users) }}</span>
        </div>

        <table class="w-full text-sm">
            <thead>
                <tr class="text-xs uppercase tracking-wider text-gray-400 border-b border-gray-100 dark:border-gray-800">
                    <th class="text-left px-6 py-3">#</th>
                    <th class="text-left px-6 py-3">Felhasználó</th>
                    <th class="text-left px-6 py-3">Email</th>
                    <th class="text-left px-6 py-3">Szerepkör</th>
                    <th class="text-left px-6 py-3">Műveletek</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100 dark:divide-gray-800">
                @forelse($users as $user)
                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-800 transition-colors">
                        <td class="px-6 py-4 text-gray-400 font-mono">#{{ $user->id }}</td>
                        <td class="px-6 py-4">
                            <div class="font-medium text-gray-900 dark:text-white">{{ $user->username }}</div>
                            @if($user->first_name || $user->last_name)
                                <div class="text-xs text-gray-400">{{ $user->first_name }} {{ $user->last_name }}</div>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-gray-500 dark:text-gray-400">{{ $user->email }}</td>
                        <td class="px-6 py-4">
                            <form action="{{ route('admin.users.role', $user) }}" method="POST">
                                @csrf
                                <select
                                    name="role"
                                    onchange="this.form.submit()"
                                    class="text-sm rounded-lg border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-900 text-gray-700 dark:text-gray-200 px-3 py-1.5 focus:outline-none focus:ring-2 focus:ring-indigo-400 cursor-pointer"
                                >
                                    <option value="{{ App\Models\User::ROLE_USER }}"
                                        @selected($user->role === App\Models\User::ROLE_USER)>
                                        👤 User
                                    </option>
                                    <option value="{{ App\Models\User::ROLE_MECHANIC }}"
                                        @selected($user->role === App\Models\User::ROLE_MECHANIC)>
                                        🔧 Mechanic
                                    </option>
                                    <option value="{{ App\Models\User::ROLE_ADMIN }}"
                                        @selected($user->role === App\Models\User::ROLE_ADMIN)>
                                        🛡️ Admin
                                    </option>
                                </select>
                            </form>
                        </td>
                        <td class="px-6 py-4">
                            <form action="{{ route('admin.users.destroy', $user) }}" method="POST"
                                  onsubmit="return confirm('Biztosan törlöd {{ $user->username }} profilját?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="text-xs text-red-400 border border-red-400/30 px-3 py-1.5 rounded-lg hover:bg-red-400/10 transition-colors">
                                    Törlés
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-6 py-12 text-center text-gray-400">Nincs felhasználó</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

</x-layout>