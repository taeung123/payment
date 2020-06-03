<?php

Route::prefix(config('payment.namespace'))->middleware('web')->group(function () {
    Route::get('/payment','VCComponent\Laravel\Payment\Http\Response\VnpayResponse');
});
