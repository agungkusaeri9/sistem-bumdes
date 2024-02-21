<?php

namespace Database\Seeders;

use App\Models\Kota;
use App\Models\Provinsi;
use GuzzleHttp\Client;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KecamatanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $client = new Client();

        $data_kota = Kota::get();
        foreach ($data_kota as $kota) {
            $response = $client->request('GET', 'https://api.binderbyte.com/wilayah/kecamatan?api_key=' . env('API_KEY_BINDERBYTE') . '&id_kabupaten=' . $kota->id);
            if ($response->getStatusCode() == 200) {
                $body = $response->getBody();
                $data = json_decode($body, true);

                foreach ($data['value'] as $kecamatan) {
                    DB::table('kecamatan')->insert([
                        'id' => $kecamatan['id'],
                        'kota_id' => $kecamatan['id_kabupaten'],
                        'name' => $kecamatan['name'],
                    ]);
                }
            }
        }
    }
}
