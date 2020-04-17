<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Voucher extends Model
{
    use SoftDeletes;

    protected $guarded = [];

    protected $dates = ['deleted_at'];

    protected $hidden = [
        'pivot'
    ];

    public function vchNo(string $vch_no)
    {
        return $this->update(['vch_no' => $vch_no]);
    }
}
