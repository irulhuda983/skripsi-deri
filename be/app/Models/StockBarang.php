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

    public function scopeHasil($query, $hasil) {
        if($hasil) {
            return $query->where('hasil', $hasil);
        }

        return $query;
    }
}
