<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use App\Transformers\ServiceHeadTransformer;

class ServiceHead extends Model
{
    public $transformer = ServiceHeadTransformer::class;
    protected $fillable = [
        'service_code',
        'name',
        'service_group_id',
        'description',
        'details',
        'company',
        'state',
        'district',
        'block',
        'vendor',
        'referral',
        'retailer',
        'customer',
        'fixed_percent',
        'sort_order',
        'enabled',
    ];

    protected $dates = ['deleted_at'];

    protected $hidden = [
        'pivot'
    ];

    public function setNameAttribute($name)
    {
        $this->attributes['name'] = strtolower($name);
    }

    public function getNameAttribute($name)
    {
        return ucwords($name);
    }

    public function setServiceCodeAttribute($service_code)
    {
        $this->attributes['service_code'] = strtolower($service_code);
    }

    public function getServiceCodeAttribute($service_code)
    {
        return ucwords($service_code);
    }
    public function serviceGroup()
    {
        return $this->belongsTo('App\Model\ServiceGroup');
    }
}
