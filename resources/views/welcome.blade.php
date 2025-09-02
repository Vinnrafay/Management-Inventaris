<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

        <!-- Styles / Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="antialiased bg-gray-100 dark:bg-gray-900">
        <div class="relative sm:flex sm:justify-center sm:items-center min-h-screen 
            bg-dots-darker bg-center bg-gray-100 dark:bg-dots-lighter dark:bg-gray-900 
            selection:bg-red-500 selection:text-white">

            {{-- Login & Register --}}
            @if (Route::has('login'))
                <div class="sm:fixed sm:top-0 sm:right-0 p-6 text-right z-10">
                    @auth
                        <a href="{{ url('/dashboard') }}" 
                           class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white">
                           Dashboard
                        </a>
                    @else
                        <a href="{{ route('login') }}" 
                           class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white">
                           Log in
                        </a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" 
                               class="ml-4 font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white">
                               Register
                            </a>
                        @endif
                    @endauth
                </div>
            @endif

            <div class="max-w-7xl mx-auto p-6 lg:p-8 w-full">
                <!-- Produk Terbaru -->
                <div class="mt-16">
                    <h2 class="text-3xl font-extrabold text-gray-900 dark:text-white mb-12 text-center tracking-tight">
                        Produk Terbaru
                    </h2>

                    @if($products->count())
                        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">
                            @foreach($products as $product)
                                <div class="group relative bg-white dark:bg-gray-800 rounded-2xl shadow-md 
                                            hover:shadow-2xl transform hover:-translate-y-2 transition-all duration-300 overflow-hidden">
                                    
                                    <!-- Gambar -->
                                    @if($product->gambar)
                                        <img src="{{ asset($product->gambar) }}" 
                                             alt="{{ $product->nama_produk }}" 
                                             class="w-full h-48 object-cover group-hover:scale-105 transition-transform duration-300">
                                    @else
                                        <div class="w-full h-48 bg-gray-200 dark:bg-gray-700 flex items-center justify-center text-gray-500 italic">
                                            No Image
                                        </div>
                                    @endif

                                    <!-- Info -->
                                    <div class="p-5">
                                        <h3 class="text-lg font-bold text-gray-900 dark:text-gray-100 truncate">
                                            {{ $product->nama_produk }}
                                        </h3>
                                        <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">
                                            Kategori: {{ $product->kategori }}
                                        </p>

                                        <div class="mt-4">
                                            <span class="inline-block px-3 py-1 rounded-full text-xs font-semibold 
                                                {{ $product->stok > 0 
                                                    ? 'bg-green-100 text-green-700 dark:bg-green-700 dark:text-green-100' 
                                                    : 'bg-red-100 text-red-700 dark:bg-red-700 dark:text-red-100' }}">
                                                {{ $product->stok > 0 ? $product->stok . ' tersedia' : 'Habis' }}
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-gray-500 dark:text-gray-400 italic text-center">
                            Belum ada produk.
                        </p>
                    @endif
                </div>

            </div>
        </div>
    </body>
</html>
