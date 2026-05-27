<x-guest-layout>

    <div class="min-h-screen flex items-center justify-center px-6 bg-cover bg-center"
         style="background-image: url('{{ asset('images/pngtree-abstract-blur-hotel-lobby-picture-image_15505805.jpg') }}');">

        <div class="absolute inset-0 bg-black/50"></div>

        <div class="relative w-full max-w-md bg-white/95 backdrop-blur-md rounded-3xl shadow-2xl p-8">

            <div class="text-center mb-8">

                <h1 class="text-4xl font-bold text-orange-600">
                    La Luna Hotel
                </h1>

                <p class="text-gray-600 mt-2">
                    Login to your account
                </p>

            </div>

            <x-auth-session-status class="mb-4" :status="session('status')" />

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div>
                    <x-input-label for="email" value="Email" />

                    <x-text-input id="email"
                                  class="block mt-1 w-full rounded-xl border-orange-200 focus:border-orange-500 focus:ring-orange-500"
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
                                  class="block mt-1 w-full rounded-xl border-orange-200 focus:border-orange-500 focus:ring-orange-500"
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
                               class="rounded border-orange-300 text-orange-600 shadow-sm focus:ring-orange-500"
                               name="remember">

                        <span class="ms-2 text-sm text-gray-700">
                            Remember me
                        </span>

                    </label>

                </div>

                <div class="flex items-center justify-between mt-6">

                    @if (Route::has('password.request'))

                        <a class="text-sm text-orange-600 hover:text-orange-800"
                           href="{{ route('password.request') }}">

                            Forgot password?

                        </a>

                    @endif

                    <button class="bg-orange-600 hover:bg-orange-700 text-white px-6 py-3 rounded-xl font-semibold shadow-lg transition">

                        Log in

                    </button>

                </div>

                <div class="text-center mt-6">

                    <p class="text-sm text-gray-700">

                        Don’t have an account?

                        <a href="{{ route('register') }}"
                           class="text-orange-600 font-semibold hover:text-orange-800">

                            Register

                        </a>

                    </p>

                </div>

            </form>

        </div>

    </div>

</x-guest-layout>