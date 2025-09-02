<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
            $products = Product::latest()->get();
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

        // Cek dan simpan gambar
        if ($request->hasFile('gambar')) {
            $image     = $request->file('gambar');
            $imageName = time() . '.' . $image->getClientOriginalExtension();

            // simpan file ke public/uploads/assetimg
            $image->move(public_path('uploads/assetimg'), $imageName);

            // simpan path ke array validasi
            $validatedData['gambar'] = 'uploads/assetimg/' . $imageName;
        }

        // Simpan data produk
        Product::create($validatedData);

        return redirect()
            ->route('products.index')
            ->with('success', 'Produk baru berhasil ditambahkan!');
    }




    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
