<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ability extends Model
{
    protected $table = 'ability';

    protected $fillable = [
        'name',
        'description',
        'creation_date',
        'id_user'
    ];

    public $timestamps = false;

    public function exchange_requested(){
        return $this->hasMany(Exchange::class, 'id_ability_requested');
    }

    public function exchange_offered(){
        return $this->hasMany(Exchange::class, 'id_ability_offered');
    }
}
