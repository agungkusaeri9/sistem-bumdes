<?php

namespace Database\Seeders;

use App\Models\Provinsi;
use GuzzleHttp\Client;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KotaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $client = new Client();

        $data_provinsi = Provinsi::get();
        foreach ($data_provinsi as $provinsi) {
            $response = $client->request('GET', 'https://api.binderbyte.com/wilayah/kabupaten?api_key=' . env('API_KEY_BINDERBYTE') . '&id_provinsi=' . $provinsi->id);

            if ($response->getStatusCode() == 200) {
                $body = $response->getBody();
                $data = json_decode($body, true);

                foreach ($data['value'] as $kota) {
                    DB::table('kota')->insert([
                        'id' => $kota['id'],
                        'provinsi_id' => $kota['id_provinsi'],
                        'name' => $kota['name'],
                    ]);
                }
            }
        }
    }
}
