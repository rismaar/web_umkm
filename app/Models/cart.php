<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\cartItem;

class cart extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_cart';
    protected $fillable = ['id_user'];
    public function item(){
        return $this->hasMany(cartItem::class, 'id_cart', 'id_cart');
    }

    public function user(){
        return $this->belongsTo(User::class, 'id_user', 'id');
    }
}
