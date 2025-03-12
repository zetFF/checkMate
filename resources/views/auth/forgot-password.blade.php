<x-guest-layout>
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gradient-to-b from-indigo-50 to-white">
        <div class="w-full sm:max-w-md px-8 py-8 bg-white shadow-lg rounded-2xl overflow-hidden">
            <div class="mb-10 text-center">
                <h1 class="text-3xl font-jakarta font-bold text-indigo-600 mb-3">✓ Checkmate</h1>
                <p class="text-base text-gray-600 font-inter font-medium">Lupa password Anda?</p>
            </div>

            <div class="mb-8">
                <p class="text-sm text-gray-600 font-inter leading-relaxed tracking-wide">
                    {{ __('Tidak masalah. Cukup berikan alamat email Anda dan kami akan mengirimkan link untuk reset password yang memungkinkan Anda memilih yang baru.') }}
                </p>
            </div>

            <!-- Session Status -->
            <x-auth-session-status class="mb-6" :status="session('status')" />

            <form method="POST" action="{{ route('password.email') }}" class="space-y-6">
                @csrf

                <!-- Email Address -->
                <div class="space-y-2">
                    <x-input-label for="email" :value="__('Email')" class="font-inter text-sm font-medium text-gray-700 tracking-wide" />
                    <x-text-input id="email" 
                                 class="block w-full px-4 py-3.5 rounded-xl border-gray-200 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 transition-colors duration-200 font-inter text-base" 
                                 type="email" 
                                 name="email" 
                                 :value="old('email')" 
                                 required 
                                 autofocus 
                                 placeholder="nama@email.com" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2 text-sm font-medium" />
                </div>

                <div class="flex flex-col space-y-4 sm:flex-row sm:items-center sm:justify-between sm:space-y-0 pt-4">
                    <a class="text-sm text-gray-600 hover:text-indigo-600 font-inter font-medium tracking-wide transition duration-200 hover:underline" 
                       href="{{ route('login') }}">
                        {{ __('← Kembali ke halaman login') }}
                    </a>

                    <button type="submit" 
                            class="w-full sm:w-auto px-8 py-3.5 bg-indigo-600 text-white text-sm font-semibold rounded-full hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition duration-200 font-jakarta tracking-wide">
                        {{ __('Kirim Link Reset Password') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>
