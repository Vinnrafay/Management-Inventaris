<x-app-layout>
    <div class="max-w-3xl mx-auto py-8 px-6">
        <!-- Header -->
        <h1 class="text-2xl font-bold text-gray-100 mb-6">Tambah Produk</h1>

        <!-- Form -->
        <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data"
              class="bg-gray-800 rounded-lg shadow p-6 space-y-6">
            @csrf

            <!-- Nama Produk -->
            <div>
                <label for="nama_produk" class="block mb-2 text-sm font-medium text-gray-200">Nama Produk</label>
                <input type="text" name="nama_produk" id="nama_produk"
                       class="bg-gray-700 border border-gray-600 text-gray-200 text-sm rounded-lg block w-full p-2.5 focus:ring-blue-500 focus:border-blue-500"
                       placeholder="Masukkan nama produk" value="{{ old('nama_produk') }}" required>
                @error('nama_produk')
                    <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                @enderror
            </div>

            <!-- Kategori -->
            <div>
                <label for="kategori" class="block mb-2 text-sm font-medium text-gray-200">Kategori</label>
                <input type="text" name="kategori" id="kategori"
                       class="bg-gray-700 border border-gray-600 text-gray-200 text-sm rounded-lg block w-full p-2.5 focus:ring-blue-500 focus:border-blue-500"
                       placeholder="Contoh: Elektronik, Fashion" value="{{ old('kategori') }}" required>
                @error('kategori')
                    <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                @enderror
            </div>

            <!-- Stok -->
            <div>
                <label for="stok" class="block mb-2 text-sm font-medium text-gray-200">Stok</label>
                <input type="number" name="stok" id="stok"
                       class="bg-gray-700 border border-gray-600 text-gray-200 text-sm rounded-lg block w-full p-2.5 focus:ring-blue-500 focus:border-blue-500"
                       placeholder="Jumlah stok" value="{{ old('stok') }}" required>
                @error('stok')
                    <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                @enderror
            </div>

            <!-- Gambar -->
            <div>
                <label for="gambar" class="block mb-2 text-sm font-medium text-gray-200">Upload Gambar</label>
                <input type="file" name="gambar" id="gambar"
                       class="block w-full text-sm text-gray-200 border border-gray-600 rounded-lg cursor-pointer bg-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                @error('gambar')
                    <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                @enderror
            </div>

            <!-- Tombol -->
            <div class="flex justify-end gap-3">
                <a href="{{ route('products.index') }}"
                   class="px-4 py-2 rounded-lg bg-gray-600 hover:bg-gray-500 text-white text-sm transition">
                    Batal
                </a>
                <button type="submit"
                        class="px-4 py-2 rounded-lg bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium transition">
                    Simpan Produk
                </button>
            </div>
        </form>
    </div>
</x-app-layout>
