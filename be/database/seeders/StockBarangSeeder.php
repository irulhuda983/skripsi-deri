<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;
use App\Models\StockBarang;

class StockBarangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $json = Storage::disk('local')->get('stock_barang.json');
        $json = json_decode($json, true);

        StockBarang::truncate();
        foreach($json as $item) {
            StockBarang::create([
                'nama_barang' => $item['nama'],
                'jenis_barang_id' => $item['id_jenis'],
                'bulan' => 'januari',
                'permintaan' => $item['stok'],
                'kriteria_harga' => $item['k_harga'],
                'hasil' => $item['hasil'],
            ]);
        }
    }
}
