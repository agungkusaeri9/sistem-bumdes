<?php

namespace App\Services;

use GuzzleHttp\Client;

class TrackingService
{
    protected $client;
    protected $apiKey;

    public function __construct()
    {
        $this->client = new Client([
            'base_uri' => 'https://api.binderbyte.com/v1/',
            'timeout'  => 2.0,
        ]);

        $this->apiKey = env("BINDERBYTE_API_KEY");
    }

    public function track($courier, $nomor_resi)
    {
        try {
            $response = $this->client->request('GET', 'track', [
                'query' => [
                    'api_key' => $this->apiKey,
                    'courier' => $courier,
                    'awb' => $nomor_resi,
                ]
            ]);

            return json_decode($response->getBody()->getContents(), true);
        } catch (\Exception $e) {
            return ['error' => $e->getMessage()];
        }
    }
}
