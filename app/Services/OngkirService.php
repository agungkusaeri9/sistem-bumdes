<?php

namespace App\Services;

use GuzzleHttp\Client;

class OngkirService
{
    protected $client;
    protected $dari;

    public function __construct()
    {
        $this->client = new Client();
        $this->dari = env('RAJAONGKIR_ORIGIN');
    }

    public function cekOngkir($tujuan,$berat,$kurir)
    {
        $curl = curl_init();
        curl_setopt_array($curl, array(
          CURLOPT_URL => "https://api.rajaongkir.com/".env('RAJAONGKIR_PACKAGE')."/cost",
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => "",
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 30,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => "POST",
          CURLOPT_POSTFIELDS => "origin=$this->dari&destination=$tujuan&weight=$berat&courier=$kurir",
          CURLOPT_HTTPHEADER => array(
            "content-type: application/x-www-form-urlencoded",
            "key: " . env('RAJAONGKIR_API_KEY')
          ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
          echo "cURL Error #:" . $err;
        } else {
          echo $response;
        }

    }
}
