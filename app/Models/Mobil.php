<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mobil extends Model
{
    use HasFactory;
    protected $table = 'cars';
    protected $fillable = [
        'merek',
        'model',
        'nomor_plat',
        'tarif_sewa',
        'ketersediaan',
    ];

    protected $casts = [
        'ketersediaan' => 'boolean',
    ];
    public function pengembalian()
    {
        return $this->hasMany(Pengembalian::class, 'mobil_id');
    }
    public function peminjaman()
    {
        return $this->hasMany(Peminjaman::class, 'mobil_id');
    }
}
