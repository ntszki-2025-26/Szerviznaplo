<x-layout>
<div class="min-h-screen flex items-center justify-center 
            bg-gradient-to-br from-slate-900 via-indigo-900 to-slate-800 px-4 py-10">

    <div class="w-full max-w-3xl bg-white/10 backdrop-blur-lg 
                rounded-2xl shadow-2xl p-10 border border-white/20">

        <h2 class="text-center text-3xl font-bold text-white mb-8">
            Create your account
        </h2>

        <form method="POST" action="{{ route('register.store') }}" 
              class="grid grid-cols-1 md:grid-cols-2 gap-6">
            @csrf

            <div>
                <label class="block text-sm font-medium text-gray-200">
                    Username
                </label>
                <input type="text" name="username" required
                    class="mt-2 w-full rounded-lg bg-white/5 px-4 py-3 text-white
                           border border-white/10 focus:border-indigo-500
                           focus:ring-2 focus:ring-indigo-500 outline-none
                           transition placeholder-gray-400"
                    placeholder="Enter username">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-200">
                    Email
                </label>
                <input type="email" name="email" required
                    class="mt-2 w-full rounded-lg bg-white/5 px-4 py-3 text-white
                           border border-white/10 focus:border-indigo-500
                           focus:ring-2 focus:ring-indigo-500 outline-none
                           transition placeholder-gray-400"
                    placeholder="Enter email">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-200">
                    First Name
                </label>
                <input type="text" name="first_name" required
                    class="mt-2 w-full rounded-lg bg-white/5 px-4 py-3 text-white
                           border border-white/10 focus:border-indigo-500
                           focus:ring-2 focus:ring-indigo-500 outline-none
                           transition placeholder-gray-400"
                    placeholder="First name">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-200">
                    Last Name
                </label>
                <input type="text" name="last_name" required
                    class="mt-2 w-full rounded-lg bg-white/5 px-4 py-3 text-white
                           border border-white/10 focus:border-indigo-500
                           focus:ring-2 focus:ring-indigo-500 outline-none
                           transition placeholder-gray-400"
                    placeholder="Last name">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-200">
                    Password
                </label>
                <input type="password" name="password" required
                    class="mt-2 w-full rounded-lg bg-white/5 px-4 py-3 text-white
                           border border-white/10 focus:border-indigo-500
                           focus:ring-2 focus:ring-indigo-500 outline-none
                           transition placeholder-gray-400"
                    placeholder="Enter password">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-200">
                    Confirm Password
                </label>
                <input type="password" name="password_confirmation" required
                    class="mt-2 w-full rounded-lg bg-white/5 px-4 py-3 text-white
                           border border-white/10 focus:border-indigo-500
                           focus:ring-2 focus:ring-indigo-500 outline-none
                           transition placeholder-gray-400"
                    placeholder="Repeat password">
            </div>

            <div class="md:col-span-2 mt-4">
                <button type="submit"
                    class="w-full rounded-lg bg-indigo-600 py-3 font-semibold text-white
                           hover:bg-indigo-500 transition duration-200
                           shadow-lg shadow-indigo-600/30">
                    Sign Up
                </button>
            </div>

        </form>

        <p class="mt-6 text-center text-sm text-gray-300">
            Already have an account?
            <a href="/login" class="font-semibold text-indigo-400 hover:text-indigo-300">
                Sign in!
            </a>
        </p>

    </div>
</div>
</x-layout>