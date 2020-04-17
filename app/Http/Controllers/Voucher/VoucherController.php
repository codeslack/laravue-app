<?php

namespace App\Http\Controllers\Voucher;

use App\Model\Voucher;
use App\Model\ServiceHead;
use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;

class VoucherController extends ApiController
{
    public function index()
    {
        app('log')->info('-------index------');
    }

    public function store(Request $request)
    {
        $serviceHead = ServiceHead::where('service_code', $request->service_code)->first();

        if ($serviceHead->retailer != $request->amount) {
            return $this->errorResponse(['error' => 'This action is unauthorized, 3 tire after locked your account !'], 409);
        }

        $user = $this->getUser();

        if ($user->balance < $serviceHead->retailer) {
            return $this->errorResponse(['error' => 'Your fund is insufficient balance ₹ ' .  number_format($user->balance, 2)], 409);
        }

        $voucherInfo = Voucher::where('order_id', $request->order_id)->first();

        if ($voucherInfo) {
            return $this->errorResponse(['error' => 'Your payment already made, contact account section !'], 409);
        }

        $postData = [
            'voucher_type_id' => 3,     // id # 3 => receipt
            'payment_type_id' => 12,
            'order_id' => $request->order_id,
            'account_id_one' => $user->id,
            'account_id_two' => 1,
            'trans_date' => $request->trans_date ? $request->trans_date : date('Y-m-d'),
            'vch_no' => 12,
            'name' => $request->name,
            'service_code' => $request->service_code,
            'remarks' => $request->order_id . '-' . $request->name . '-' . $request->amount,
            'amount' => $serviceHead->retailer,
            'debit_credit' => 0,
            'notes' => 'Receipt for Order No : ' . $request->order_id . ' Dated : ' . date('d-m-Y')
        ];

        $voucher = Voucher::create($postData);

        $voucher->vchNo('Rec-' . $voucher->id);

        $user->charge($serviceHead->retailer);

        $this->masterUser()->grant($serviceHead->retailer);

        $this->appEvent([
            'order_id' => $request->order_id,
            'status_id' => 2,
            'message' => 'Receipt done #' . 'Rec-' . $voucher->id . ' on - ' . date('d-m-Y'),
        ]);



        $data = [
            'payment' => true
        ];


        return response()->json(['data' => $data], 201);
    }

    public function show(Voucher $voucher)
    {
        app('log')->info(print_r($voucher, true));
    }

    public function check(Request $request)
    {
        $serviceHead = ServiceHead::where('service_code', $request->service_code)->first();

        if ($serviceHead->retailer != $request->amount) {
            return $this->errorResponse(['error' => 'Your price has been changed, Please update your data !'], 409);
        }

        $voucher = Voucher::where('order_id', $request->order_id)->first();

        if ($voucher) {
            return $this->errorResponse(['error' => 'Your payment already made, contact account section !'], 409);
        }

        $data = array(
            'checkPayment' => true
        );

        return response()->json(['data' => $data], 201);
    }
}
