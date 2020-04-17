<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use App\Transformers\DrivingLicenceTransformer;

class DrivingLicence extends Model
{
    public $transformer = DrivingLicenceTransformer::class;

    protected $fillable = [
        'name',
        'father_name',
        'date_of_birth',
        'mobile_no',
        'email',
        'address',
        'enabled',
        'buyer_id',
        'order_id',
        'service_code',
        'amount',
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

    public function setFatherNameAttribute($father_name)
    {
        $this->attributes['father_name'] = strtolower($father_name);
    }

    public function getFatherNameAttribute($father_name)
    {
        return ucwords($father_name);
    }

    public function setServiceCodeAttribute($service_code)
    {
        $this->attributes['service_code'] = strtolower($service_code);
    }

    public function getServiceCodeAttribute($service_code)
    {
        return ucwords($service_code);
    }

    public function setDateOfBirthAttribute($date_of_birth)
    {
        $this->attributes['date_of_birth'] = date('Y-m-d', strtotime($date_of_birth));
    }

    public function getDateOfBirthAttribute($date_of_birth)
    {
        return date('d-m-Y', strtotime($date_of_birth));
    }

    public function vouchers()
    {
        return $this->hasMany('App\Model\Voucher', 'order_id', 'order_id');
    }

    public function events()
    {
        return $this->hasMany('App\Model\AttachmentReply', 'order_id', 'order_id');
    }

    public function attachments()
    {
        return $this->hasMany('App\Model\Attachment', 'order_id', 'order_id');
    }
}
