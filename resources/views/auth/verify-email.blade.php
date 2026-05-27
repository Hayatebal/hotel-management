<x-guest-layout>

    <div class="min-h-screen flex items-center justify-center px-6 bg-cover bg-center"
         style="background-image: url('{{ asset('images/pngtree-abstract-blur-hotel-lobby-picture-image_15505805.jpg') }}');">

        <div class="w-full max-w-lg bg-white rounded-3xl shadow-2xl p-8">

            <div class="text-center mb-6">

                <p class="text-gray-500 mt-2">
                    Verify your email address
                </p>

            </div>

            <div class="mb-4 text-sm text-gray-600 leading-relaxed">

                Thanks for signing up!

                Before getting started, please verify your email address by clicking the link we emailed to you.

                If you didn’t receive the email, we can send another verification link.

            </div>

            @if (session('status') == 'verification-link-sent')

                <div class="mb-4 p-4 rounded-xl bg-green-100 text-green-700 text-sm font-medium">

                    A new verification link has been sent to your email address.

                </div>

            @endif

            <div class="mt-6 flex items-center justify-between gap-4">

                <!-- Resend Email -->
                <form method="POST" action="{{ route('verification.send') }}">
                    @csrf

                    <button
                        type="submit"
                        class="bg-purple-700 hover:bg-purple-800 text-white px-5 py-3 rounded-xl font-semibold shadow-lg transition duration-300">

                        Resend Verification Email

                    </button>
                </form>

                <!-- Logout -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <button
                        type="submit"
                        class="text-sm text-purple-700 hover:text-purple-900 font-semibold underline">

                        Log Out

                    </button>
                </form>

            </div>

        </div>

    </div>

</x-guest-layout>