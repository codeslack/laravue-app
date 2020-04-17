<?php

namespace App\Http\Controllers;


use App\Services\MarketService;
use App\Services\UtoworldAPIClientService;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;


    /**
     * The market service to consume from this client
     * @var App\Services\MarketService
     */
    protected $marketService;
    protected $uw_api;

    public function __construct(MarketService $marketService, UtoworldAPIClientService $UtoworldAPIClientService)
    {
        $this->marketService = $marketService;
        $this->uw_api = $UtoworldAPIClientService;
    }
}
