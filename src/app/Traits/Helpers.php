<?php

namespace VCComponent\Laravel\Payment\Traits;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use VCComponent\Laravel\Order\Entities\Order;

trait Helpers
{
    private function configVnpay()
    {
        $vnp_ReturnUrl = config('payment.vnpay.vnp_ReturnUrl').'/'.config('payment.namespace').'/payment';

        return [
            'vnp_Url'        => config('payment.vnpay.vnp_Url'),
            'vnp_ReturnUrl'  => $vnp_ReturnUrl,
            'vnp_HashSecret' => config('payment.vnpay.vnp_HashSecret'),
            'vnp_TmnCode'    => config('payment.vnpay.vnp_TmnCode'),

        ];
    }
}
