<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    protected $table = 'users'; 

    protected $fillable = [
        'name',
        'email',
        'phone',
        'location',
        'biography',
        'profile_photo',
        'role',
        'date_register'
    ];

     public $timestamps = false;

    public function product () {
        return $this->hasMany(Product::class, 'id_user');
    }

    public function ability () {
        // return $this->hasMany(::class, 'id_user');
    }

    public function cart () {
        // return $this->hasOne(Cart::class, 'id_user');
    }

    public function orders () {
        return $this->hasMany(Order::class, 'id_user');
    }

    public function review () {
        return $this->hasMany(Review::class, 'id_user');
    }

    public function exchange_aplicant(){
        return $this->hasMany(Exchange::class, 'id_user_applicant');
    }

    public function exchange_receiver(){
        return $this->hasMany(Exchange::class, 'id_user_receiver');
    }



    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}
