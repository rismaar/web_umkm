<?php

namespace App\Http\Controllers;

use App\Models\cart;
use App\Models\cartItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function add($idProduct){
        $product = Product::findOrFail($idProduct);
        $cart = cart::firstOrCreate(['id_user' => Auth::id()]);
        $item = cartItem::where('id_cart', '=', $cart->id_cart, 'and')
            ->where('id_product', '=', $product->id_product, 'and')
            ->first();

        if($item){
            $item->increment('qty');
        } else{
            cartItem::create([
                'id_cart' => $cart->id_cart, 
                'id_product' => $product->id_product, 
                'qty' => 1, 
                'price' => $product->price_product
            ]);
        }
        return back();
    }
    
    public function index(){
        $cart = Cart::where('id_user', '=', Auth::id(), 'and')->first();
        if ($cart) {
            $items = CartItem::with('product')->where('id_cart', $cart->id_cart)->get();
            return view('cart', compact('items'));
        }
        return view('cart', ['items' => collect()]);
    }

    public function increase($idCartItem){
        $item = cartItem::findOrFail($idCartItem);
        $item->increment('qty');
        return back();
    }

    public function decrease($idCartItem){
        $item = cartItem::findOrFail($idCartItem);
        if ($item->qty > 1) {
            $item->decrement('qty');
        } else {
            $item->delete();
        }
        return back();
    }

    public function remove($idCartItem){
        $item = cartItem::findOrFail($idCartItem);
        $item->delete();
        return back();
    }

    public function saveAddress(Request $request){
        $request->validate([
            'address' => 'required|string|max:255',
        ]);
        Auth::user()->update([
            'address' => $request->address,
        ]);
        return back()->with('success', 'Address saved successfully.');
    }
}
