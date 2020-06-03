<?php

namespace VCComponent\Laravel\Payment\Contracts;

interface PaymentRequest
{
    public function getUserId($data);
    public function getTotal($data);
    public function getNote($data);
    public function getOrderId($data);
}
