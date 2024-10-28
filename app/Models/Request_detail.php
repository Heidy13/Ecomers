<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Request_detail extends Model
{
    protected $table = 'requested_detail';

    protected $fillable = [
        'amount',
        'price',
        'id_order',
        'id_product'
    ];
    
    public function order () {
        return $this->hasOne(Order::class, 'id_order');
    }

    public function product () {
        return $this->hasMany(Product::class, 'id_product');
    }

    public $timestamps = false;
}
