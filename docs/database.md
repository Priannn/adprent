# Database

## Deskripsi

Database digunakan untuk menyimpan data akun, pelanggan, mobil, dan transaksi penyewaan.

## Tabel Utama

### users

Menyimpan data akun pengguna dan role.

Contoh field:

- `id`
- `name`
- `email`
- `password`
- `role`

### pelanggans

Menyimpan data pelanggan.

### mobils

Menyimpan data mobil yang tersedia pada sistem rental.

### penyewaans

Menyimpan data transaksi penyewaan.

## Relasi

```text
users
  │
  │ 1 : 1
  ↓
pelanggans
  │
  │ 1 : N
  ↓
penyewaans
  │
  │ N : 1
  ↓
mobils
```

## Ringkasan Relasi

- User memiliki satu data pelanggan.
- Pelanggan memiliki banyak penyewaan.
- Mobil dapat memiliki banyak riwayat penyewaan.
- Penyewaan dimiliki oleh satu pelanggan dan satu mobil.
