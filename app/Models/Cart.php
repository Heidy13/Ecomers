<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $table = 'cart';

    protected $fillable = [
        'id_user'
    ];

    public $timestamps = false;

    public function user(){
        return $this->hasMany(User::class, 'id_user');
    }

    public function addProduct($productId, $amount)
    {
        // Crear o actualizar el producto en los detalles del carrito
        return $this->cartDetails()->updateOrCreate(
            ['id_product' => $productId],
            ['amount' => $amount, 'date_added' => now()]
        );
    }

}
