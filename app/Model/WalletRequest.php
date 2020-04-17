<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use App\Transformers\WalletRequestTransformer;

class WalletRequest extends Model
{
    public $transformer = WalletRequestTransformer::class;

    protected $guarded = [];

    protected $hidden = [
        'pivot'
    ];

    public function setTransDateAttribute($trans_date)
    {
        $this->attributes['trans_date'] = date('Y-m-d', strtotime($trans_date));
    }

    public function getTransDateAttribute($trans_date)
    {
        return date('d-m-Y', strtotime($trans_date));
    }

    public function status()
    {
        return $this->belongsTo('App\Model\status');
    }
}
