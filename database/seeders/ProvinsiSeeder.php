<?php

namespace Database\Seeders;

use GuzzleHttp\Client;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProvinsiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $client = new Client();
        $response = $client->request('GET', 'https://api.binderbyte.com/wilayah/provinsi?api_key=' . env('API_KEY_BINDERBYTE'));

        if ($response->getStatusCode() == 200) {
            $body = $response->getBody();
            $data = json_decode($body, true);

            foreach ($data['value'] as $provinsi) {
                DB::table('provinsi')->insert([
                    'id' => $provinsi['id'],
                    'name' => $provinsi['name'],
                ]);
            }
        }
    }
}
