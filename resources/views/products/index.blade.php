<x-app-layout>
    <div class="max-w-6xl mx-auto py-8 px-6">

        <!-- Header -->
        <div class="flex items-center justify-between mb-8">
            <h1 class="text-3xl font-bold text-gray-100">Daftar Produk</h1>
            <a href="{{ route('products.create') }}"
               class="inline-flex items-center px-5 py-2.5 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-lg shadow transition">
                + Tambah Produk
            </a>
        </div>

        <!-- Tabel Produk -->
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            <table class="w-full text-sm text-left text-gray-300 dark:text-gray-300">
                <thead class="text-xs uppercase bg-gray-700 text-gray-300">
                    <tr>
                        <th scope="col" class="px-6 py-3">Gambar</th>
                        <th scope="col" class="px-6 py-3">Nama Produk</th>
                        <th scope="col" class="px-6 py-3">Kategori</th>
                        <th scope="col" class="px-6 py-3">Stok</th>
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
                            <td class="px-6 py-4 text-gray-300">
                                {{ $product->kategori }}
                            </td>

                            <!-- Stok -->
                            <td class="px-6 py-4">
                                <span class="px-3 py-1 rounded-full text-xs font-medium
                                    {{ $product->stok > 0 ? 'bg-green-700 text-green-200' : 'bg-red-700 text-red-200' }}">
                                    {{ $product->stok > 0 ? $product->stok . ' tersedia' : 'Habis' }}
                                </span>
                            </td>
                        </tr>
                    @empty
                        <tr class="bg-gray-800">
                            <td colspan="4" class="px-6 py-6 text-center text-gray-400 italic">
                                Belum ada produk.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

    </div>
</x-app-layout>
