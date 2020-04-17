<?php

namespace App\Transformers;

use App\Model\DrivingLicence as Model;
use League\Fractal\TransformerAbstract;

class DrivingLicenceTransformer extends TransformerAbstract
{
    protected $defaultIncludes = [
        // 'attachment_replies',
        'attachments',

    ];

    public function transform(Model $model)
    {
        return [
            'identifier'    => (int) $model->id,
            'name'          => $model->name,
            'father_name'   => $model->father_name,
            'date_of_birth' => $model->date_of_birth,
            'mobile_no'     => $model->mobile_no,
            'email'         => $model->email,
            'address'       => $model->address,
            'buyer_id'      => $model->buyer_id,
            'status_id'     => $model->status_id,
            'order_id'      => $model->order_id,
            'service_code'  => $model->service_code,
            'amount'        => $model->amount,
            'enabled'       => $model->enabled,
            'events'        => $model->events()->latest()->get(),
            'created_at'    => $model->created_at ? $model->created_at->toIso8601String() : null,
            'updated_at'    => $model->updated_at ? $model->updated_at->toIso8601String() : null,
        ];
    }

    public static function originalAttribute($index)
    {
        $attributes = [
            'identifier'    => 'id',
            'name'          => 'name',
            'father_name'   => 'father_name',
            'date_of_birth' => 'date_of_birth',
            'mobile_no'     => 'mobile_no',
            'email'         => 'email',
            'address'       => 'address',
            'buyer_id'      => 'buyer_id',
            'status_id'     => 'status_id',
            'order_id'      => 'order_id',
            'service_code'  => 'service_code',
            'amount'        => 'amount',
            'enabled'       => 'enabled',
            'created_at'    => 'created_at',
            'updated_at'    => 'updated_at',
        ];

        return isset($attributes[$index]) ? $attributes[$index] : null;
    }

    public static function transformedAttribute($index)
    {
        $attributes = [
            'id'            => 'identifier',
            'name'          => 'name',
            'father_name'   => 'father_name',
            'date_of_birth' => 'date_of_birth',
            'mobile_no'     => 'mobile_no',
            'email'         => 'email',
            'address'       => 'address',
            'buyer_id'      => 'buyer_id',
            'status_id'     => 'status_id',
            'order_id'      => 'order_id',
            'service_code'  => 'service_code',
            'amount'        => 'amount',
            'enabled'       => 'enabled',
            'created_at'    => 'created_at',
            'updated_at'    => 'updated_at',
        ];

        return isset($attributes[$index]) ? $attributes[$index] : null;
    }

    public function includeAttachments(Model $model)
    {
        $attachments = $model->attachments;

        return $this->collection($attachments, new AttachmentTransformer);
    }
    // public function includeAttachmentReplies(Model $model)
    // {
    //     $events = $model->events;

    //     return $this->collection($events, new AttachmentTransformer);
    // }
}
