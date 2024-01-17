<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Peminjaman extends Model
{
    use HasFactory;
    protected $table = 'peminjaman';
    protected $fillable = [
        'mobil_id',
        'user_id',
        'tanggal_mulai',
        'tanggal_selesai',
    ];

    public function mobil()
    {
        return $this->belongsTo(Mobil::class, 'mobil_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
