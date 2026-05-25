<x-guest-layout>

    <div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-purple-950 via-purple-800 to-indigo-700 px-6">

        <div class="w-full max-w-md bg-white rounded-3xl shadow-2xl p-8">

            <div class="text-center mb-8">

                <p class="text-gray-500 mt-2">
                    Forgot your password?
                </p>

            </div>

            <div class="mb-6 text-sm text-gray-600 leading-relaxed">

                No problem. Enter your email address and we’ll send you a password reset link so you can create a new password.

            </div>

            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />

            <form method="POST" action="{{ route('password.email') }}">
                @csrf

                <!-- Email -->
                <div>

                    <x-input-label for="email" value="Email Address" />

                    <x-text-input
                        id="email"
                        class="block mt-1 w-full rounded-xl border-purple-200 focus:border-purple-500 focus:ring-purple-500"
                        type="email"
                        name="email"
                        :value="old('email')"
                        required
                        autofocus />

                    <x-input-error :messages="$errors->get('email')" class="mt-2" />

                </div>

                <!-- Button -->
                <div class="mt-6">

                    <button
                        type="submit"
                        class="w-full bg-purple-700 hover:bg-purple-800 text-white font-semibold py-3 rounded-xl shadow-lg transition duration-300">

                        Email Password Reset Link

                    </button>

                </div>

            </form>

        </div>

    </div>

</x-guest-layout>