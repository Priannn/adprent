# Data Mobil

## Deskripsi

Modul Data Mobil digunakan untuk mengelola informasi mobil yang tersedia pada sistem rental.

## Fitur

- Menampilkan data mobil
- Menambahkan mobil
- Mengedit data mobil
- Menghapus mobil
- Mengatur status mobil

## Data Mobil

Field yang digunakan:

- `nama_mobil`
- `merk`
- `plat_nomor`
- `tahun_mobil`
- `harga_sewa`
- `status`

## Status Mobil

Status mobil digunakan untuk mengetahui apakah mobil sedang dapat disewa atau sedang digunakan.

Status yang digunakan:

- `tersedia`
- `disewa`

## Validasi

- Plat nomor harus unik.
- Nama mobil wajib diisi.
- Merk wajib diisi.
- Tahun mobil harus berupa angka.
- Harga sewa harus berupa angka.
