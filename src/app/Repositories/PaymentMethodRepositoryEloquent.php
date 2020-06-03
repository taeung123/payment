<?php

namespace VCComponent\Laravel\Payment\Repositories;

use Prettus\Repository\Criteria\RequestCriteria;
use Prettus\Repository\Eloquent\BaseRepository;
use VCComponent\Laravel\Payment\Entities\PaymentMethod;
use VCComponent\Laravel\Payment\Repositories\PaymentMethodRepository;

/**
 * Class AccountantRepositoryEloquent.
 */
class PaymentMethodRepositoryEloquent extends BaseRepository implements PaymentMethodRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return PaymentMethod::class;
    }

    public function getEntity()
    {
        return $this->model;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
