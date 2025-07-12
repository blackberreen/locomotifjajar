<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class AdminProductController extends Controller
{
    public function index()
    {
        $produks = Product::all();
        return view('admin.product', compact('produks'));
    }

    public function create()
    {
        return view('admin.create_product');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'harga' => 'required|numeric',
            'stok' => 'required|integer',
            'kategori' => 'required|string|max:255',
            'foto' => 'nullable|image|max:2048',
        ]);

        $data = $request->all();

        if ($request->hasFile('foto')) {
            $foto = $request->file('foto');
            $fotoName = time() . '.' . $foto->getClientOriginalExtension();
            $foto->move(public_path('img'), $fotoName);
            $data['image'] = $fotoName;
        }

        Product::create($data);

        return redirect()->route('admin.product')->with('success', 'Produk berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $produk = Product::findOrFail($id);
        return view('admin.edit_product', compact('produk'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'harga' => 'required|numeric',
            'stok' => 'required|integer',
            'kategori' => 'required|string|max:255',
            'foto' => 'nullable|image|max:2048',
        ]);

        $produk = Product::findOrFail($id);
        $data = $request->all();

        if ($request->hasFile('foto')) {
            $foto = $request->file('foto');
            $fotoName = time() . '.' . $foto->getClientOriginalExtension();
            $foto->move(public_path('img'), $fotoName);
            $data['image'] = $fotoName;
        }

        $produk->update($data);

        return redirect()->route('admin.product')->with('success', 'Produk berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $produk = Product::findOrFail($id);
        

        if ($produk->image && file_exists(public_path('img/' . $produk->image))) {
            unlink(public_path('img/' . $produk->image));
        }
        
        $produk->delete();

        return redirect()->route('admin.product')->with('success', 'Produk berhasil dihapus.');
    }


    public function bulkDestroy(Request $request)
    {
        $request->validate([
            'product_ids' => 'required|array',
            'product_ids.*' => 'exists:products,id_produk'
        ]);

        $productIds = $request->product_ids;
        $products = Product::whereIn('id_produk', $productIds)->get();
        

        foreach ($products as $product) {
            if ($product->image && file_exists(public_path('img/' . $product->image))) {
                unlink(public_path('img/' . $product->image));
            }
        }
        

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
            'updated_at' => $produk->updated_at
        ]);
    }


    public function updateStock(Request $request, $id)
    {
        $request->validate([
            'stok' => 'required|integer|min:0'
        ]);

        $produk = Product::findOrFail($id);
        $produk->update(['stok' => $request->stok]);

        return response()->json([
            'success' => true,
            'message' => 'Stok berhasil diperbarui',
            'new_stock' => $produk->stok
        ]);
    }
}