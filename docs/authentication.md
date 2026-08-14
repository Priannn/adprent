# Authentication

## Deskripsi

Modul authentication digunakan untuk mengatur proses registrasi, login, logout, dan pembagian akses berdasarkan role pengguna.

## Fitur

- Register akun
- Login
- Logout
- Role `user`
- Role `admin`
- Middleware untuk membatasi akses dashboard

## Alur Register

Saat pengguna melakukan register, sistem menyimpan:

- Data akun ke tabel `users`
- Data pelanggan ke tabel `pelanggans`
- Relasi antara `users` dan `pelanggans`

## Alur Login

Setelah berhasil login, pengguna diarahkan berdasarkan role:

- `user` → Landing Page
- `admin` → Dashboard

## Authorization

Halaman dashboard dilindungi menggunakan `AdminMiddleware`.

User dengan role `user` tidak dapat mengakses dashboard dan akan mendapatkan response `403 Forbidden`.

## Teknologi

- Laravel
- PHP
- MySQL
- Tailwind CSS
