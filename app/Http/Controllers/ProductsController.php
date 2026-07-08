<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProductsController extends Controller
{
    public function ProductsIndex(){
        $category = ProductCategory::all();
        if(Auth::check() && Auth::user()->role === 'admin'){
            $products = Product::orderBy('id_product','asc')->paginate(15);
        }else{
            $products = Product::orderBy('created_at','desc')->paginate(10);
        }
        return view('products', compact('category', 'products'));
    }

    public function primary(){
        $products = Product::where('id_category', '=', 'CAT001', 'and')->paginate(8);
        return view('primary', compact('products'));
    }

    public function snack(){
        $products = Product::where('id_category', '=', 'CAT002', 'and')->paginate(8);
        return view('snack', compact('products'));
    }

    public function extensions(){
        $products = Product::where('id_category', '=', 'CAT003', 'and')->paginate(8);
        return view('extensions', compact('products'));
    }

    public function drink(){
        $products = Product::where('id_category', '=', 'CAT004', 'and')->paginate(8);
        return view('drink', compact('products'));
    }

    public function store(Request $request){
        $request->validate([
        'name_product' => 'required',
        'id_category' => 'required',
        'price_product' => 'required|integer',
        'stock_product' => 'required|integer',
        'image_product' => 'required|image|mimes:jpg,jpeg,png|max:2048',
        'description' => 'required',
        ]);

        $imageName = null;
        if ($request->hasFile('image_product')) {
            $imageName = time().'.'.$request->image_product->extension();
            $request->image_product->storeAs('products', $imageName, 'public');
        }

        Product::create([
            'name_product' => $request->name_product,
            'id_category' => $request->id_category,
            'price_product' => $request->price_product,
            'stock_product' => $request->stock_product,
            'image_product' => $imageName,
            'description' => $request->description,
        ]);

        return redirect()->back()->with('success', 'Product successfully added');
    }

    public function update(Request $request, $idProduct){
        $product = Product::where('id_product', '=', $idProduct, 'and')->firstOrFail();
        $request->validate([
            'name_product' => 'required',
            'id_category' => 'required',
            'price_product' => 'required|integer',
            'stock_product' => 'required|integer',
            'image_product' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'description' => 'required',
        ]);
        if($request->hasFile('image_product')){
            if($product->image_product){
                Storage::disk('public')->delete('products/'.$product->image_product);
            }
            $imageName = time().'.'.$request->image_product->extension();
            $request->image_product->storeAs('products', $imageName,'public');
        }else{
            $imageName = $product->image_product;
        }
        $product->update([
            'name_product' => $request->name_product,
            'id_category' => $request->id_category,
            'price_product' => $request->price_product,
            'stock_product' => $request->stock_product,
            'image_product' => $imageName,
            'description' => $request->description,
        ]);
        return redirect()->back()
            ->with('success','Product successfully updated');
    }

    public function destroy($idProduct){
        $product = Product::where('id_product', '=', $idProduct, 'and')->firstOrFail();
        if($product->image_product){
            Storage::disk('public')->delete('products/'.$product->image_product);
        }
        $product->delete();
        return redirect()->back()->with('success', 'Deleted Success');
    }
}
