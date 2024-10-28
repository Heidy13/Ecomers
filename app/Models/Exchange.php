<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Exchange extends Model
{
    protected $table = 'exchange';

    protected $fillable = [
        'id_user_applicant',
        'id_user_receiver',
        'id_ability_requested',
        'id_ability_offered',
        'state',
        'date_filled',
        'date_answer'
    ];

    public $timestamps = false;

    //usuario solicitante del intercambio
    public function user_applicant(){
        return $this->belognsTo(User::class, 'id_user_applicant');
    }

    //usuario receptor del intercambio
    public function id_user_receiver(){
        return $this->belongsTo(User::class, 'id_user_receiver');
    }

    //habilidad solicitada del intercambio
    public function ability_requested(){
        return $this->belongsTo(Ability::class, 'id_ability_requested');
    }

    //habilidad ofrecida del intercambio
    public function id_ability_offered(){
        return $this ->belongsTo(Ability::class, 'id_ability_offered');
    }
}
