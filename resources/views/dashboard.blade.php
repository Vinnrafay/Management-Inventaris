<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-3xl text-white leading-tight tracking-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-gray-900/60 backdrop-blur-md overflow-hidden shadow-xl sm:rounded-2xl p-10 border border-gray-700">

                <!-- Header Section -->
                <div class="flex items-center justify-between mb-8">
                    <h3 class="text-2xl font-bold text-white">Produk Terbaru</h3>
                    <a href="{{ route('products.index') }}" 
                       class="text-blue-500 hover:text-blue-400 text-sm font-medium transition">
                        Lihat Semua →
                    </a>
                </div>

                <!-- Produk Grid -->
                @if($products->count())
                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">
                        @foreach($products as $product)
                            <div class="group bg-gray-800/90 rounded-xl shadow-md overflow-hidden hover:shadow-2xl hover:scale-[1.02] transition transform duration-200 border border-gray-700">
                                <!-- Gambar -->
                                @if($product->gambar)
                                    <img src="{{ asset($product->gambar) }}"
                                         class="w-full h-44 object-cover group-hover:opacity-90 transition">
                                @else
                                    <div class="w-full h-44 bg-gray-700 flex items-center justify-center text-gray-500 italic">
                                        No Image
                                    </div>
                                @endif

                         <!-- Info -->
                    <div class="p-5">
                        <h4 class="text-lg font-semibold text-white truncate">{{ $product->nama_produk }}</h4>
                        <p class="text-sm text-gray-400 mb-2">Kategori: {{ $product->kategori }}</p>
                        
                        <!-- Stok -->
                        <span class="px-3 py-1 inline-block rounded-full text-xs font-medium
                            {{ $product->stok > 0 ? 'bg-green-700/80 text-green-200' : 'bg-red-700/80 text-red-200' }}">
                            {{ $product->stok > 0 ? $product->stok . ' tersedia' : 'Habis' }}
                        </span>

                        <!-- Created At -->
                        <p class="text-xs text-gray-500 mt-3">
                            Ditambahkan {{ $product->created_at->diffForHumans() }}
                        </p>

                        <!-- Action Buttons -->
                        <div class="flex items-center justify-between mt-4 space-x-2">
                            <!-- Edit -->
                            <a href="{{ route('products.edit', $product->id) }}" 
                            class="flex-1 px-3 py-1.5 bg-yellow-500 hover:bg-yellow-400 text-black text-xs font-medium rounded-md text-center transition">
                                Edit
                            </a>

                            <!-- Delete -->
                            <form action="{{ route('products.destroy', $product->id) }}" method="POST" class="flex-1">
                                @csrf
                                @method('DELETE')
                                <button type="submit" 
                                    onclick="return confirm('Yakin mau hapus produk ini?')" 
                                    class="w-full px-3 py-1.5 bg-red-600 hover:bg-red-500 text-white text-xs font-medium rounded-md transition">
                                    Delete
                                </button>
                            </form>
                        </div>
                    </div>

                            </div>
                        @endforeach
                    </div>

         <!-- Pagination -->
        @if ($products->hasPages())
            <div class="mt-6 flex justify-center">
                <nav class="flex space-x-1">
                    {{-- Previous Page Link --}}
                    @if ($products->onFirstPage())
                        <span class="px-3 py-1.5 text-gray-500 bg-gray-800 rounded-md text-sm">Prev</span>
                    @else
                        <a href="{{ $products->previousPageUrl() }}" class="px-3 py-1.5 bg-gray-700 hover:bg-gray-600 text-white rounded-md text-sm transition">Prev</a>
                    @endif

                    {{-- Pagination Elements --}}
                    @foreach ($products->getUrlRange(1, $products->lastPage()) as $page => $url)
                        @if ($page == $products->currentPage())
                            <span class="px-3 py-1.5 bg-blue-600 text-white rounded-md text-sm">{{ $page }}</span>
                        @else
                            <a href="{{ $url }}" class="px-3 py-1.5 bg-gray-700 hover:bg-gray-600 text-white rounded-md text-sm transition">{{ $page }}</a>
                        @endif
                    @endforeach

                    {{-- Next Page Link --}}
                    @if ($products->hasMorePages())
                        <a href="{{ $products->nextPageUrl() }}" class="px-3 py-1.5 bg-gray-700 hover:bg-gray-600 text-white rounded-md text-sm transition">Next</a>
                    @else
                        <span class="px-3 py-1.5 text-gray-500 bg-gray-800 rounded-md text-sm">Next</span>
                    @endif
                </nav>
            </div>
        @endif
                @else
                    <div class="text-center py-12">
                        <p class="text-gray-500 italic">Belum ada produk.</p>
                    </div>
                @endif

            </div>
        </div>
    </div>
</x-app-layout>
