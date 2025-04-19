<x-guest-layout>
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gradient-to-b from-indigo-50 to-white">
        <div class="w-full sm:max-w-md px-6 py-4 bg-white shadow-lg rounded-2xl overflow-hidden">
            <div class="mb-8 text-center">
                <h1 class="text-2xl font-jakarta font-bold text-indigo-600 mb-2">✓ Checkmate</h1>
                <p class="text-gray-600 font-inter">Selamat datang kembali</p>
            </div>

            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />

            <form method="POST" action="{{ route('login') }}" class="space-y-6">
                @csrf

                <!-- Email Address -->
                <div>
                    <x-input-label for="email" :value="__('Email')" class="font-inter text-gray-700 text-sm tracking-wide" />
                    <x-text-input id="email"
                                 class="block mt-2 w-full px-4 py-3 rounded-xl border-gray-200 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 transition-colors duration-200 font-inter"
                                 type="email"
                                 name="email"
                                 :value="old('email')"
                                 required
                                 autofocus
                                 autocomplete="username"
                                 placeholder="nama@email.com" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <!-- Password -->
                <div class="mt-4">
                    <x-input-label for="password" :value="__('Password')" class="font-inter text-gray-700 text-sm tracking-wide" />
                    <x-text-input id="password"
                                 class="block mt-2 w-full px-4 py-3 rounded-xl border-gray-200 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 transition-colors duration-200 font-inter"
                                 type="password"
                                 name="password"
                                 required
                                 autocomplete="current-password"
                                 placeholder="Masukkan password" />
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

            
                <div class="flex flex-col space-y-4 sm:flex-row sm:items-center sm:justify-between sm:space-y-0 mt-8">
                    <a class="text-sm text-gray-600 hover:text-indigo-600 font-inter tracking-wide transition duration-200"
                       href="{{ route('register') }}">
                        {{ __('Belum punya akun?') }}
                    </a>

                    <button type="submit"
                            class="w-full sm:w-auto px-8 py-3 bg-indigo-600 text-white font-medium rounded-full hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition duration-200 font-jakarta tracking-wide">
                        {{ __('Masuk') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>
