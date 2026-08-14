<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pelanggan extends Model
{
    use HasFactory;
    protected $fillable =[
        'nama_pelanggan',
        'nik',    
        'nomor_hp',    
        'alamat',    
    ];
    public function penyewaans(){
        return $this->hasMany(Penyewaan::class);
    }
}
