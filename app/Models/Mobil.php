<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mobil extends Model
{
    use HasFactory;
    protected $fillable = ['nama_mobil', 'merk', 'gambar', 'bahan_bakar', 'transmisi', 'jumlah_seat', 'harga_sewa', 'status'];

    public function penyewaans(){
        return $this->hasMany(Penyewaan::class);
    }
}
