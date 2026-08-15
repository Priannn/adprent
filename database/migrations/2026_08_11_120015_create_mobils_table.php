<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('mobils', function (Blueprint $table) {
            $table->id();
            $table->string('nama_mobil');
            $table->string('merk');
            $table->string('gambar')->nullable();
            $table->enum('transmisi', ['matic', 'manual']);
            $table->integer('jumlah_seat');
            $table->integer('harga_sewa');
            $table->enum('status', ['tersedia', 'disewa'])->default('tersedia');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('mobils');
    }
};