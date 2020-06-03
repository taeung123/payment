<?php
$api = app('Dingo\Api\Routing\Router');

$api->version('v1', function ($api) {
    $api->group(['prefix' => 'admin'], function ($api) {
        $api->get("/payment", "VCComponent\Laravel\Payment\Http\Controllers\Api\PaymentController");
    });
});

