<?php

namespace App\Http\Controllers\Affidavit;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;



class AffDrivingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $api_uri = 'driving-affidavits';

        $page = \Request::get('page');
        $per_page = \Request::get('itemsPerPage');
        $search = \Request::get('q');


        if (!empty($search)) {
            $api_params = array(
                'page'      => $page,
                'per_page'  => $per_page,
                'name'      => $search,
                'dob'       => $search,
                'mobile_no' => $search
            );
        } else {
            $api_params = array(
                'page'      => $page,
                'per_page'  => $per_page
            );
        }


        return $this->uw_api->getResources($api_uri, $api_params);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $number = mt_rand(1000, 9999);
        $order_id = time() . $number;

        $this->validate($request, [
            'name'          => 'required|string|max:191',
            'fname'         => 'required|string|max:191',
            'dob'           => 'required|date',
            'mobile_no'     => 'required|min:10|max:10',
            'address'       => 'required|string',
            'id_no'         => 'required|string|max:191',
            'id_name'       => 'required|string|max:191',
            'to_date'       => 'required|date',
            'place'         => 'required|string|max:191',
            'attachments'   => 'required|array|max:2',
            'attachments.*' => 'mimes:jpg,jpeg,png|max:2000'
        ]);

        $request->merge(['order_id' => $order_id]);

        $postData = $request->except('attachments');

        $files = $request->file(['attachments']);
        if ($request->hasFile('attachments')) {
            foreach ($files as $file) {
                $postData['attachments'][] = fopen($file->path(), 'r');
            }
        }


        return $this->uw_api->store('driving-affidavits', $postData);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $api_uri = 'driving-affidavits';

        return $this->uw_api->destroy($api_uri, $id);
    }

    public function print($id)
    {
        $api_uri = "driving-affidavits/print/{$id}";

        return $this->uw_api->getBlob($api_uri);
    }
}
