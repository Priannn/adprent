# Data Pelanggan

## Deskripsi

Modul Data Pelanggan digunakan untuk menyimpan informasi pelanggan yang melakukan penyewaan mobil.

## Data Pelanggan

Field yang digunakan:

- `nama_pelanggan`
- `nik`
- `nomor_hp`
- `alamat`

## Relasi

Pelanggan memiliki banyak data penyewaan:

`Pelanggan hasMany Penyewaan`

Pelanggan juga terhubung dengan akun user:

`Pelanggan belongsTo User`

## Authentication

Saat pengguna melakukan register, data akun disimpan pada tabel `users`, sedangkan data identitas pelanggan disimpan pada tabel `pelanggans`.
