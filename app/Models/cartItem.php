<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class cartItem extends Model
{
    use HasFactory;
    protected $fillable = ['id_cart', 'id_product', 'qty', 'price'];
    protected $primaryKey = 'id_cartItem';
    protected $keyType = 'integer';
    public function product(){
        return $this->belongsTo(Product::class, 'id_product', 'id_product');
    }
}
