<x-guest-layout>
    <div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-purple-950 via-purple-800 to-indigo-700 px-6">

        <div class="w-full max-w-md bg-white rounded-3xl shadow-2xl p-8">

            <div class="text-center mb-8">
                <p class="text-gray-500 mt-2">
                    Login to your account
                </p>
            </div>

            <x-auth-session-status class="mb-4" :status="session('status')" />

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div>
                    <x-input-label for="email" value="Email" />
                    <x-text-input id="email"
                                  class="block mt-1 w-full rounded-xl border-purple-200 focus:border-purple-500 focus:ring-purple-500"
                                  type="email"
                                  name="email"
                                  :value="old('email')"
                                  required
                                  autofocus
                                  autocomplete="username" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <div class="mt-4">
                    <x-input-label for="password" value="Password" />
                    <x-text-input id="password"
                                  class="block mt-1 w-full rounded-xl border-purple-200 focus:border-purple-500 focus:ring-purple-500"
                                  type="password"
                                  name="password"
                                  required
                                  autocomplete="current-password" />
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <div class="block mt-4">
                    <label for="remember_me" class="inline-flex items-center">
                        <input id="remember_me"
                               type="checkbox"
                               class="rounded border-purple-300 text-purple-700 shadow-sm focus:ring-purple-500"
                               name="remember">
                        <span class="ms-2 text-sm text-gray-600">
                            Remember me
                        </span>
                    </label>
                </div>

                <div class="flex items-center justify-between mt-6">
                    @if (Route::has('password.request'))
                        <a class="text-sm text-purple-700 hover:text-purple-900"
                           href="{{ route('password.request') }}">
                            Forgot password?
                        </a>
                    @endif

                    <button class="bg-purple-700 hover:bg-purple-800 text-white px-6 py-3 rounded-xl font-semibold shadow">
                        Log in
                    </button>
                </div>

                <div class="text-center mt-6">
                    <p class="text-sm text-gray-600">
                        Don’t have an account?
                        <a href="{{ route('register') }}" class="text-purple-700 font-semibold hover:text-purple-900">
                            Register
                        </a>
                    </p>
                </div>
            </form>

        </div>
    </div>
</x-guest-layout>s