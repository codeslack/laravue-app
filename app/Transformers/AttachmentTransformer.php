<?php

namespace App\Transformers;

use App\Model\Attachment as Model;
use League\Fractal\TransformerAbstract;

class AttachmentTransformer extends TransformerAbstract
{
    public function transform(Model $model)
    {
        return [
            'identifier'    => $model->id,
            'order_id'      => $model->order_id,
            'file_name'     => url("uploads/{$model->file_name}"),
            'file_type'     => $model->file_type,
            'file_size'     => $model->file_size,
            'created_at'    => $model->created_at ? $model->created_at->toIso8601String() : null,
            'updated_at'    => $model->updated_at ? $model->updated_at->toIso8601String() : null,
        ];
    }

    public static function originalAttribute($index)
    {
        $attributes = [
            'id'            => 'identifier',
            'order_id'      => 'order_id',
            'file_name'     => 'file_name',
            'file_type'     => 'file_type',
            'file_size'     => 'file_size',
            'created_at'    => 'created_at',
            'updated_at'    => 'updated_at',
        ];

        return isset($attributes[$index]) ? $attributes[$index] : null;
    }
}
