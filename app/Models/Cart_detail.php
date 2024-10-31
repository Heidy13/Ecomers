<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cart_detail extends Model
{

    protected $table = 'cart_detail';

    protected $fillable = [
        'amount',
        'date_added',
        'id_product',
        'id_user',
    ];

    public function user () {
        return $this->belongsTo(User::class ,'id_user');
    }

    public function product () {
        return $this->hasMany(Product::class, 'id_product');
    }

    public function cart(){
        return $this->belongsTo(Cart::class, 'id_cart_detail');
    }

    public $timestamps = false;
}
