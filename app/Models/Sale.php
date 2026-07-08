<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\SaleDetails;

class Sale extends Model
{
    use HasFactory;
    protected $table = 'sale';
    protected $primaryKey = 'id_sale';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $fillable = [
        'id_sale',
        'invoice',
        'id_user',
        'total_price',
        'status',
    ];

    public function details(){
        return $this->hasMany(SaleDetails::class, 'id_sale', 'id_sale');
    }
    public function user(){
        return $this->belongsTo(User::class, 'id_user', 'id');
    }
}
