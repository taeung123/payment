<?php

return [

    'namespace'    => env('PAYMENT_COMPONENT_NAMESPACE', 'payment-management'),

    'url_response' => "",

    'vnpay'        => [
        'vnp_Url'        => env('PAYMENT_COMPNENTO_URL', 'http://sandbox.vnpayment.vn/paymentv2/vpcpay.html'),
        'vnp_ReturnUrl'  => env('PAYMENT_COMPONENT_RETURNURL', ''),
        'vnp_HashSecret' => env('PAYMENT_COMPONENT_HASHSECRET', 'TOAFFBVZDAEQOEDSOFDSWNJYOUUWPCJW'),
        'vnp_TmnCode'    => env('PAYMENT_COMPONENT_TMNCODE', 'IN1FL50W'),
    ],

];
