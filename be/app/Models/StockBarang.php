<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StockBarang extends Model
{
    use HasFactory;

    protected $table = 'stock_barang';

    protected $guarded = ['id'];

    public function jenisBarang()
    {
        return $this->belongsTo(JenisBarang::class);
    }

    public function scopeSearch($query, $search) {
        if($search) {
            return $query->where(function (Builder $query) {
                $query->where('nama', 'like', '%'.$search.'%')
                      ->orWhere('permintaan', 'like', '%'.$search.'%');
            });
            // return $query->where('nama', 'like', '%'.$search.'%');
        }

        return $query;
    }

    public function scopeKriteria($query, $kriteria) {
        if($kriteria) {
            return $query->where('kriteria_harga', $kriteria);
        }

        return $query;
    }

    public function scopeJenis($query, $jenis) {
        if($jenis) {
            return $query->where('jenis_barang_id', $jenis);
        }

        return $query;
    }

    public function scopeHasil($query, $hasil) {
        if($hasil) {
            return $query->where('hasil', $hasil);
        }

        return $query;
    }
}
