<?php

namespace App\Http\Controllers\Heads;

use App\Model\ServiceHead;
use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;

class ServiceHeadController extends ApiController
{
    public function index(Request $request)
    {
        if ($request->get('code')) {
            $service = ServiceHead::where('service_group_id', $request->get('code'))->get();
        } else {
            $service = ServiceHead::get();
        }


        return $this->ShowAll($service);
    }
}
