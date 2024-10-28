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

    public function user () {
        return $this-> belongsTo(User::class, 'id_user');
    }

    public function exchange () {
        return $this-> belongsToMany(Exchange::class,'id_ability_offered');
    }

    public function review () {
        return $this-> belongsTo(Review::class,'id_ability');
    }

    public function exchange_requested(){
        return $this->hasMany(Exchange::class, 'id_ability_requested');
    }

    public function exchange_offered(){
        return $this->hasMany(Exchange::class, 'id_ability_offered');
    }
}
