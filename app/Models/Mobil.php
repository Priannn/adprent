<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Mobil extends Model
{
    use SoftDeletes;
    use HasFactory;
    protected $fillable = ['nama_mobil', 'merk', 'gambar', 'bahan_bakar', 'transmisi', 'jumlah_seat', 'harga_sewa', 'status'];

    public function penyewaans(){
        return $this->hasMany(Penyewaan::class);
    }
}
