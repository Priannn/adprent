# 🚗 Rental Mobil

**Web-Based Car Rental Management System**

Aplikasi rental mobil berbasis web yang dibuat untuk mengelola proses penyewaan mobil secara terstruktur, mulai dari pengelolaan data mobil, pelanggan, akun pengguna, hingga transaksi penyewaan.

Project ini dikembangkan menggunakan Laravel dan dirancang dengan dua jenis pengguna, yaitu **User** dan **Admin**, dengan hak akses yang berbeda.

---

## 📌 Overview

Sistem Rental Mobil ini memiliki dua sisi utama:

### 👤 User

User merupakan pelanggan yang menggunakan sistem untuk melihat dan melakukan penyewaan mobil.

User dapat:

- Membuat akun
- Login dan logout
- Melihat mobil yang tersedia
- Melihat informasi mobil
- Melakukan penyewaan
- Melihat informasi penyewaan

### 🛠️ Admin

Admin bertanggung jawab mengelola seluruh data rental melalui dashboard.

Admin dapat:

- Melihat dashboard
- Mengelola data mobil
- Mengelola data pelanggan
- Mengelola data penyewaan
- Melihat status mobil
- Melihat informasi transaksi penyewaan

---

## ✨ Features

### Authentication

- Register
- Login
- Logout
- Password hashing
- Session authentication
- Role-based authentication
- Admin middleware

### 🚗 Management Mobil

- Menampilkan data mobil
- Menambahkan mobil
- Mengedit data mobil
- Menghapus mobil
- Mengatur status mobil
- Menampilkan harga sewa

Status mobil:

- `tersedia`
- `disewa`

### 👥 Management Pelanggan

- Menampilkan data pelanggan
- Menyimpan informasi pelanggan
- Menghubungkan pelanggan dengan akun user
- Menghubungkan pelanggan dengan transaksi penyewaan

### 📋 Management Penyewaan

- Membuat transaksi penyewaan
- Memilih pelanggan
- Memilih mobil
- Menentukan tanggal sewa
- Menentukan tanggal kembali
- Menghitung total harga secara otomatis
- Mencegah bentrok jadwal penyewaan
- Mengubah status penyewaan
- Menyelesaikan transaksi penyewaan

### 📊 Dashboard

Dashboard admin menyediakan informasi ringkas mengenai sistem rental, seperti:

- Total mobil
- Total pelanggan
- Total penyewaan
- Total pendapatan
- Penyewaan terbaru
- Status mobil

---

# 🔐 Role & Access Control

Sistem menggunakan dua role:

| Role | Access |
|------|--------|
| User | Landing Page & fitur penyewaan |
| Admin | Dashboard & seluruh management system |

Dashboard hanya dapat diakses oleh pengguna dengan role `admin`.

```text
                    LOGIN
                      │
             ┌────────┴────────┐
             │                 │
           USER              ADMIN
             │                 │
             ↓                 ↓
       Landing Page        Dashboard
             │                 │
             ↓          ┌──────┼──────┐
          Rental         │      │      │
          Mobil         Mobil  User  Penyewaan