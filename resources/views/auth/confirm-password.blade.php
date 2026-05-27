<x-guest-layout>

    <div class="min-h-screen flex items-center justify-center px-6 bg-cover bg-center"
         style="background-image: url('{{ asset('images/pngtree-abstract-blur-hotel-lobby-picture-image_15505805.jpg') }}');">
        <div class="w-full max-w-md bg-white rounded-3xl shadow-2xl p-8">

            <div class="text-center mb-8">

                <p class="text-gray-500 mt-2">
                    Confirm your password
                </p>

            </div>

            <div class="mb-6 text-sm text-gray-600 leading-relaxed">

                This is a secure area of the application.

                Please confirm your password before continuing.

            </div>

            <form method="POST" action="{{ route('password.confirm') }}">
                @csrf

                <!-- Password -->
                <div>

                    <x-input-label for="password" value="Password" />

                    <x-text-input
                        id="password"
                        class="block mt-1 w-full rounded-xl border-purple-200 focus:border-purple-500 focus:ring-purple-500"
                        type="password"
                        name="password"
                        required
                        autocomplete="current-password" />

                    <x-input-error :messages="$errors->get('password')" class="mt-2" />

                </div>

                <!-- Button -->
                <div class="mt-6">

                    <button
                        type="submit"
                        class="w-full bg-purple-700 hover:bg-purple-800 text-white font-semibold py-3 rounded-xl shadow-lg transition duration-300">

                        Confirm Password

                    </button>

                </div>

            </form>

        </div>

    </div>

</x-guest-layout>