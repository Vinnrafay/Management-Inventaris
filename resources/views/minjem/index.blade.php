<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Daftar Peminjaman
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg p-6">

                <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-6 text-center">
                    Data Peminjaman Barang
                </h2>

                @if($pinjams->count())
                    <div class="overflow-x-auto rounded-xl border border-gray-200 dark:border-gray-700">
                        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                            <thead class="bg-gray-50 dark:bg-gray-700">
                                <tr>
                                    <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700 dark:text-gray-300">Nama Peminjam</th>
                                    <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700 dark:text-gray-300">Produk</th>
                                    <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700 dark:text-gray-300">Tanggal Pinjam</th>
                                    <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700 dark:text-gray-300">Sampai</th>
                                    <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700 dark:text-gray-300">Status</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                                @foreach($pinjams as $pinjems)
                                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition">
                                        <td class="px-6 py-4 text-gray-900 dark:text-gray-100">{{ $pinjems->nama_peminjam }}</td>
                                        <td class="px-6 py-4 text-gray-700 dark:text-gray-300">{{ $pinjems->product->nama_produk }}</td>
                                        <td class="px-6 py-4 text-gray-700 dark:text-gray-300">{{ \Carbon\Carbon::parse($pinjems->waktu_pinjam)->format('d M Y') }}</td>
                                        <td class="px-6 py-4 text-gray-700 dark:text-gray-300">{{ \Carbon\Carbon::parse($pinjems->waktu_kembali)->format('d M Y') }}</td>
                                        <td class="px-6 py-4">
                                            @if(\Carbon\Carbon::now()->lt(\Carbon\Carbon::parse($pinjems->waktu_kembali)))
                                                <span class="px-3 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800 dark:bg-green-700 dark:text-green-100">
                                                    Sedang Dipinjam
                                                </span>
                                            @else
                                                <span class="px-3 py-1 text-xs font-semibold rounded-full bg-red-100 text-red-800 dark:bg-red-700 dark:text-red-100">
                                                    Selesai
                                                </span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <p class="text-gray-500 dark:text-gray-400 italic text-center mt-6">
                        Belum ada peminjaman.
                    </p>
                @endif

            </div>
        </div>
    </div>
</x-app-layout>
