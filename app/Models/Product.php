<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;
    protected $table = 'products';
    protected $primaryKey = 'id_product';
    protected $keyType = 'string';
    public $incrementing = false;
    protected $fillable = ['id_product', 'name_product', 'id_category', 'price_product', 'stock_product', 'image_product', 'description'];
    protected static function boot(){
        parent::boot();
        static::creating(function ($model) {
            $last = Product::orderBy('id_product', 'desc')->first();
            if($last){
                $number = intval(substr($last->id_product, 2)) + 1;
            }else{
                $number = 1;
            }
            $model->id_product =
                'PR' . str_pad($number, 3, '0', STR_PAD_LEFT);
        });
    }

    public function category()
    {
        return $this->belongsTo(ProductCategory::class, 'id_category', 'id_category');
    }
}
