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
        'dash_address'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function payments(){
        return $this->hasMany(Payment::class);
    }

    /**
     * @return bool
     */
    public function isAdmin(){
        return $this->type == self::ADMIN;
    }

    protected $appends = array('seller_name');
    public function getSellerNameAttribute()
    {
        return $this->first_name . ' ' . $this->last_name;
    }

    /**
     * @return bool
     */
    public function isFieldsFilled(){
        if(
            empty($this->first_name) ||
            empty($this->last_name) ||
            empty($this->company_name) ||
            (
                empty($this->btc_address) &&
                empty($this->doge_address) &&
                empty($this->ltc_address) &&
                empty($this->dash_address)
            )
        ){
            return false;
        }else{
            return true;
        }
    }
}
