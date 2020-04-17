<?php

namespace App\Traits;

use Illuminate\Support\Facades\Log;
use GuzzleHttp\Psr7\Response;

trait InteractsWithMarketResponses
{
    /**
     * Decode correspondingly the response
     * @return stdClass
     */
    public function decodeResponse($response)
    {
        $is_object = json_decode($response);

        if (isset($is_object->access_token)) {
            $decodedResponse = json_decode($response);
        } else {
            $decodedResponse = json_decode($response, true);
        }

        return $decodedResponse->data ?? $decodedResponse;
    }

    public function decodeStream($response)
    {
        return $response;
    }

    /**
     * Resolve when the request failed
     * @return void
     */
    public function checkIfErrorResponse($response)
    {
        if (isset($response->error)) {
            throw new \Exception("Something failed: {$response->error}");
        }
    }
}
