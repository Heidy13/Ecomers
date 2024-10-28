<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'order';

    protected $fillable = [
        'state',
        'total',
        'shipping_address',
        'order_date',
        'delivery_date',
        'id_user'
    ];

    public $timestamps = false;

    public function user () {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function requested_detail () {
        return $this->hasOne(Request_detail::class, 'id_order');
    }

    // public function 

}
