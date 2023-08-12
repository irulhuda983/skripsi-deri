<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\StockBarang;
use App\Http\Resources\StockBarangResource;
use App\Models\JenisBarang;

class StockBarangController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search ?? null;
        $jenis = $request->jenis ?? null;
        $kriteria = $request->kriteria ?? null;
        list($col, $sort) = explode(':', $request->order ?? 'nama_barang:asc');

        $query = StockBarang::search($search)->jenis($jenis)->kriteria($kriteria)->hasil($request->hasil)->orderBy($col, $sort);

        return StockBarangResource::collection($query->get());
    }

    public function show(StockBarang $stock)
    {
        return new StockBarangResource($stock);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_barang' => 'required',
            'jenis_barang_id' => 'required',
            // 'bulan' => 'required',
            'permintaan' => 'required',
            'kriteria_harga' => 'required',
            'hasil' => 'required',
        ]);

        $stock = StockBarang::create([
            'nama_barang' => $request->nama_barang,
            'jenis_barang_id' => $request->jenis_barang_id,
            // 'bulan' => $request->bulan,
            'permintaan' => $request->permintaan,
            'kriteria_harga' => $request->kriteria_harga,
            'hasil' => $request->hasil,
        ]);

        return response()->json([
            'data' => new StockBarangResource($stock),
            'message' => 'success',
        ], 200);
    }

    public function update(Request $request, StockBarang $stock)
    {
        $request->validate([
            'nama_barang' => 'required',
            'jenis_barang_id' => 'required',
            'bulan' => 'required',
            'permintaan' => 'required',
            'kriteria_harga' => 'required',
            'hasil' => 'required',
        ]);

        $updateData = $stock->update([
            'nama_barang' => $request->nama_barang,
            'jenis_barang_id' => $request->jenis_barang_id,
            'bulan' => $request->bulan,
            'permintaan' => $request->permintaan,
            'kriteria_harga' => $request->kriteria_harga,
            'hasil' => $request->hasil,
        ]);

        return response()->json([
            'data' => new StockBarangResource($stock),
            'message' => 'success',
        ], 200);
    }

    public function uploadCsv(Request $request)
    {
        // $request->validate([
        //     'file' => 'required|file|mimes:csv|max:10240'
        // ]);

        $fp = fopen($request->file, 'r');
        $headers = fgetcsv($fp); // Get column headers
        
        $data = array();
        while (($row = fgetcsv($fp)) !== false) {
            $data[] = array_combine($headers, $row);
        }
        fclose($fp);
        
        $json = json_encode($data, JSON_PRETTY_PRINT);
        $decodeJson = json_decode($json, true);

        // return response()->json($decodeJson, 200);
        $arr = [];
        $error = [];
        $uploadedFile = [];

        foreach($decodeJson as $item) {
            if(!isset($item['nama']) || !isset($item['jenis']) || !isset($item['stok']) || !isset($item['k_harga']) || !isset($item['hasil'])) {
                array_push($error, $item);
            }
        }

        if( count($error) > 0 ) {
            return response()->json(['error' => 'format not valid', 'data' => $error], 400);
        }

        try{
            // DB::beginTransaction();
            StockBarang::truncate();
            foreach($decodeJson as $item) {
                $jenis = JenisBarang::where('jenis_barang', $item['jenis'])->where('status', 1)->first();

                if($jenis) {
                    if($item['nama'] == '' || $item['jenis'] == '' || $item['stok'] == '' || $item['k_harga'] == '' || $item['hasil'] == '') {
                        $stock = $item;
                    }else{
                        $stok = StockBarang::create([
                            'nama_barang' => $item['nama'],
                            'jenis_barang_id' => $jenis->id,
                            'bulan' => 'januari',
                            'permintaan' => $item['stok'],
                            'kriteria_harga' => $item['k_harga'],
                            'hasil' => $item['hasil'],
                        ]);
                    }

                    array_push($data, $stok);
                }
            }
  
            // DB::commit();

            return response()->json($arr, 200);
        }catch(\Exception $e){
            // DB::rollBack();
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }

    public function destroy(Request $request, StockBarang $stock)
    {
        $stock->delete();

        return response()->json([
            'data' => new StockBarangResource($stock),
            'message' => 'success',
        ], 200);
    }
}
