<?php

namespace VCComponent\Laravel\Payment\Actions;

use VCComponent\Laravel\Payment\Contracts\PaymentResponse;
use VCComponent\Laravel\Payment\Repositories\PaymentMethodRepository;

class PaymentAction
{
    public function __construct(PaymentMethodRepository $repository)
    {
        $this->repository = $repository;
    }

    public function excute($request)
    {
        if (config('payment.vnpay.vnp_ReturnUrl') == '') {
            return redirect()->back()->with('alert', 'Chưa config !');
        }

        $data           = $request->toArray();
        $payment_method = $this->repository->getEntity()->whereId($data['payment_method'])->first();
        if ($data['payment_method'] == 1) {
            $data = [
                'cart_id'  => $data['cart_id'],
                'messages' => [
                    'status'        => true,
                    'notifications' => "Success",
                ],
            ];
            return app(PaymentResponse::class)->excute($data);
        }

        $service = app($payment_method->slug);

        return $service->excute($data);
    }
}
