<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class AttachmentReply extends Model
{
    protected $fillable = [
        'user_belong',
        'order_id',
        'status_id',
        'message',
        'visitor'
    ];

    protected $dates = ['deleted_at'];

    protected $hidden = [
        'pivot'
    ];
}
