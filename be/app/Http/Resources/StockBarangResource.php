<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class StockBarangResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            "id" => $this->id,
            "nama_barang" => $this->nama_barang,
            "jenis_barang_id" => $this->jenis_barang_id,
            "jenis_barang" => $this->jenisBarang->jenis_barang,
            "bulan" => $this->bulan,
            "permintaan" => $this->permintaan,
            "kriteria_harga" => $this->kriteria_harga,
            "hasil" => $this->hasil,
        ];
    }
}
