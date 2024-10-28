<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $table = 'cart';

    protected $fillable = [
        'amount',
        'date_added',
        'id_user',
        'id_product',
    ];

    public $timestamps = false;

    public function user () {
        return $this->belongsTo(User::class ,'id_user');
    }

    public function product () {
        return $this->hasMany(Product::class, 'id_product');
    }

    

}
