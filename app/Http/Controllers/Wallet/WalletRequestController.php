<?php

namespace App\Http\Controllers\Wallet;

use App\Model\WalletRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;

class WalletRequestController extends ApiController
{
    public function index()
    {
        $data = WalletRequest::where('user_id', $this->getUser()->id)
            ->latest()
            ->get();

            // $data = WalletRequest::latest()
            // ->get();            

        return $this->showAll($data);
    }

    public function store(Request $request)
    {

        $this->validate($request, [
            'trans_date'    => 'required|date|date_format:d-m-Y|before:now',
            'amount'        => 'required',
            'attachment'    => 'required',
            'remarks'       => 'max:50',
        ]);

        $number = mt_rand(1000, 9999);
        $txn_id = time() . $number;

        $postData = $request->except('attachment');

        $postData['status_id']  = 1;
        $postData['order_id']   = $txn_id;
        $postData['user_belong']    = 0;
        $postData['user_id']   = $this->getUser()->id;
        $postData['message']    = 'create a new wallet request';

        $filename = '';
        if ($request->hasFile('attachment')) {

            $file = $request->file('attachment');

            $filename = $file->store('wallets');
        }


        $newDataInsert = WalletRequest::create([
            'user_id'       => $this->getUser()->id,
            'trans_date'    => $request->trans_date,
            'order_id'      => $txn_id,
            'amount'        => $request->amount,
            'file_name'     => $filename ? $filename : '',
            'status_id'     => 1,
            'remarks'       => $request->remarks,
        ]);
        
        $this->appEvent($postData);

        return $this->showOne($newDataInsert);

    }
}
