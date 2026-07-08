<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\cart;
use App\Models\cartItem;
use App\Models\Sale;
use App\Models\SaleDetails;
use App\Models\Product;

class SaleController extends Controller
{
    public function checkout(){
        $cart = cart::where('id_user', Auth::id())->first();
        if (!$cart) {
            return back()->with('error', 'Cart is empty');
        }
        $items =cartItem::with('product')->where('id_cart', $cart->id_cart)->get();
        if ($items->isEmpty()) {
            return back()->with('error', 'Cart is empty');
        }
        $idSale = 'SL' . str_pad((Sale::count() + 1), 3, '0', STR_PAD_LEFT);
        $invoice = 'INV-' . now()->format('YmdHis');
        $total = 0;
        foreach ($items as $item) {
            $total += $item->qty * $item->price;
        }
        Sale::create([
            'id_sale'      => $idSale,
            'invoice'      => $invoice,
            'id_user'      => Auth::id(),
            'total_price'  => $total,
            'status'       => 'Pending'
        ]);
        foreach ($items as $item) {
            SaleDetails::create([
                'id_sale'     => $idSale,
                'id_product'  => $item->id_product,
                'qty'         => $item->qty,
                'price'       => $item->price,
                'subtotal'    => $item->qty * $item->price
            ]);
            $product = Product::findOrFail($item->id_product);
            $product->stock_product -= $item->qty;
            $product->save();
        }
        cartItem::where('id_cart', $cart->id_cart)->delete();
        return redirect()->route('historySales')->with('success','Checkout berhasil.');
    }

    public function history(){
        if (Auth::user()->role == 'admin') {
            $sales = Sale::with(['user', 'details.product'])
                ->whereIn('status', ['Pending', 'Processing'])
                ->latest()
                ->paginate(5);
        } else {
            $sales = Sale::with(['details.product'])
                ->where('id_user', Auth::id())
                ->latest()
                ->paginate(5);
        }
        return view('historySales', compact('sales'));
    }

    public function updateStatus(Request $request, $idSale){
        $request->validate([
            'status' => 'required|in:Pending,Processing,Completed,Cancelled',
        ]);
        $sale = Sale::findOrFail($idSale);
        $sale->status = $request->status;
        $sale->save();
        return redirect()->route('historySales');
    }

    public function orderHistory(){
        if (Auth::user()->role == 'admin') {
            $sales = Sale::with(['user','details.product'])
                ->whereIn('status', ['Completed','Cancelled'])
                ->latest()
                ->paginate(5);
        } else {
            $sales = Sale::with(['details.product'])
                ->where('id_user', Auth::id())
                ->whereIn('status', ['Completed','Cancelled'])
                ->latest()
                ->paginate(10);
        }

        return view('historySales', compact('sales'));
    }

    public function received($idSale){
        $sale = Sale::findOrFail($idSale);
        if ($sale->id_user != Auth::id()) {
            return redirect()->route('historySales')->with('error', 'Unauthorized action.');
        }
        $sale->status = 'Completed';
        $sale->save();
        return redirect()->route('historySales')->with('success', 'Order marked as received.');

    }
}
