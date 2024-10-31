<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $table = 'cart';

    protected $fillable = [
        'id_cart_detail',
    ];

    public $timestamps = false;

    public function product () {
        return $this->hasMany(Product::class, 'id_product');
    }

    public function cart_detail(){
        return $this->hasMany(Cart_detail::class, 'id_cart_detail');
    }

}
