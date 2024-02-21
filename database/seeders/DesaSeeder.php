<?php

namespace Database\Seeders;

use App\Models\Kecamatan;
use GuzzleHttp\Client;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DesaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $client = new Client();

        $data_kecamatan = Kecamatan::get();
        foreach ($data_kecamatan as $kecamatan) {
            $response = $client->request('GET', 'https://api.binderbyte.com/wilayah/kelurahan?api_key=' . env('API_KEY_BINDERBYTE') . '&id_kecamatan=' . $kecamatan->id);
            if ($response->getStatusCode() == 200) {
                $body = $response->getBody();
                $data = json_decode($body, true);

                foreach ($data['value'] as $desa) {
                    DB::table('desa')->insert([
                        'id' => $desa['id'],
                        'kecamatan_id' => $desa['id_kecamatan'],
                        'name' => $desa['name'],
                    ]);
                }
            }
        }
    }
}
