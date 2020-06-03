<?php

namespace VCComponent\Laravel\Payment\Http\Controllers\Api;

use Illuminate\Http\Request;
use VCComponent\Laravel\Vicoders\Core\Controllers\ApiController;
use VCComponent\Laravel\Payment\Repositories\PaymentMethodRepository;
use VCComponent\Laravel\Payment\Transformers\PaymentMethodTransformer;

class PaymentController extends ApiController
{
    protected $repository;

    public function __construct(PaymentMethodRepository $repository)
    {
        $this->repository  = $repository;
        $this->entity      = $repository->getEntity();

        $this->transformer = PaymentMethodTransformer::class;
    }

    public function __invoke(Request $request)
    {
        $query = $this->entity;

        $per_page = $request->has('per_page') ? (int) $request->get('per_page') : 15;
        $order    = $query->paginate($per_page);
        return $this->response->paginator($order, new $this->transformer);
    }
}
