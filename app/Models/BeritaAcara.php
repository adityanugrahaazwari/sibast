<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BeritaAcara extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'nomor',
        'nama',
        'nama_ppk',
        'nama_pejabat_pengadaan',
        'informasi',
        'file_path',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function items()
    {
        return $this->hasMany(BeritaAcaraItem::class);
    }
}
