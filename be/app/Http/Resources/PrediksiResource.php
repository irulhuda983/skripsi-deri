<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PrediksiResource extends JsonResource
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
            'id' => $this->id,
            'nama_barang' => $this->nama_barang,
            'jenis_barang' => optional($this->jenis_barang),
            'bulan' => $this->bulan,
            'permintaan' => $this->permintaan,
            'kriteria_harga' => $this->kriteria_harga,
            'hasil' => $this->hasil,
            'prediksi' => json_decode($this->data_prediksi),
        ];
    }
}
