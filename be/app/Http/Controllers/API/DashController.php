<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\JenisBarang;
use App\Models\StockBarang;
use App\Models\Prediksi;

class DashController extends Controller
{
    
    public function total(Request $request)
    {
        $jenis = JenisBarang::count();
        $stock = StockBarang::count();
        $prediksi = prediksi::count();

        return response()->json(compact('jenis', 'stock', 'prediksi'), 200);
    }

    public function getStatistik(Request $request)
    {
        if($request->range){
            list($awal, $akhir) = $request->range;

            $start = date('Y-m-d', strtotime($awal) );
            $end = date('Y-m-d', strtotime($akhir) );
        }else{
            $datePrediksi = Prediksi::orderBy('created_at', 'ASC')->first();
            $dateNow = $datePrediksi ? strtotime($datePrediksi->created_at) : strtotime(date('Y-m-01'));
            $start = date('Y-m-01', $dateNow);
            $end = date('Y-m-d');
        }

        $tanggal = [];
        $data = [];
        $jumlah = [];
        $tanggal = [];

        while($start <= $end){
            array_push($tanggal, $start);

            $start = date('Y-m-d', strtotime('+1 days', strtotime($start)));
        }

        foreach($tanggal as $tgl){
            $dataPrediksi = Prediksi::whereDate('created_at', date('Y-m-d', strtotime($tgl)))->count();

            array_push($data, ['tanggal' => date('d-m-Y', strtotime($tgl)), 'jumlah' => $dataPrediksi ]);
            array_push($jumlah, $dataPrediksi);
            array_push($tanggal, date('m-d-Y', strtotime($tgl)));
        }

        return response()->json([
            'data' => [
                'nilai' => $jumlah,
                'tanggal' => $tanggal,
            ],
            'jumlah' => $jumlah
        ], 200);
    }

    public function getHistory(Request $request)
    {
        $query = Prediksi::orderBy('created_at', 'DESC')->paginate($request->limit ?? 5);

        return response()->json($query, 200);
    }
}
