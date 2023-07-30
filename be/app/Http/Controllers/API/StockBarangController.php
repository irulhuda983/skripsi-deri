<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\StockBarang;
use App\Http\Resources\StockBarangResource;

class StockBarangController extends Controller
{
    public function index(Request $request)
    {
        $data = StockBarang::hasil($request->hasil)->get();

        return StockBarangResource::collection($data);
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

    public function destroy(Request $request, StockBarang $stock)
    {
        $stock->delete();

        return response()->json([
            'data' => new StockBarangResource($stock),
            'message' => 'success',
        ], 200);
    }
}
