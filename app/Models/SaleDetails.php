<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use \Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Product;
use App\Models\Sale;

class SaleDetails extends Model
{
    use HasFactory;
    protected $table = 'sale_details';
    protected $primaryKey = 'id_detil_sale';
    public $incrementing = true;
    protected $keyType = 'string';
    protected $fillable = [
        'id_detil_sale',
        'id_sale',
        'id_product',
        'qty',
        'price',
        'subtotal',
    ];

    public function sale(){
        return $this->belongsTo(Sale::class, 'id_sale', 'id_sale');
    }
    public function product(){
        return $this->belongsTo(Product::class, 'id_product', 'id_product');
    }
}
