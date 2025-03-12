<x-guest-layout>
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gradient-to-b from-indigo-50 to-white">
        <div class="w-full sm:max-w-md px-6 py-4 bg-white shadow-lg rounded-2xl overflow-hidden">
            <div class="mb-8 text-center">
                <h1 class="text-2xl font-jakarta font-bold text-indigo-600 mb-2">✓ Checkmate</h1>
                <p class="text-gray-600 font-inter">Buat akun baru untuk memulai</p>
            </div>

            <form method="POST" action="{{ route('register') }}" class="space-y-6">
                @csrf

                <!-- Name -->
                <div>
                    <x-input-label for="name" :value="__('Nama Lengkap')" class="font-inter text-gray-700 text-sm tracking-wide" />
                    <x-text-input id="name" 
                                 class="block mt-2 w-full px-4 py-3 rounded-xl border-gray-200 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 transition-colors duration-200 font-inter" 
                                 type="text" 
                                 name="name" 
                                 :value="old('name')" 
                                 required 
                                 autofocus 
                                 autocomplete="name" 
                                 placeholder="Masukkan nama lengkap Anda" />
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>

                <!-- Email Address -->
                <div>
                    <x-input-label for="email" :value="__('Email')" class="font-inter text-gray-700 text-sm tracking-wide" />
                    <x-text-input id="email" 
                                 class="block mt-2 w-full px-4 py-3 rounded-xl border-gray-200 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 transition-colors duration-200 font-inter" 
                                 type="email" 
                                 name="email" 
                                 :value="old('email')" 
                                 required 
                                 autocomplete="username" 
                                 placeholder="nama@email.com" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <!-- Password -->
                <div>
                    <x-input-label for="password" :value="__('Password')" class="font-inter text-gray-700 text-sm tracking-wide" />
                    <x-text-input id="password" 
                                 class="block mt-2 w-full px-4 py-3 rounded-xl border-gray-200 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 transition-colors duration-200 font-inter"
                                 type="password"
                                 name="password"
                                 required 
                                 autocomplete="new-password"
                                 placeholder="Minimal 8 karakter" />
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <!-- Confirm Password -->
                <div>
                    <x-input-label for="password_confirmation" :value="__('Konfirmasi Password')" class="font-inter text-gray-700 text-sm tracking-wide" />
                    <x-text-input id="password_confirmation" 
                                 class="block mt-2 w-full px-4 py-3 rounded-xl border-gray-200 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 transition-colors duration-200 font-inter"
                                 type="password"
                                 name="password_confirmation" 
                                 required 
                                 autocomplete="new-password"
                                 placeholder="Masukkan ulang password" />
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                </div>

                <div class="flex flex-col space-y-4 sm:flex-row sm:items-center sm:justify-between sm:space-y-0 mt-8">
                    <a class="text-sm text-gray-600 hover:text-indigo-600 font-inter tracking-wide transition duration-200" href="{{ route('login') }}">
                        {{ __('Sudah punya akun?') }}
                    </a>

                    <button type="submit" class="w-full sm:w-auto px-8 py-3 bg-indigo-600 text-white font-medium rounded-full hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition duration-200 font-jakarta tracking-wide">
                        {{ __('Daftar') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>
