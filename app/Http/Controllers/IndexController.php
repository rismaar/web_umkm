<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProductCategory;

class IndexController extends Controller
{
    public function index(){
        $category = ProductCategory::all();
        return view('index', compact('category'));
    }
}
