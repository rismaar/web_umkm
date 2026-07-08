<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProductCategory;
use App\Models\Sale;

class IndexController extends Controller
{
    public function index(){
        $category = ProductCategory::all();
        $sale = Sale::where('status', 'Completed')->latest()->take(5)->get();
        return view('index', compact('category', 'sale'));
    }
}
