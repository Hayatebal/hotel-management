<x-guest-layout>

    <div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-purple-950 via-purple-800 to-indigo-700 px-6">

        <div class="w-full max-w-md bg-white rounded-3xl shadow-2xl p-8">

            <div class="text-center mb-8">
                <p class="text-gray-500 mt-2">
                    Reset your password
                </p>
            </div>

            <form method="POST" action="{{ route('password.store') }}">
                @csrf

                <!-- Password Reset Token -->
                <input type="hidden"
                       name="token"
                       value="{{ $request->route('token') }}">

                <!-- Email -->
                <div>
                    <x-input-label for="email" value="Email" />

                    <x-text-input
                        id="email"
                        class="block mt-1 w-full rounded-xl border-purple-200 focus:border-purple-500 focus:ring-purple-500"
                        type="email"
                        name="email"
                        :value="old('email', $request->email)"
                        required
                        autofocus
                        autocomplete="username" />

                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <!-- Password -->
                <div class="mt-4">
                    <x-input-label for="password" value="New Password" />

                    <x-text-input
                        id="password"
                        class="block mt-1 w-full rounded-xl border-purple-200 focus:border-purple-500 focus:ring-purple-500"
                        type="password"
                        name="password"
                        required
                        autocomplete="new-password" />

                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <!-- Confirm Password -->
                <div class="mt-4">
                    <x-input-label for="password_confirmation"
                                   value="Confirm Password" />

                    <x-text-input
                        id="password_confirmation"
                        class="block mt-1 w-full rounded-xl border-purple-200 focus:border-purple-500 focus:ring-purple-500"
                        type="password"
                        name="password_confirmation"
                        required
                        autocomplete="new-password" />

                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                </div>

                <!-- Button -->
                <div class="mt-6">
                    <button
                        type="submit"
                        class="w-full bg-purple-700 hover:bg-purple-800 text-white font-semibold py-3 rounded-xl shadow-lg transition duration-300">

                        Reset Password

                    </button>
                </div>

            </form>

        </div>

    </div>

</x-guest-layout>