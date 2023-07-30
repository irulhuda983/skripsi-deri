<?php

namespace App\Services;

use App\Models\StockBarang;
use App\Models\JenisBarang;

class PrediksiService {

    public function getProbabilitas()
    {
        $habis = StockBarang::where('hasil', 'habis')->count();
        $lebih = StockBarang::where('hasil', 'lebih')->count();

        $total = StockBarang::select('id')->count();

        return [
            'habis' => ['jumlah' => $habis, 'prob' => ( (int) $habis / (int) $total ) ],
            'lebih' => ['jumlah' => $lebih, 'prob' => ( (int) $lebih / (int) $total ) ],
        ];
    }

    public function getNilaiAtributJenisBarang($data)
    {
        $prob = $this->getProbabilitas();

        $jenis = $data['jenis'];
        $jenisHabis = StockBarang::where('jenis_barang_id', $jenis->id)->where('hasil', 'habis')->count();
        $jenisLebih = StockBarang::where('jenis_barang_id', $jenis->id)->where('hasil', 'lebih')->count();

        return [
            'value' => $jenis->jenis_barang,
            'nilai' => [
                'habis' => $this->pembagian( $jenisHabis, $prob['habis']['jumlah']),
                'lebih' => $this->pembagian($jenisLebih, $prob['lebih']['jumlah'] ),
            ]
        ];
    }

    public function getNilaiAtributKriteriaHarga($data)
    {
        $prob = $this->getProbabilitas();

        $KHabis = StockBarang::where('kriteria_harga', $data['kriteria'])->where('hasil', 'habis')->count();
        $KLebih = StockBarang::where('kriteria_harga', $data['kriteria'])->where('hasil', 'lebih')->count();

        return [
            'value' => $data['kriteria'],
            // 'jumlah' => [
            //     'habis' => $KHabis,
            //     'lebih' => $KLebih
            // ],
            'nilai' => [
                'habis' => $this->pembagian($KHabis, $prob['habis']['jumlah']),
                'lebih' => $this->pembagian($KLebih, $prob['lebih']['jumlah']),
            ]
        ];
    }

    public function getNilaiAtributPermintaan($data)
    {
        $nilai = $data['nilai'];
        $prob = $this->getProbabilitas();
        $coll = StockBarang::select('id', 'permintaan', 'hasil')->get();

        // cari mean tiap params
        // $jumlahPermintaanHabis = StockBarang::select('id', 'permintaan')->where('hasil', 'habis')->get()->sum('permintaan');
        // $jumlahPermintaanLebih = StockBarang::select('id', 'permintaan')->where('hasil', 'lebih')->get()->sum('permintaan');
        $jumlahPermintaanHabis = $coll->where('hasil', 'habis')->sum('permintaan');
        $jumlahPermintaanLebih = $coll->where('hasil', 'lebih')->sum('permintaan');
        $meanHabis = $this->pembagian($jumlahPermintaanHabis, $prob['habis']['jumlah']);
        $meanLebih = $this->pembagian($jumlahPermintaanLebih, $prob['lebih']['jumlah']);

        // cari deviasi
        $deviasi = $this->getDeviasi(compact('coll', 'meanHabis', 'meanLebih'));

        // cari nilai akhir
        $hasilHabis = $this->getHasilDeviasi([
            'nilai' => $nilai,
            'mean' => $meanHabis,
            'deviasi' => $deviasi['habis'],
        ]);

        $hasilLebih = $this->getHasilDeviasi([
            'nilai' => $nilai,
            'mean' => $meanLebih,
            'deviasi' => $deviasi['lebih'],
        ]);

        return [
            'value' => $nilai,
            'nilai' => [
                'habis' => $hasilHabis,
                'lebih' => $hasilLebih
            ],
        ];
    }

    public function hasilPrediksi($jenis, $kriteria, $permintaan)
    {
        // init variable
        $lebih = array_sum([
            $jenis['nilai']['lebih'],
            $kriteria['nilai']['lebih'],
            $permintaan['nilai']['lebih'],
        ]);

        $habis = array_sum([
            $jenis['nilai']['habis'],
            $kriteria['nilai']['habis'],
            $permintaan['nilai']['habis'],
        ]);

        $hasil = ($lebih > $habis) ? 'lebih' : 'habis';

        return [
            'value' => $hasil,
            'nilai' => [
                'habis' => $habis,
                'lebih' => $lebih,
            ]
        ];
    }

    // fungsi pembantu
    public function getDeviasi($data)
    {
        // init array
        $dataHabis = [];
        $dataLebih = [];

        // parse variable
        $coll = $data['coll'];
        $meanHabis = $data['meanHabis'];
        $meanLebih = $data['meanLebih'];

        // fetch data
        $arrHabis = $coll->where('hasil', 'habis')->all();
        $arrLebih = $coll->where('hasil', 'lebih')->all();

        // insert fetch to arr
        foreach($arrHabis as $item) {
            $pengurangan = (int) $item->permintaan - $meanHabis;
            $perpangkatan = pow($pengurangan, 2);
            array_push($dataHabis, $perpangkatan);
        }

        foreach($arrLebih as $item) {
            $pengurangan = (int) $item->permintaan - $meanLebih;
            $perpangkatan = pow($pengurangan, 2);
            array_push($dataLebih, $perpangkatan);
        }
        
        // nilai standart deviasi
        $collDataHabis = collect($dataHabis);
        $collDataLebih = collect($dataLebih);
        $devHabis = $this->pembagian($collDataHabis->sum(), ($collDataHabis->count() - 1));
        $devLebih = $this->pembagian($collDataLebih->sum(), ($collDataLebih->count() - 1));

        return [
            'habis' => $devHabis,
            'lebih' => $devLebih,
        ];
    }

    public function getHasilDeviasi($data)
    {
        // init variable
        $exponen = 2.718;
        $pi = 3.14;
        $nilai = $data['nilai'];
        $mean = $data['mean'];
        $deviasi = $data['deviasi'];

        // hitung pembagian mean nilai dan deviasi
        $x1 = -1 * ($nilai - $mean);
        $x2 = pow($deviasi, 2);
        $hasilX = $this->pembagian(pow($x1, 2), (2 * $x2));
        $hasilExp = pow($exponen, $hasilX);

        // cari hasil akar
        $pengakaran = sqrt((2 * $pi)) * $deviasi;
        $hasilAkar = $this->pembagian(1, $pengakaran);

        // hitung hasil
        $hasil = $hasilAkar * $hasilExp;

        return $hasil;
    }

    public function pembagian($nilai1, $nilai2)
    {
        return $nilai2 == 0 ? 0 : ($nilai1 / $nilai2);
    }
}