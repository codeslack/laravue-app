<?php

namespace App\Traits;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;
use GuzzleHttp\Exception\RequestException;

trait ConsumesExternalServices
{
    /**
     * Send a request to any service
     * @return sdtClass|string
     */
    public function makeRequest($method, $requestUrl, $queryParams = [], $formParams = [], $headers = [], $hasFile = false)
    {
        $client = new Client([
            'base_uri' => $this->baseUri,
        ]);


        if (method_exists($this, 'resolveAuthorization')) {
            $this->resolveAuthorization($queryParams, $formParams, $headers);
        }

        $bodyType = 'form_params';

        if ($hasFile) {
            $bodyType = 'multipart';

            $multipart = [];

            foreach ($formParams as $key => $value) {
                if (!is_array($value)) {
                    $multipart[] = ['name' => $key, 'contents' => $value];
                    continue;
                }

                foreach ($value as $multiKey => $multiValue) {
                    $multiName = $key . '[' . $multiKey . ']' . (is_array($multiValue) ? '[' . key($multiValue) . ']' : '') . '';
                    $multipart[] = ['name' => $multiName, 'contents' => (is_array($multiValue) ? reset($multiValue) : $multiValue)];
                }
            }
        }

        $response = $client->request($method, $requestUrl, [
            'query' => $queryParams,
            $bodyType => $hasFile ? $multipart : $formParams,
            'headers' => $headers,
        ]);

        $response = $response->getBody()->getContents();

        if (method_exists($this, 'decodeResponse')) {
            $response = $this->decodeResponse($response);
        }

        if (method_exists($this, 'checkIfErrorResponse')) {
            $this->checkIfErrorResponse($response);
        }

        return $response;
    }

    public function makeStream($method, $requestUrl, $queryParams = [], $formParams = [], $headers = [], $hasFile = false)
    {
        $client = new Client([
            'base_uri' => $this->baseUri,
        ]);

        if (method_exists($this, 'resolveAuthorization')) {
            $this->resolveAuthorization($queryParams, $formParams, $headers);
        }

        $bodyType = 'form_params';

        if ($hasFile) {
            $bodyType = 'multipart';

            $multipart = [];

            foreach ($formParams as $name => $contents) {
                $multipart[] = ['name' => $name, 'contents' => $contents];
            }
        }

        $response = $client->request($method, $requestUrl, [
            'query' => $queryParams,
            $bodyType => $hasFile ? $multipart : $formParams,
            'headers' => $headers,
        ]);

        $response = $response->getBody()->getContents();

        if (method_exists($this, 'decodeStream')) {
            $response = $this->decodeStream($response);
        }

        if (method_exists($this, 'checkIfErrorResponse')) {
            $this->checkIfErrorResponse($response);
        }

        return $response;
    }
}
