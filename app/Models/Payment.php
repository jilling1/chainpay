<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = [
        'payment_forwarding_address',
        'status',
        'payed',
        'user_id',
        'currency_id',
        'full_amount',
        'payment_token',
        'pay_id',
        'callback_url'
    ];

    const AWAIT = 1;
    const PARTLY_PAYED = 2;
    const PAYED = 3;
    const TIME_EXCEED = 4;

    public static $status = [
        self::AWAIT => 'await',
        self::PARTLY_PAYED => 'partly_payed',
        self::PAYED => 'payed',
        self::TIME_EXCEED => 'time_exceed'
    ];

    /**
     * @param $value
     * @return mixed
     */
    public function getStatusAttribute($value){
        return self::$status[$value];
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function currency(){
        return $this->belongsTo(Currency::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(){
        return $this->belongsTo(User::class);
    }

    protected $appends = array('full_amount_usd');
    public function getFullAmountUsdAttribute()
    {
        return app('CurrencyRate')->getAmountRate($this->currency->currency_code, $this->full_amount);
    }

}
