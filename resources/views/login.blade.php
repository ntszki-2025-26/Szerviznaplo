<x-layout>
    <div
        class="min-h-screen flex items-center justify-center bg-gradient-to-br from-slate-900 via-indigo-900 to-slate-800 px-4">

        <div class="w-full max-w-md bg-white/10 backdrop-blur-lg rounded-2xl shadow-2xl p-8 border border-white/20">

            <h2 class="text-center text-3xl font-bold text-white mb-8">
                Sign in to your account
            </h2>

            <form method="POST" action="{{ route('login.attempt') }}" class="space-y-6">
                @csrf

                <div>
                    <label for="email" class="block text-sm font-medium text-gray-200">
                        Email address
                    </label>
                    <input id="email" type="email" name="email" required autocomplete="email"
                        placeholder="Enter your email" class="mt-2 w-full rounded-lg bg-white/5 px-4 py-3 text-white 
                           border border-white/10 focus:border-indigo-500 
                           focus:ring-2 focus:ring-indigo-500 outline-none 
                           transition duration-200 placeholder-gray-400">
                </div>

                <div>
                    <div class="flex items-center justify-between">
                        <label for="password" class="block text-sm font-medium text-gray-200">
                            Password
                        </label>
                    </div>

                    <input id="password" type="password" name="password" required autocomplete="current-password"
                        placeholder="Enter your password" class="mt-2 w-full rounded-lg bg-white/5 px-4 py-3 text-white border border-white/10 focus:border-indigo-500 
                           focus:ring-2 focus:ring-indigo-500 outline-none 
                        transition  duration-200 placeholder-gray-400">
                </div>

                <button type="submit" class="w-full rounded-lg bg-indigo-600 py-3 font-semibold text-white 
                       hover:bg-indigo-500 transition duration-200 
                       shadow-lg shadow-indigo-600/30">
                    Sign in
                </button>
            </form>

            <p class="mt-6 text-center text-sm text-gray-300">
                Not a member?
                <a href="/register" class="font-semibold text-indigo-400 hover:text-indigo-300">
                    Register now!
                </a>
            </p>

        </div>
    </div>
</x-layout>