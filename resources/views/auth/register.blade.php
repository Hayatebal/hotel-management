<x-guest-layout>
    <div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-purple-950 via-purple-800 to-indigo-700 px-6">

        <div class="w-full max-w-md bg-white rounded-3xl shadow-2xl p-8">

            <div class="text-center mb-8">
                <p class="text-gray-500 mt-2">
                    Create your account
                </p>
            </div>

            <form method="POST" action="{{ route('register') }}">
                @csrf

                <div>
                    <x-input-label for="name" value="Name" />
                    <x-text-input id="name"
                                  class="block mt-1 w-full rounded-xl border-purple-200 focus:border-purple-500 focus:ring-purple-500"
                                  type="text"
                                  name="name"
                                  :value="old('name')"
                                  required
                                  autofocus
                                  autocomplete="name" />
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>

                <div class="mt-4">
                    <x-input-label for="email" value="Email" />
                    <x-text-input id="email"
                                  class="block mt-1 w-full rounded-xl border-purple-200 focus:border-purple-500 focus:ring-purple-500"
                                  type="email"
                                  name="email"
                                  :value="old('email')"
                                  required
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
                                  autocomplete="new-password" />
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <div class="mt-4">
                    <x-input-label for="password_confirmation" value="Confirm Password" />
                    <x-text-input id="password_confirmation"
                                  class="block mt-1 w-full rounded-xl border-purple-200 focus:border-purple-500 focus:ring-purple-500"
                                  type="password"
                                  name="password_confirmation"
                                  required
                                  autocomplete="new-password" />
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                </div>

                <div class="flex items-center justify-between mt-6">
                    <a class="text-sm text-purple-700 hover:text-purple-900"
                       href="{{ route('login') }}">
                        Already registered?
                    </a>

                    <button class="bg-purple-700 hover:bg-purple-800 text-white px-6 py-3 rounded-xl font-semibold shadow">
                        Register
                    </button>
                </div>
            </form>

        </div>
    </div>
</x-guest-layout>