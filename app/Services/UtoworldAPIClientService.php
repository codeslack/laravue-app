<?php

namespace App\Services;

use App\Traits\AuthorizesMarketRequests;
use App\Traits\ConsumesExternalServices;
use App\Traits\InteractsWithMarketResponses;

class UtoworldAPIClientService
{
    use ConsumesExternalServices, AuthorizesMarketRequests, InteractsWithMarketResponses;

    /**
     * The URL to send the requests
     * @var string
     */
    protected $baseUri;

    public function __construct()
    {
        $this->baseUri = config('services.market.base_uri');
    }

    /**
     * Retrieve the user information from the API
     * @return stdClass
     */
    public function getUserInformation()
    {
        return $this->makeRequest('GET', 'users/me');
    }

    /**
     * Display a listing of the resource from the API.
     *
     * @return \Illuminate\Http\Response
     */
    public function getResources(string $api_uri, $api_params)
    {
        return $this->makeRequest('GET', $api_uri, $api_params);
    }

    /**
     * Display the specified resource from the API.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getResource($uri)
    {
        return $this->makeRequest('GET', $uri);
    }

    /**
     * Display the specified resource from the API.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getBlob($uri)
    {
        return $this->makeStream(
            'GET',
            $uri
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store($api_uri, $productData)
    {
        return $this->makeRequest(
            'POST',
            $api_uri,
            [],
            $productData,
            [],
            $hasFile = true
        );
    }

    /**
     * Update the specified resource in storage the API.
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
     * Remove the specified resource from storage API.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($api_uri, $id)
    {
        return $this->makeRequest(
            'DELETE',
            "{$api_uri}/{$id}"
        );
    }

    /**
     * Publish a product on the API
     * @return stdClass
     */
    public function publishProduct($sellerId, $productData)
    {
        return $this->makeRequest(
            'POST',
            "sellers/{$sellerId}/products",
            [],
            $productData,
            [],
            $hasFile = true
        );
    }

    /**
     * Associate a product to the category
     * @return stdClass
     */
    public function setProductCategory($productId, $categoryId)
    {
        return $this->makeRequest(
            'PUT',
            "products/{$productId}/categories/{$categoryId}"
        );
    }

    /**
     * Update an existing product
     * @return sdtClass
     */
    public function updateProduct($sellerId, $productId, $productData)
    {
        $productData['_method'] = 'PUT';

        return $this->makeRequest(
            'POST',
            "sellers/{$sellerId}/products/{$productId}",
            [],
            $productData,
            [],
            $hasFile = isset($productData['picture'])
        );
    }
}
