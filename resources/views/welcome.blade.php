<!DOCTYPE html>
<html lang="id">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Checkmate - Aplikasi Todo List Sederhana</title>
        
        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@400;500;600;700;800&family=Sora:wght@400;500;600;700;800&display=swap" rel="stylesheet">

        <!-- Styles / Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="bg-white text-gray-900 font-outfit">
        <!-- Header/Navigation -->
        <header class="w-full border-b border-gray-100">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between items-center py-6">
                    <div class="flex items-center">
                        <h1 class="text-2xl font-sora font-bold text-indigo-600">✓ Checkmate</h1>
                    </div>
                    <nav class="flex items-center gap-6">
                        @if (Route::has('login'))
                            @auth
                                <a href="{{ route('todos.index') }}" class="inline-flex items-center px-5 py-2.5 border border-transparent text-sm font-medium rounded-full text-white bg-indigo-600 hover:bg-indigo-700 transition duration-200">
                                    Dashboard
                                </a>
                            @else
                                <a href="{{ route('login') }}" class="text-gray-600 hover:text-indigo-600 font-medium transition duration-200">
                                    Masuk
                                </a>
                                @if (Route::has('register'))
                                    <a href="{{ route('register') }}" class="inline-flex items-center px-5 py-2.5 border border-transparent text-sm font-medium rounded-full text-white bg-indigo-600 hover:bg-indigo-700 transition duration-200">
                                        Daftar
                                    </a>
                                @endif
                            @endauth
                        @endif
                    </nav>
                </div>
            </div>
        </header>

        <!-- Hero Section -->
        <div class="relative overflow-hidden bg-gradient-to-b from-indigo-50 to-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-32">
                <div class="text-center">
                    <h1 class="text-4xl tracking-tight font-sora font-bold sm:text-5xl md:text-6xl">
                        <span class="block text-gray-900">Kelola Tugas Anda</span>
                        <span class="block text-indigo-600 mt-2">Dengan Lebih Mudah</span>
                    </h1>
                    <p class="mt-6 max-w-md mx-auto text-lg text-gray-600 sm:text-xl md:mt-8 md:max-w-3xl">
                        Checkmate membantu Anda mengelola tugas sehari-hari dengan lebih efisien. Sederhana, cepat, dan mudah digunakan.
                    </p>
                    <div class="mt-8 max-w-md mx-auto sm:flex sm:justify-center md:mt-10">
                        <div class="rounded-full shadow-lg">
                            <a href="{{ route('register') }}" class="w-full flex items-center justify-center px-8 py-4 border border-transparent text-base font-medium rounded-full text-white bg-indigo-600 hover:bg-indigo-700 transition duration-200 md:text-lg md:px-12">
                                Mulai Sekarang
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Features Section -->
        <div class="bg-white py-24">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center">
                    <h2 class="text-base text-indigo-600 font-semibold tracking-wide uppercase font-sora">Fitur Utama</h2>
                    <p class="mt-3 text-3xl font-sora font-bold text-gray-900 sm:text-4xl">
                        Mengapa Memilih Checkmate?
                    </p>
                </div>

                <div class="mt-20">
                    <div class="grid grid-cols-1 gap-12 sm:grid-cols-2 lg:grid-cols-3">
                        <!-- Feature 1 -->
                        <div class="group hover:scale-105 transition duration-300">
                            <div class="flow-root rounded-2xl bg-white px-6 pb-8 shadow-lg">
                                <div class="-mt-6">
                                    <div class="inline-flex items-center justify-center rounded-xl bg-indigo-600 p-3 shadow-lg group-hover:bg-indigo-700 transition duration-300">
                                        <svg class="h-6 w-6 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                        </svg>
                                    </div>
                                    <h3 class="mt-8 text-xl font-sora font-semibold text-gray-900">Sederhana</h3>
                                    <p class="mt-5 text-base text-gray-600">
                                        Antarmuka yang bersih dan mudah digunakan, fokus pada produktivitas Anda.
                                    </p>
                                </div>
                            </div>
                        </div>

                        <!-- Feature 2 -->
                        <div class="group hover:scale-105 transition duration-300">
                            <div class="flow-root rounded-2xl bg-white px-6 pb-8 shadow-lg">
                                <div class="-mt-6">
                                    <div class="inline-flex items-center justify-center rounded-xl bg-indigo-600 p-3 shadow-lg group-hover:bg-indigo-700 transition duration-300">
                                        <svg class="h-6 w-6 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                                        </svg>
                                    </div>
                                    <h3 class="mt-8 text-xl font-sora font-semibold text-gray-900">Cepat</h3>
                                    <p class="mt-5 text-base text-gray-600">
                                        Tambah, edit, dan selesaikan tugas dengan cepat tanpa loading yang lama.
                                    </p>
                                </div>
                            </div>
                        </div>

                        <!-- Feature 3 -->
                        <div class="group hover:scale-105 transition duration-300">
                            <div class="flow-root rounded-2xl bg-white px-6 pb-8 shadow-lg">
                                <div class="-mt-6">
                                    <div class="inline-flex items-center justify-center rounded-xl bg-indigo-600 p-3 shadow-lg group-hover:bg-indigo-700 transition duration-300">
                                        <svg class="h-6 w-6 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z" />
                                        </svg>
                                    </div>
                                    <h3 class="mt-8 text-xl font-sora font-semibold text-gray-900">Responsif</h3>
                                    <p class="mt-5 text-base text-gray-600">
                                        Dapat diakses dari berbagai perangkat, baik desktop maupun mobile.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <footer class="bg-gray-50 border-t border-gray-100">
            <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 md:flex md:items-center md:justify-between lg:px-8">
                <div class="flex justify-center space-x-6 md:order-2">
                    <p class="text-center text-base text-gray-500">
                        &copy; 2024 Checkmate. All rights reserved.
                    </p>
                </div>
            </div>
        </footer>
    </body>
</html>
