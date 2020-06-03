<?php

namespace VCComponent\Laravel\Payment\Entities;

use Illuminate\Database\Eloquent\Model;


class PaymentLog extends Model
{
    protected $fillable = [
        'cart_id',
        'status_code',
        'message',
    ];
}
