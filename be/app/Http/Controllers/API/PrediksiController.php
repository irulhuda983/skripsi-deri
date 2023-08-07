<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\StockBarang;
use App\Models\JenisBarang;
use App\Models\Prediksi;
use App\Services\PrediksiService;
use App\Http\Resources\PrediksiResource;

class PrediksiController extends Controller
{

    public function index(Request $request)
    {
        $query = Prediksi::all();

        return PrediksiResource::collection($query);
    }

    public function show(Request $request, Prediksi $prediksi)
    {
        return new PrediksiResource($prediksi);
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'nama_barang' => 'required',
            'jenis_barang_id' => 'required',
            // 'bulan' => 'required',
            'permintaan' => 'required',
            'kriteria_harga' => 'required'
        ]);

        $jenisBarang = JenisBarang::find($request->jenis_barang_id);

        if(!$jenisBarang) {
            return response()->json([ 'success' => false, 'message' => 'Jenis barang tidak ditemukan' ], 400);
        }

        $pService = new PrediksiService();

        $prob = $pService->getProbabilitas();
        $jenis = $pService->getNilaiAtributJenisBarang(['jenis' => $jenisBarang]);
        $kriteria = $pService->getNilaiAtributKriteriaHarga(['kriteria' => $request->kriteria_harga]);
        $permintaan = $pService->getNilaiAtributPermintaan(['nilai' => (int) $request->permintaan]);
        $hasilPrediksi = $pService->hasilPrediksi($jenis, $kriteria, $permintaan);

        $prediksi = collect([
            'prob' => $prob,
            'jenis_barang' => $jenis,
            'kriteria' => $kriteria,
            'permintaan' => $permintaan,
            'hasil' => $hasilPrediksi
        ]);

        $store = Prediksi::create([
            'jenis_barang_id' => $request->jenis_barang_id,
            'nama_barang' => $request->nama_barang,
            'jenis_barang' => $jenisBarang->jenis_barang,
            'bulan' => $request->bulan,
            'permintaan' => $request->permintaan,
            'kriteria_harga' => $request->kriteria_harga,
            'hasil' => $hasilPrediksi['value'],
            'data_prediksi' => json_encode($prediksi)
        ]);

        return new PrediksiResource($store);
    }

    public function destroy(Request $request, Prediksi $prediksi)
    {
        $prediksi->delete();

        return response()->json([
            'message' => 'success',
        ], 200);
    }
}
