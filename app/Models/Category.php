<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'category';

    protected $fillable = [
        'name',
        'description',
    ];
    public $timestamps = false;

    public function product () {
        // return $this->belongsToMany(::class , 'id_category');
    }
    

}
