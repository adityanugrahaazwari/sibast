<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BeritaAcaraItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'berita_acara_id',
        'nama_barang',
        'jumlah',
        'satuan',
        'harga_satuan',
    ];

    public function beritaAcara()
    {
        return $this->belongsTo(BeritaAcara::class);
    }
}
