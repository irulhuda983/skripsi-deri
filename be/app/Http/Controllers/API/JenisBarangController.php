<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\JenisBarang;
use App\Http\Resources\JenisBarangResource;

class JenisBarangController extends Controller
{
    
    public function index(Request $request)
    {
        $data = JenisBarang::all();

        return JenisBarangResource::collection($data);
    }

    public function show(JenisBarang $jenis)
    {

        return new JenisBarangResource($jenis);
    }

    public function store(Request $request)
    {
        $request->validate([
            'jenis_barang' => 'required',
            'status' => 'required',
        ]);

        $jenis = JenisBarang::create([
            'jenis_barang' => $request->jenis_barang,
            'status' => $request->status,
        ]);

        return response()->json([
            'data' => new JenisBarangResource($jenis),
            'message' => 'success',
        ], 200);
    }

    public function update(Request $request, JenisBarang $jenis)
    {
        $request->validate([
            'jenis_barang' => 'required',
            'status' => 'required',
        ]);

        $updateData = $jenis->update([
            'jenis_barang' => $request->jenis_barang,
            'status' => $request->status,
        ]);

        return response()->json([
            'data' => new JenisBarangResource($jenis),
            'message' => 'success',
        ], 200);
    }

    public function destroy(Request $request, JenisBarang $jenis)
    {
        $jenisBarang = JenisBarang::find($jenis->id)->delete();

        return response()->json([
            'data' => new JenisBarangResource($jenis),
            'message' => 'success',
        ], 200);
    }
}
