<?php

namespace VCComponent\Laravel\Payment\Entities;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;


class PaymentMethod extends Model
{
    use Sluggable, SluggableScopeHelpers;

    protected $fillable = [
        'key',
    ];

    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'key',
            ],
        ];
    }
}
