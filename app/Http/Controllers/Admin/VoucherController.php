<?php

namespace App\Http\Controllers\Admin;

use App\Model\Voucher;
use App\Model\WalletRequest;
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

        if ($request->radioOption === 'r') {

            $walletRequest = WalletRequest::where('order_id', $request->order_id)->first();
            
            $walletRequest->updateStatus(2);

            $this->appEvent([
                'order_id' => $request->order_id,
                'status_id' => 2,
                'message' => 'Transaction request with the same information has been submitted #' . 'OrderId-' . $request->order_id . ' Amount-' . $request->amount,
            ]);

            $data = [
                'type' => 'info',
                'message' => 'Do not re-submit !',
                'title' => 'Information',
            ];

            return $this->showMessage($data);
        }


        $voucherInfo = Voucher::where('order_id', $request->order_id)->first();

        if ($voucherInfo) {
            return $this->errorResponse(['error' => 'Transaction is already completed, do not re-submit !'], 409);
        }

        $walletRequest = WalletRequest::where('order_id', $request->order_id)->first();

        $postData = [
            'voucher_type_id' => 6,     // id # 6 => Debit note
            'payment_type_id' => $request->payType,
            'order_id' => $request->order_id,
            'account_id_one' => $walletRequest->user_id,
            'account_id_two' => 1,
            'trans_date' => date('Y-m-d'),
            'vch_no' => 12,
            'name' => $walletRequest->user->name,
            'service_code' => 'wallet_added',
            'remarks' => $request->order_id . '-' . $walletRequest->user->name . '-' . $walletRequest->amount,
            'amount' => $walletRequest->amount,
            'debit_credit' => 0,
            'notes' => 'Debit Note for Order No : ' . $request->order_id . ' Dated : ' . $walletRequest->trans_date
        ];

        $voucher = Voucher::create($postData);

        $voucher->vchNo('Dbn-' . $voucher->id);

        $this->generalUser($walletRequest->user_id)->grant($walletRequest->amount);

        $this->masterUser()->charge($walletRequest->amount);

        $walletRequest->updateStatus(3);

        $this->appEvent([
            'order_id' => $request->order_id,
            'status_id' => 3,
            'message' => 'Debit Note done #' . 'Rec-' . $voucher->id . ' on - ' . date('d-m-Y'),
        ]);

        

        $data = [
            'type' => 'success',
            'message' => 'Wallet update successfully !',
            'title' => 'Success',
        ];

        return $this->showMessage($data, 201);
    }
}
