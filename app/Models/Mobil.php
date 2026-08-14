<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mobil extends Model
{
    use HasFactory;
    protected $fillable = ['nama_mobil', 'merk', 'plat_nomor', 'tahun_mobil', 'harga_sewa', 'status'];

    public function penyewaans(){
        return $this->hasMany(Penyewaan::class);
    }
}
