<?php

namespace App\Transformers;

use App\Model\ServiceHead as Model;
use League\Fractal\TransformerAbstract;

class ServiceHeadTransformer extends TransformerAbstract
{
    public function transform(Model $model)
    {
        return [
            'identifier'        => $model->id,
            'name'              => $model->service_code,
            'detail'            => $model->name,
            'description'       => $model->description,
            'details'           => $model->details,
            'company'           => $model->company,
            'state'             => $model->state,
            'district'          => $model->district,
            'block'             => $model->block,
            'vendor'            => $model->vendor,
            'referral'          => $model->referral,
            'retailer'          => $model->retailer,
            'customer'          => $model->customer,
            'fixed_percent'     => $model->fixed_percent,
            'sort_order'        => $model->sort_order,
            'enabled'           => $model->enabled,
            'code'              => $model->service_group_id,
            'created_at'        => $model->created_at ? $model->created_at->toIso8601String() : null,
            'updated_at'        => $model->updated_at ? $model->updated_at->toIso8601String() : null,
        ];
    }

    public static function originalAttribute($index)
    {
        $attributes = [
            'id'                => 'identifier',
            'service_code'      => 'name',
            'name'              => 'detail',
            'description'       => 'description',
            'details'           => 'details',
            'company'           => 'company',
            'state'             => 'state',
            'district'          => 'district',
            'block'             => 'block',
            'vendor'            => 'vendor',
            'referral'          => 'referral',
            'retailer'          => 'retailer',
            'customer'          => 'customer',
            'fixed_percent'     => 'fixed_percent',
            'sort_order'        => 'sort_order',
            'enabled'           => 'enabled',
            'service_group_id'  => 'code',
            'created_at'        => 'created_at',
            'updated_at'        => 'updated_at',
        ];

        return isset($attributes[$index]) ? $attributes[$index] : null;
    }
}
