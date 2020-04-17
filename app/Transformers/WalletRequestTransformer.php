<?php

namespace App\Transformers;

use App\Model\WalletRequest as Model;
use League\Fractal\TransformerAbstract;

class WalletRequestTransformer extends TransformerAbstract
{
    public function transform(Model $model)
    {
        return [
            'identifier'    => $model->id,
            'trans_date'    => $model->trans_date,
            'order_id'      => $model->order_id,
            'amount'        => $model->amount,
            'file_name'     => url("uploads/{$model->file_name}"),
            'status'        => $model->status->name,
            'status_color'  => $model->status->color,
            'remarks'       => $model->remarks,
            'created_at'    => $model->created_at ? $model->created_at->toIso8601String() : null,
            'updated_at'    => $model->updated_at ? $model->updated_at->toIso8601String() : null,
        ];
    }

    public static function originalAttribute($index)
    {
        $attributes = [
            'id'            => 'identifier',
            'trans_date'    => 'trans_date',
            'order_id'      => 'order_id',
            'amount'        => 'amount',
            'file_name'     => 'file_name',
            'status_id'     => 'status',
            'remarks'       => 'remarks',
            'created_at'    => 'created_at',
            'updated_at'    => 'updated_at',
        ];

        return isset($attributes[$index]) ? $attributes[$index] : null;
    }
}
