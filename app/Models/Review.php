<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $table = 'review';

    protected $fillable = [
       'comment',
       'qualification',
       'date',
       'id_user',
       'id_product',
       'id_ability'
    ];

    public function user () { 
        return $this ->belongsTo(User::class, 'id_user');
    }

    public function product () {
        return $this-> hasMany(Product::class, 'id_product');
    }

    public function ability () {
        return $this-> hasMany(Ability::class, 'id_ablility');
    }

    public $timestamps = false;

}
