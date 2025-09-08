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

    <!-- Navbar -->
    @if (Route::has('login'))
        <nav class="fixed w-full top-0 left-0 bg-white/80 dark:bg-gray-800/80 backdrop-blur-md border-b border-gray-200 dark:border-gray-700 z-20">
            <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">
                <h1 class="text-lg font-bold text-gray-900 dark:text-white">
                    Peminjaman
                </h1>
                <div>
                    @auth
                        <a href="{{ url('/dashboard') }}" 
                           class="px-4 py-2 rounded-md text-sm font-medium text-gray-700 dark:text-gray-300 hover:text-blue-600 dark:hover:text-blue-400 transition">
                           Dashboard
                        </a>
                    @else
                        <a href="{{ route('login') }}" 
                           class="px-4 py-2 rounded-md text-sm font-medium text-gray-700 dark:text-gray-300 hover:text-blue-600 dark:hover:text-blue-400 transition">
                           Login
                        </a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" 
                               class="ml-2 px-4 py-2 rounded-md text-sm font-medium text-gray-700 dark:text-gray-300 hover:text-blue-600 dark:hover:text-blue-400 transition">
                               Register
                            </a>
                        @endif
                    @endauth
                </div>
            </div>
        </nav>
    @endif

    <!-- Main -->
    <main class="pt-24 max-w-7xl mx-auto px-6 lg:px-8">
        <!-- Produk Terbaru -->
        <section class="mt-8">
            <h2 class="text-3xl font-extrabold text-gray-900 dark:text-white mb-6 text-center tracking-tight">
                Produk Terbaru
            </h2>

            <!-- Search
            <div class="max-w-md mx-auto mb-10">
                <form action="{{ route('products.index') }}" method="GET" class="flex">
                    <input type="text" name="search" value="{{ request('search') }}"
                           placeholder="Cari produk..." 
                           class="w-full px-4 py-2 rounded-l-lg border border-gray-300 dark:border-gray-700 
                                  focus:ring-2 focus:ring-blue-500 dark:bg-gray-800 dark:text-gray-200">
                    <button type="submit" 
                            class="px-5 py-2 bg-blue-600 text-white font-semibold rounded-r-lg hover:bg-blue-700 transition">
                        Cari
                    </button>
                </form>
            </div> -->

            @if($products->count())
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">
                    @foreach($products as $product)
                        <div class="group relative bg-white dark:bg-gray-800 rounded-2xl shadow-md 
                                    hover:shadow-2xl hover:-translate-y-1.5 transform transition-all duration-300 overflow-hidden border border-gray-200 dark:border-gray-700">
                            
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

 <div class="mt-4 flex items-center justify-between">
    <span class="inline-block px-3 py-1 rounded-full text-xs font-semibold 
        {{ $product->stok > 0 
            ? 'bg-green-100 text-green-700 dark:bg-green-700 dark:text-green-100' 
            : 'bg-red-100 text-red-700 dark:bg-red-700 dark:text-red-100' }}">
        {{ $product->stok > 0 ? $product->stok . ' tersedia' : 'Habis' }}
    </span>

    @if($product->pinjams && $product->pinjams->count())
        <!-- Kalau lagi dipinjem -->
       <form action="{{ route('minjem.selesai', $product->pinjams->first()->id) }}" method="POST"
      onsubmit="return confirm('Yakin peminjaman produk ini sudah selesai?')">
    @csrf
    <button type="submit"
        class="px-4 py-2 bg-green-600 hover:bg-green-700 text-white rounded-lg text-sm font-medium transition">
        Selesai Minjem
    </button>
</form>
    @elseif($product->stok > 0)
        <!-- Kalau stok masih ada -->
        <a href="{{ route('form.create', $product->id) }}"
           class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg text-sm font-medium transition">
            Minjam
        </a>
    @else
        <!-- Kalau stok habis -->
        <button disabled
            class="px-4 py-2 bg-gray-400 text-white rounded-lg text-sm font-medium cursor-not-allowed">
            Stok Habis
        </button>
    @endif
</div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <p class="text-gray-500 dark:text-gray-400 italic text-center mt-6">
                    Belum ada produk.
                </p>
            @endif
        </section>
    </main>

</body>
</html>
