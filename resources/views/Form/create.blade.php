<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Peminjaman</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 dark:bg-gray-900 flex items-center justify-center min-h-screen">

    <div class="max-w-md w-full bg-gray-800 border border-gray-700 shadow-lg rounded-2xl p-8">
        <h2 class="text-2xl font-bold text-white mb-8 text-center">
            Form Peminjaman
        </h2>

        <form action="{{ route('form.store') }}" method="POST" class="space-y-6">
            @csrf

            <!-- Nama Produk -->
            <div>
                <label class="block text-sm font-medium text-gray-300 mb-2">
                    Nama Produk
                </label>
                <input type="text" value="{{ $product->nama_produk }}" disabled
                       class="w-full px-4 py-2 rounded-lg bg-gray-900 border border-gray-700 text-gray-200 
                              focus:ring-2 focus:ring-blue-500 focus:outline-none" />
                <input type="hidden" name="product_id" value="{{ $product->id }}">
            </div>

            <!-- Stok -->
            <div>
                <label class="block text-sm font-medium text-gray-300 mb-2">
                    Stok Tersisa
                </label>
                <input type="text" value="{{ $product->stok }}" disabled
                       class="w-full px-4 py-2 rounded-lg bg-gray-900 border border-gray-700 text-gray-200 
                              focus:ring-2 focus:ring-blue-500 focus:outline-none" />
            </div>

            <!-- Nama Peminjam -->
            <div>
                <label class="block text-sm font-medium text-gray-300 mb-2">
                    Nama Peminjam
                </label>
                <input type="text" name="nama_peminjam" required placeholder="Masukkan nama peminjam"
                       class="w-full px-4 py-2 rounded-lg bg-gray-900 border border-gray-700 text-gray-200 
                              placeholder-gray-500 focus:ring-2 focus:ring-blue-500 focus:outline-none" />
            </div>

            <!-- Waktu Pinjam -->
            <div>
                <label class="block text-sm font-medium text-gray-300 mb-2">
                    Dari Tanggal
                </label>
                <input type="date" name="waktu_pinjam" required
                       class="w-full px-4 py-2 rounded-lg bg-gray-900 border border-gray-700 text-gray-200 
                              focus:ring-2 focus:ring-blue-500 focus:outline-none" />
            </div>

            <!-- Waktu Kembali -->
            <div>
                <label class="block text-sm font-medium text-gray-300 mb-2">
                    Sampai Tanggal
                </label>
                <input type="date" name="waktu_kembali" required
                       class="w-full px-4 py-2 rounded-lg bg-gray-900 border border-gray-700 text-gray-200 
                              focus:ring-2 focus:ring-blue-500 focus:outline-none" />
            </div>

<div class="text-center">
    <button type="submit"
        @if($product->stok <= 0) disabled @endif
        class="px-6 py-2.5 bg-blue-600 hover:bg-blue-700 disabled:bg-gray-500 disabled:cursor-not-allowed text-white font-semibold rounded-lg shadow-md 
               transition duration-200 focus:ring-2 focus:ring-blue-500 focus:outline-none">
        Simpan Peminjaman
    </button>
</div>

<div class="text-center mt-3">
    <a href="{{ url('/') }}" 
        class="px-6 py-2.5 bg-red-600 hover:bg-red-700 text-white font-semibold rounded-lg shadow-md 
               transition duration-200 focus:ring-2 focus:ring-red-500 focus:outline-none">
        Batal Minjam
    </a>
</div>

        </form>
    </div>

</body>
</html>
