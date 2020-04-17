<?php

namespace App\Http\Controllers\Driving;

use Illuminate\Http\Request;
use App\Model\DrivingLicence;
use App\Http\Controllers\ApiController;

class DrivingLicenceController extends ApiController
{
    public function index()
    {
        $data = DrivingLicence::doesnthave('vouchers')
            ->where('buyer_id', $this->getUser()->id)
            ->latest()
            ->get();

        return $this->showAll($data);
    }

    public function process()
    {
        $data = DrivingLicence::has('vouchers')
            ->where('buyer_id', $this->getUser()->id)
            ->latest()
            ->get();

        return $this->showAll($data);
    }

    public function hold()
    {
        $data = DrivingLicence::has('vouchers')
            ->where('buyer_id', $this->getUser()->id)
            ->latest()
            ->get();

        return $this->showAll($data);
    }

    public function reject()
    {
        $data = DrivingLicence::has('vouchers')
            ->where('buyer_id', $this->getUser()->id)
            ->latest()
            ->get();

        return $this->showAll($data);
    }

    public function success()
    {
        $data = DrivingLicence::has('vouchers')
            ->where('buyer_id', $this->getUser()->id)
            ->latest()
            ->get();

        return $this->showAll($data);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'service_code'  => 'required',
            'name'          => 'required|string|max:191',
            'father_name'   => 'required|string|max:191',
            'date_of_birth' => 'required|date|date_format:d-m-Y|before:-18 years',
            'mobile_no'     => 'required|min:10|max:10',
            'email'         => 'sometimes|nullable|email|email:rfc,dns',
            'attachments'   => 'array|max:5',
            'attachments.*' => 'max:2000'
        ]);

        $number = mt_rand(1000, 9999);
        $txn_id = time() . $number;

        $postData = $request->except('attachments');

        $postData['order_id']   = $txn_id;
        $postData['user_belong']    = 0;
        $postData['buyer_id']   = $this->getUser()->id;
        $postData['message']    = 'create a new driving licence - ' . strtoupper($request->service_code);
        $postData['file_path']  = 'DrivingLicence';


        $newDataInsert = DrivingLicence::create($postData);


        $this->appEvent($postData);

        if ($request->hasFile('attachments')) {
            $this->appAttachments($request, $postData);
        }

        return $this->showOne($newDataInsert, 201);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'service_code'  => 'required',
            'name'          => 'required|string|max:191',
            'father_name'   => 'required|string|max:191',
            'date_of_birth' => 'required|date|date_format:d-m-Y|before:-18 years',
            'mobile_no'     => 'required|min:10|max:10',
            'email'         => 'sometimes|nullable|email|email:rfc,dns',
        ]);

        $drivingLicence = DrivingLicence::findOrFail($id);

        $drivingLicence->fill($request->only([
            'service_code',
            'amount',
            'name',
            'father_name',
            'date_of_birth',
            'mobile_no',
            'email',
            'address',
        ]));

        if ($drivingLicence->isClean()) {
            return $this->errorResponse(['error' => 'You need to specify any different value to update'], 422);
        }

        $drivingLicence->save();

        $postData['order_id']   = $drivingLicence->order_id;
        $postData['user_belong']    = 0;
        $postData['message']    = 'update some value';

        $this->appEvent($postData);

        return $this->showOne($drivingLicence);
    }

    public function reply(Request $request)
    {
        $this->validate($request, [
            'attachments'   => 'array|max:3',
            'attachments.*' => 'max:2000'
        ]);

        $postData = $request->except('attachments');

        $postData['status_id']      = 4;
        $postData['user_belong']    = 0;
        $postData['file_path']      = 'DrivingLicence';


        $this->appEvent($postData);

        if ($request->hasFile('attachments')) {
            $this->appAttachments($request, $postData);
        }

        return response()->json(['data' => 'Success'], 200);
    }

    public function destroy(DrivingLicence $drivingLicence)
    {
        //
    }
}
