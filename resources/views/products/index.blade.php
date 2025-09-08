<x-app-layout>
    <div class="max-w-7xl mx-auto py-10 px-6">

        <!-- Header -->
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-8">
            <h1 class="text-3xl font-extrabold text-white tracking-tight">Daftar Produk</h1>

            <!-- Search + Add -->
            <div class="flex flex-col sm:flex-row gap-3 w-full sm:w-auto">
                <!-- Search -->
                <form action="{{ route('products.index') }}" method="GET" class="flex w-full sm:w-72">
                    <input type="text" name="search" value="{{ request('search') }}"
                           placeholder="Cari produk..."
                           class="px-3 py-2 rounded-l-lg bg-gray-800 border border-gray-700 text-gray-200 text-sm w-full focus:ring-blue-500 focus:border-blue-500">
                    <button type="submit"
                            class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm rounded-r-lg transition">
                        Cari
                    </button>
                </form>

                <!-- Tambah Produk -->
                <a href="{{ route('products.create') }}"
                   class="inline-flex items-center justify-center px-5 py-2.5 bg-green-600 hover:bg-green-700 text-white text-sm font-medium rounded-lg shadow transition">
                    + Tambah Produk
                </a>
            </div>
        </div>

        <!-- Tabel Produk -->
        <div class="relative overflow-x-auto shadow-lg sm:rounded-xl border border-gray-700">
            <table class="w-full text-sm text-left text-gray-300">
                <thead class="text-xs uppercase bg-gray-900 text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-4">Gambar</th>
                        <th scope="col" class="px-6 py-4">Nama Produk</th>
                        <th scope="col" class="px-6 py-4">Kategori</th>
                        <th scope="col" class="px-6 py-4">Stok</th>
                        <th scope="col" class="px-6 py-4 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($products as $product)
                        <tr class="border-b border-gray-700 bg-gray-800 hover:bg-gray-700 transition">
                            <!-- Gambar -->
                            <td class="px-6 py-4">
                                @if($product->gambar)
                                    <img src="{{ asset($product->gambar) }}"
                                         class="w-16 h-16 rounded-lg object-cover shadow-md">
                                @else
                                    <span class="text-gray-500 italic">No Image</span>
                                @endif
                            </td>

                            <!-- Nama Produk -->
                            <td class="px-6 py-4 font-semibold text-white">
                                {{ $product->nama_produk }}
                            </td>

                            <!-- Kategori -->
                            <td class="px-6 py-4">
                                <span class="px-2 py-1 text-xs rounded bg-gray-700 text-gray-200">
                                    {{ $product->kategori }}
                                </span>
                            </td>

                            <!-- Stok -->
                            <td class="px-6 py-4">
                                <span class="px-3 py-1 rounded-full text-xs font-medium
                                    {{ $product->stok > 0 ? 'bg-green-700 text-green-200' : 'bg-red-700 text-red-200' }}">
                                    {{ $product->stok > 0 ? $product->stok . ' tersedia' : 'Habis' }}
                                </span>
                            </td>

                            <!-- Aksi -->
                            <td class="px-6 py-4 text-center space-x-2">
                                <!-- Edit -->
                                <a href="{{ route('products.edit', $product->id) }}"
                                   class="inline-flex items-center px-3 py-1.5 bg-yellow-500 hover:bg-yellow-600 text-white text-xs font-medium rounded shadow transition">
                                    Edit
                                </a>

                                <!-- Delete -->
                                <form action="{{ route('products.destroy', $product->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            onclick="return confirm('Yakin mau hapus produk ini?')"
                                            class="inline-flex items-center px-3 py-1.5 bg-red-600 hover:bg-red-700 text-white text-xs font-medium rounded shadow transition">
                                        Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr class="bg-gray-800">
                            <td colspan="5" class="px-6 py-6 text-center text-gray-400 italic">
                                Belum ada produk.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
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
    </div>
</x-app-layout>
