<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;

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

        // Debug: Log semua data request
        Log::info('Request data:', $request->all());
        Log::info('Has file foto:', $request->hasFile('foto'));

        if ($request->hasFile('foto')) {
            $foto = $request->file('foto');
            
            // Debug: Log info file
            Log::info('File info:', [
                'original_name' => $foto->getClientOriginalName(),
                'size' => $foto->getSize(),
                'mime_type' => $foto->getMimeType(),
                'is_valid' => $foto->isValid()
            ]);
            
            // Generate nama file yang unik
            $fotoName = time() . '_' . uniqid() . '.' . $foto->getClientOriginalExtension();
            
            // Path tujuan
            $destinationPath = public_path('img');
            
            // Debug: Log path info
            Log::info('Path info:', [
                'destination_path' => $destinationPath,
                'path_exists' => File::exists($destinationPath),
                'path_writable' => is_writable($destinationPath),
                'full_path' => $destinationPath . '/' . $fotoName
            ]);
            
            // Pastikan folder ada dan writable
            if (!File::exists($destinationPath)) {
                File::makeDirectory($destinationPath, 0755, true);
                Log::info('Created directory:', ['path' => $destinationPath]);
            }
            
            // Coba pindahkan file
            try {
                $moved = $foto->move($destinationPath, $fotoName);
                Log::info('File moved successfully:', [
                    'moved' => $moved,
                    'final_path' => $destinationPath . '/' . $fotoName,
                    'file_exists_after_move' => file_exists($destinationPath . '/' . $fotoName)
                ]);
                
                // Set nama file ke data
                $data['image'] = $fotoName;
                
            } catch (\Exception $e) {
                Log::error('Error moving file:', [
                    'error' => $e->getMessage(),
                    'trace' => $e->getTraceAsString()
                ]);
                
                return redirect()->back()->with('error', 'Gagal mengupload foto: ' . $e->getMessage());
            }
        }

        // Hapus foto dari data karena field di database adalah image
        unset($data['foto']);

        // Debug: Log data yang akan disimpan
        Log::info('Data to save:', $data);

        try {
            $product = Product::create($data);
            Log::info('Product created:', ['id' => $product->id_produk]);
            
            return redirect()->route('admin.product')->with('success', 'Produk berhasil ditambahkan.');
            
        } catch (\Exception $e) {
            Log::error('Error creating product:', [
                'error' => $e->getMessage(),
                'data' => $data
            ]);
            
            return redirect()->back()->with('error', 'Gagal menyimpan produk: ' . $e->getMessage());
        }
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
            // Hapus foto lama jika ada
            if ($produk->image && file_exists(public_path('img/' . $produk->image))) {
                unlink(public_path('img/' . $produk->image));
                Log::info('Old file deleted:', ['file' => $produk->image]);
            }
            
            $foto = $request->file('foto');
            $fotoName = time() . '_' . uniqid() . '.' . $foto->getClientOriginalExtension();
            $destinationPath = public_path('img');
            
            // Pastikan folder ada
            if (!File::exists($destinationPath)) {
                File::makeDirectory($destinationPath, 0755, true);
            }
            
            try {
                $foto->move($destinationPath, $fotoName);
                $data['image'] = $fotoName;
                Log::info('File updated successfully:', ['new_file' => $fotoName]);
                
            } catch (\Exception $e) {
                Log::error('Error updating file:', ['error' => $e->getMessage()]);
                return redirect()->back()->with('error', 'Gagal mengupdate foto: ' . $e->getMessage());
            }
        }

        // Hapus foto dari data
        unset($data['foto']);

        $produk->update($data);

        return redirect()->route('admin.product')->with('success', 'Produk berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $produk = Product::findOrFail($id);
        
        // Hapus file foto jika ada
        if ($produk->image && file_exists(public_path('img/' . $produk->image))) {
            unlink(public_path('img/' . $produk->image));
            Log::info('File deleted:', ['file' => $produk->image]);
        }
        
        $produk->delete();

        return redirect()->route('admin.product')->with('success', 'Produk berhasil dihapus.');
    }

    public function bulkDestroy(Request $request)
    {
        $request->validate([
            'product_ids' => 'required|array',
            'product_ids.*' => 'exists:produk,id_produk'
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