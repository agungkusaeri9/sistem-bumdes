<?php

namespace App\Services;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

class OngkirService
{
    protected $client;
    protected $apiKey;
    protected $origin;

    public function __construct()
    {
        $this->client = new Client();
        $this->apiKey = env('RAJAONGKIR_API_KEY');
        $this->origin = env("RAJAONGKIR_ORIGIN");
    }

    public function checkOngkir($destination, $weight, $courier)
    {
        try {
            $response = $this->client->post('https://api.rajaongkir.com/starter/cost', [
                'headers' => [
                    'key' => $this->apiKey,
                    'content-type' => 'application/x-www-form-urlencoded',
                ],
                'form_params' => [
                    'origin' => $this->origin,
                    'destination' => $destination,
                    'weight' => $weight,
                    'courier' => $courier,
                ],
            ]);

            return json_decode($response->getBody()->getContents(), true);
        } catch (GuzzleException $e) {
            return ['error' => $e->getMessage()];
        }
    }
}
