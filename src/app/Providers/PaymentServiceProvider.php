<?php

namespace VCComponent\Laravel\Payment\Providers;

use Illuminate\Support\ServiceProvider;
use VCComponent\Laravel\Payment\Contracts\PaymentRequest;
use VCComponent\Laravel\Payment\Contracts\PaymentRequestEloquent;
use VCComponent\Laravel\Payment\Actions\PaymentAction;
use VCComponent\Laravel\Payment\Repositories\PaymentMethodRepository;
use VCComponent\Laravel\Payment\Repositories\PaymentMethodRepositoryEloquent;
use VCComponent\Laravel\Payment\Actions\Vnpay\VNPayRequest;

class PaymentServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any package services
     *
     * @return void
     */
    public function boot()
    {
        $this->loadRoutesFrom(__DIR__ . '/../../routes/api.php');
        $this->loadRoutesFrom(__DIR__ . '/../../routes/web.php');
        $this->loadMigrationsFrom(__DIR__ . '/../../database/migrations');
        $this->publishes([
            __DIR__ . '/../../config/payment.php' => config_path('payment.php'),
        ]);
    }

    /**
     * Register any package services
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(PaymentRequest::class, PaymentRequestEloquent::class);
        $this->app->bind(PaymentRequest::class, VNPayRequest::class);
        $this->app->bind(PaymentMethodRepository::class, PaymentMethodRepositoryEloquent::class);
        $this->app->bind("vnpay", VNPayRequest::class);
    }
}
