<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProductCategory;

class CategoryController extends Controller
{
    public function storeCategories(Request $request){
        $request->validate([
            'name_category' => 'required|string|max:255'
        ]);
        $lastId = ProductCategory::orderBy('id_category', 'desc')->first();
        if ($lastId) {
            $number = intval(substr($lastId->id_category, 3)) + 1;
        } else {
            $number = 1;
        }
        $id = 'CAT' . str_pad($number, 3, '0', STR_PAD_LEFT);
        ProductCategory::create([
            'id_category' => $id,
            'name_category' => $request->name_category
        ]);
        return redirect()->back()->with('success','Category berhasil ditambahkan');
    }
    
}
