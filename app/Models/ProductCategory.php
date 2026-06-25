<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProductCategory extends Model
{
    use HasFactory;
    protected $table = 'product_categories';
    protected $primaryKey = 'id_category';
    protected $keyType = 'string';
    protected $fillable = ['id_category', 'name_category'];
    protected static function boot(){
        parent::boot();
        static::creating(function ($model) {
            $last = ProductCategory::orderBy('id_category', 'desc')->first();
            if($last){
                $number = intval(substr($last->id_category, 3)) + 1;
            }else{
                $number = 1;
            }
            $model->id_category =
                'CAT' . str_pad($number, 3, '0', STR_PAD_LEFT);
        });
    }

    public function products()
    {
        return $this->hasMany(Product::class, 'id_category', 'id_category');
    }
}
