<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProductCategory;
use App\Models\Sale;
use App\Models\SaleDetails;
use Illuminate\Support\Facades\DB;

class IndexController extends Controller
{
    public function index(){
        $category = ProductCategory::all();
        $sale = Sale::where('status', 'Completed')->latest()->take(4)->get();
        $bestProducts = SaleDetails::join('sale', 'sale.id_sale', '=', 'sale_details.id_sale')
            ->join('products', 'products.id_product', '=', 'sale_details.id_product')
            ->select(
                'products.*',
                DB::raw('SUM(sale_details.qty) as total_sold')
            )
            ->where('sale.status', 'Completed')
            ->whereMonth('sale.created_at', now()->month)
            ->whereYear('sale.created_at', now()->year)
            ->groupBy(
                'products.id_product',
                'products.name_product',
                'products.price_product',
                'products.image_product',
                'products.description',
                'products.stock_product',
                'products.id_category',
                'products.created_at',
                'products.updated_at'
            )
            ->orderByDesc('total_sold')
            ->take(3)
            ->get();
        return view('index', compact('category', 'sale', 'bestProducts'));
    }
}
