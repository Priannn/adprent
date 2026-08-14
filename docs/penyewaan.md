# Data Penyewaan

## Deskripsi

Modul Penyewaan digunakan untuk mencatat transaksi rental mobil antara pelanggan dan mobil yang disewa.

## Data Penyewaan

Field yang digunakan:

- `pelanggan_id`
- `mobil_id`
- `tanggal_sewa`
- `tanggal_kembali`
- `total_harga`
- `status`

## Alur Penyewaan

1. Pengguna memilih mobil yang tersedia.
2. Sistem mengambil harga sewa mobil.
3. Pengguna menentukan tanggal sewa dan tanggal kembali.
4. Sistem menghitung jumlah hari penyewaan.
5. Sistem menghitung total harga.
6. Data penyewaan disimpan.
7. Status mobil berubah menjadi `disewa`.

## Perhitungan Harga

Total harga dihitung berdasarkan:

`harga sewa per hari × jumlah hari`

Minimal jumlah hari penyewaan adalah 1 hari.

## Validasi Bentrok

Sistem memeriksa apakah mobil sedang memiliki penyewaan dengan status `disewa` pada periode yang sama.

Jika terjadi bentrok, pengguna tidak dapat menyewa mobil tersebut pada periode tersebut.

## Penyelesaian Penyewaan

Saat penyewaan selesai:

- Status penyewaan berubah menjadi `selesai`.
- Status mobil berubah kembali menjadi `tersedia`.

## Relasi

- Penyewaan belongsTo Pelanggan
- Penyewaan belongsTo Mobil
