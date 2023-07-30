<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;
use App\Models\JenisBarang;

class JenisBarangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $json = Storage::disk('local')->get('jenis_barang.json');
        $json = json_decode($json, true);

        JenisBarang::truncate();
        foreach($json as $item) {
            JenisBarang::create([
                'jenis_barang' => $item['nama'],
                'status' => 1,
            ]);
        }
    }
}
