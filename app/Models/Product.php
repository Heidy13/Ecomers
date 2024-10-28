<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name',
        'description',
        'price',
        'stock',
        'image',
        'create_date',
        'id_user',
        'id_category'
    ];

    public function user() {
        return $this ->belongsTo(User::class, 'id_user');
    }

    public function category(){
        return $this ->belongToMany(Category::class, 'id_category');
    }
}
