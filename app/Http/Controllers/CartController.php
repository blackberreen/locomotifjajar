<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class CartController extends Controller
{
    public function index()
    {
        return view('cart');
    }

    public function addToCart(Request $request)
    {
        $productId = $request->input('product_id');
        $product = Product::findOrFail($productId);

        $cart = session()->get('cart', []);

        if (isset($cart[$productId])) {
            $cart[$productId]['quantity']++;
        } else {
            $cart[$productId] = [
                'nama' => $product->nama,
                'harga' => $product->harga,
                'quantity' => 1,
                'image' => $product->image,
                'kategori' => $product->kategori
            ];
        }

        session()->put('cart', $cart);

        return redirect()->back()->with('success', 'Produk berhasil ditambahkan!');
    }

    public function updateCart(Request $request)
    {
        $cart = session()->get('cart', []);
        $productId = $request->input('product_id');
        $action = $request->input('action');

        if (isset($cart[$productId])) {
            if ($action === 'plus') {
                $cart[$productId]['quantity']++;
            } elseif ($action === 'minus') {
                $cart[$productId]['quantity']--;

                if ($cart[$productId]['quantity'] <= 0) {
                    unset($cart[$productId]);
                }
            }
        }

        session()->put('cart', $cart);
        return redirect()->route('cart');
    }

}
