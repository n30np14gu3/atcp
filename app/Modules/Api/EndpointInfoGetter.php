<?php

namespace App\Modules\Api;

use Illuminate\Support\Facades\Http;

class EndpointInfoGetter
{
    private string $appId;
    private string $countryId;
    private string $baseUri;

    public function __construct()
    {
        $this->appId = config('apptica.app_id');
        $this->countryId = config('apptica.country_id');
        $this->baseUri = config('apptica.base_uri');
    }

    /**
     * @param string $dateFrom
     * @param string $dateTo
     * @return mixed|null
     */
    public function getInfo(string $dateFrom, string $dateTo)
    {
        $response = Http::get("$this->baseUri/$this->appId/$this->countryId", [
            'date_from' => $dateFrom,
            'date_to' => $dateTo
        ]);

        //500 exceptions is not JSON
        if($response->status() !== 200)
            return null;


        //Need only data
        return json_decode($response->body(), true)['data'];
    }
}
