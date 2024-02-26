<?php

namespace App\Services;

use GuzzleHttp\Client;

class OngkirService
{
    protected $client;

    public function __construct()
    {
        $this->client = new Client();
    }

    public function checkOngkir($courier, $origin, $destination, $weight)
    {
        $response = $this->client->request('GET', 'https://api.binderbyte.com/v1/cost', [
            'query' => [
                'api_key' => env('API_KEY_BINDERBYTE'),
                'courier' => $courier,
                'origin' => $origin,
                'destination' => $destination,
                'weight' => $weight
            ]
        ]);

        if ($response->getStatusCode() == 200) {
            $body = $response->getBody();
            $data = json_decode($body, true);
            return $data;
        }

        return null;
    }
}
