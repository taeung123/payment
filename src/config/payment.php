<?php

return [

    'namespace'    => env('PAYMENT_COMPONENT_NAMESPACE', 'payment-management'),

    'url_response' => env('PAYMENT_COMPONENT_RETURNURL'.'/payment-response', "http://locahost/payment-response"),

    'vnpay'        => [
        'vnp_Url'        => env('PAYMENT_COMPONENT_URL', 'http://sandbox.vnpayment.vn/paymentv2/vpcpay.html'),
        'vnp_ReturnUrl'  => env('PAYMENT_COMPONENT_RETURNURL', ''),
        'vnp_HashSecret' => env('PAYMENT_COMPONENT_HASHSECRET', ''),
        'vnp_TmnCode'    => env('PAYMENT_COMPONENT_TMNCODE', ''),
    ],
    'auth_middleware' => [
        'admin'    => [
            'middleware' => '',
            'except'     => [],
        ]
    ],

];
