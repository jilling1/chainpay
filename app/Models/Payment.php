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
        'full_Amount',
        'payment_token'
    ];

    const AWAIT = 1;
    const PARTLY_PAYED = 2;
    const PAYED = 3;

    public $statuses = [
        'await' => self::AWAIT,
        'partly_payed' => self::PARTLY_PAYED,
        'payed' => self::PAYED
    ];

    public function currency(){
        return $this->belongsTo(Currency::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}
