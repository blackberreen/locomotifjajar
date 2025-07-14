<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class AdminProductController extends Controller
{
    public function index()
    {
        $produks = Product::all();
        return view('admin.product', compact('produks'));
    }

    public function create()
    {
        // Ambil semua file gambar dari folder public/img
        $imageFiles = File::files(public_path('img'));
        $imageNames = array_map(function ($file) {
            return $file->getFilename();
        }, $imageFiles);

        return view('admin.create_product', compact('imageNames'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'harga' => 'required|numeric',
            'stok' => 'required|integer',
            'kategori' => 'required|string|max:255',
            'image' => 'required|string',
        ]);

        $data = $request->only(['nama', 'harga', 'stok', 'kategori', 'image']);

        Product::create($data);

        return redirect()->route('admin.product')->with('success', 'Produk berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $produk = Product::findOrFail($id);

        // Ambil ulang daftar gambar dari public/img
        $imageFiles = File::files(public_path('img'));
        $imageNames = array_map(function ($file) {
            return $file->getFilename();
        }, $imageFiles);

        return view('admin.edit_product', compact('produk', 'imageNames'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'harga' => 'required|numeric',
            'stok' => 'required|integer',
            'kategori' => 'required|string|max:255',
            'image' => 'required|string',
        ]);

        $produk = Product::findOrFail($id);
        $data = $request->only(['nama', 'harga', 'stok', 'kategori', 'image']);
        $produk->update($data);

        return redirect()->route('admin.product')->with('success', 'Produk berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $produk = Product::findOrFail($id);
        $produk->delete();

        return redirect()->route('admin.product')->with('success', 'Produk berhasil dihapus.');
    }

    public function bulkDestroy(Request $request)
    {
        $request->validate([
            'product_ids' => 'required|array',
            'product_ids.*' => 'exists:produk,id_produk',
        ]);

        $productIds = $request->product_ids;
        Product::whereIn('id_produk', $productIds)->delete();

        $count = count($productIds);
        return redirect()->route('admin.product')->with('success', "$count produk berhasil dihapus.");
    }

    public function show($id)
    {
        $produk = Product::findOrFail($id);

        return response()->json([
            'id' => $produk->id_produk,
            'nama' => $produk->nama,
            'kategori' => $produk->kategori,
            'harga' => $produk->harga,
            'stok' => $produk->stok,
            'image' => $produk->image,
            'created_at' => $produk->created_at,
            'updated_at' => $produk->updated_at,
        ]);
    }

    public function updateStock(Request $request, $id)
    {
        $request->validate([
            'stok' => 'required|integer|min:0',
        ]);

        $produk = Product::findOrFail($id);
        $produk->update(['stok' => $request->stok]);

        return response()->json([
            'success' => true,
            'message' => 'Stok berhasil diperbarui',
            'new_stock' => $produk->stok,
        ]);
    }
}
