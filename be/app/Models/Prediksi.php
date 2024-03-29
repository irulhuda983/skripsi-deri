<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prediksi extends Model
{
    use HasFactory;

    protected $table = 'prediksi';

    protected $guarded = ['id'];

    public function jenisBarang()
    {
        return $this->belongsTo(JenisBarang::class);
    }
}
