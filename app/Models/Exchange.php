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
}
