<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
 public function index(Request $request)
{
    $query = Product::query();

    // kalau ada pencarian
    if ($request->has('search') && $request->search != '') {
        $search = $request->search;
        $query->where('nama_produk', 'LIKE', "%{$search}%")
              ->orWhere('kategori', 'LIKE', "%{$search}%");
    }

    $products = $query->latest()->get();

    return view('products.index', compact('products'));
}


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('products.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi input
        $validatedData = $request->validate([
            'nama_produk' => 'required|string|max:255',
            'kategori'    => 'required|string|max:255',
            'stok'        => 'required|integer|min:0',
            'gambar'      => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Upload gambar baru
        if ($request->hasFile('gambar')) {
            $image     = $request->file('gambar');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/assetimg'), $imageName);
            $validatedData['gambar'] = 'uploads/assetimg/' . $imageName;
        }

        Product::create($validatedData);

        return redirect()
            ->route('products.index')
            ->with('success', 'Produk baru berhasil ditambahkan!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $product = Product::findOrFail($id);
        return view('products.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $product = Product::findOrFail($id);

        // Validasi input
        $validatedData = $request->validate([
            'nama_produk' => 'required|string|max:255',
            'kategori'    => 'required|string|max:255',
            'stok'        => 'required|integer|min:0',
            'gambar'      => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Upload gambar baru jika ada
        if ($request->hasFile('gambar')) {
            // Hapus gambar lama kalau ada
            if ($product->gambar && file_exists(public_path($product->gambar))) {
                unlink(public_path($product->gambar));
            }

            $image     = $request->file('gambar');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/assetimg'), $imageName);
            $validatedData['gambar'] = 'uploads/assetimg/' . $imageName;
        }

        $product->update($validatedData);

        return redirect()
            ->route('products.index')
            ->with('success', 'Produk berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Product::findOrFail($id);

        // Hapus gambar kalau ada
        if ($product->gambar && file_exists(public_path($product->gambar))) {
            unlink(public_path($product->gambar));
        }

        $product->delete();

        return redirect()
            ->route('products.index')
            ->with('success', 'Produk berhasil dihapus!');
    }
}
