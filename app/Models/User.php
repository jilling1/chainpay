<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    const SELLER = 1;
    const ADMIN = 2;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'type',
        'seller_token',
        'first_name',
        'last_name',
        'company_name',
        'phone_number',
        'btc_address',
        'doge_address',
        'ltc_address',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function payments(){
        return $this->hasMany(Payment::class);
    }

    public function isAdmin(){
        return $this->type == self::ADMIN;
    }
}
