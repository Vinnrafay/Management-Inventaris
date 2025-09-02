<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-100 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg p-8">

                <!-- Header Section -->
                <div class="flex items-center justify-between mb-6">
                    <h3 class="text-2xl font-bold text-white">Produk Terbaru</h3>
                    <a href="{{ route('products.index') }}" 
                       class="text-blue-400 hover:text-blue-500 text-sm font-medium transition">
                        Lihat Semua →
                    </a>
                </div>

                <!-- Produk Grid -->
                @if($products->count())
                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                        @foreach($products as $product)
                            <div class="bg-gray-700 rounded-xl shadow-md overflow-hidden hover:shadow-lg hover:bg-gray-650 transition duration-200">
                                <!-- Gambar -->
                                @if($product->gambar)
                                    <img src="{{ asset($product->gambar) }}"
                                         class="w-full h-40 object-cover">
                                @else
                                    <div class="w-full h-40 bg-gray-600 flex items-center justify-center text-gray-400 italic">
                                        No Image
                                    </div>
                                @endif

                                <!-- Info -->
                                <div class="p-4">
                                    <h4 class="text-lg font-semibold text-white truncate">{{ $product->nama_produk }}</h4>
                                    <p class="text-sm text-gray-300">Kategori: {{ $product->kategori }}</p>
                                    
                                    <p class="mt-2">
                                        <span class="px-2 py-1 rounded-full text-xs font-medium
                                            {{ $product->stok > 0 ? 'bg-green-700 text-green-200' : 'bg-red-700 text-red-200' }}">
                                            {{ $product->stok > 0 ? $product->stok . ' tersedia' : 'Habis' }}
                                        </span>
                                    </p>

                                    <p class="text-xs text-gray-400 mt-2">
                                        Ditambahkan: {{ $product->created_at->diffForHumans() }}
                                    </p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <p class="text-gray-400 italic">Belum ada produk.</p>
                @endif

            </div>
        </div>
    </div>
</x-app-layout>
