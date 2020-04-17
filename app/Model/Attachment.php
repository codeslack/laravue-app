<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use App\Transformers\AttachmentTransformer;

class Attachment extends Model
{
    public $transformer = AttachmentTransformer::class;
    protected $fillable = [
        'order_id',
        'file_name',
        'file_type',
        'file_size'
    ];

    protected $dates = ['deleted_at'];

    protected $hidden = [
        'pivot'
    ];
}
