<?php

namespace App\Http\Controllers;

use App\Models\Pinjem;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class PinjemController extends Controller
{
    /**
     * Tampilkan daftar semua peminjaman
     */
    public function index()
    {
        // Cari peminjaman yang udah lewat waktunya
        $selesai = Pinjem::where('waktu_kembali', '<', now())->get();

        foreach ($selesai as $pinjam) {
            if ($pinjam->product) {
                // Balikin stok
                $pinjam->product->increment('stok');

                // Hapus data peminjaman karena udah selesai
                $pinjam->delete();
            }
        }

        // Ambil data peminjaman yang masih aktif
        $pinjams = Pinjem::with('product')->latest()->get();

        return view('minjem.index', compact('pinjams'));
    }

    /**
     * Selesaikan peminjaman manual
     */
    public function selesai($id)
    {
        $pinjem = Pinjem::findOrFail($id);

        if ($pinjem->product) {
            // Balikin stok produk
            $pinjem->product->increment('stok');
        }

        // Hapus data pinjaman / tandai selesai
        $pinjem->delete();

        return redirect()->back()->with('success', 'Peminjaman selesai, stok sudah dikembalikan.');
    }

    /**
     * Form create peminjaman untuk 1 produk
     */
    public function create(Request $request)
    {
        $product = Product::findOrFail($request->id);

        // pastikan view -> resources/views/form/create.blade.php
        return view('form.create', compact('product'));
    }

    /**
     * Simpan peminjaman baru
     */
    public function store(Request $request)
    {
        $request->validate([
            'product_id'    => 'required|exists:products,id',
            'nama_peminjam' => 'required|string|max:255',
            'waktu_pinjam'  => 'required|date',
            'waktu_kembali' => 'required|date|after_or_equal:waktu_pinjam',
        ]);

        DB::transaction(function () use ($request) {
            $product = Product::lockForUpdate()->findOrFail($request->product_id);

            if ($product->stok <= 0) {
                throw new \Exception('Stok produk sudah habis');
            }

            Pinjem::create([
                'product_id'    => $product->id,
                'nama_peminjam' => $request->nama_peminjam,
                'waktu_pinjam'  => $request->waktu_pinjam,
                'waktu_kembali' => $request->waktu_kembali,
            ]);

            $product->decrement('stok');
        });

        return redirect()->route('welcome')
                         ->with('success', 'Peminjaman berhasil dicatat & stok berkurang.');
    }

    // Placeholder
    public function show(string $id) {}
    public function edit(string $id) {}
    public function update(Request $request, string $id) {}
    public function destroy(string $id) {}
}
