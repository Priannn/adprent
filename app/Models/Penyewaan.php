<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penyewaan extends Model
{
    use HasFactory;
    protected $fillable = [
        'pelanggan_id',
        'mobil_id',
        'tanggal_sewa',
        'tanggal_kembali',
        'total_harga',
        'status',
    ];
    public function pelanggan(){
        return $this->belongsTo(Pelanggan::class);
    }
    public function mobil(){
        return $this->belongsTo(Mobil::class);
    }
}
