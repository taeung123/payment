<?php

namespace VCComponent\Laravel\Payment\Contracts;

use VCComponent\Laravel\Payment\Contracts\PaymentRequest;

class PaymentRequestEloquent implements PaymentRequest
{
    public function getUserId($data)
    {
        return $data['id'];
    }

    public function getTotal($data)
    {
        return $data['total'];
    }

    public function getNote($data)
    {
        return $data['order_note'];
    }

    public function getOrderId($data)
    {
        return $data['cart_id'];
    }
}
