# Laporan Tugas Pertemuan 7 — Aplikasi Penjualan Berbasis MVC (PHP & MySQL)
Nama: Alfin Romi Setiawan

NPM: 4524210009

Mata Kuliah: Prak. Pemrograman Berbasis Web

---
## 1. Tujuan dan Ketentuan Tugas
Berdasarkan ketentuan modul pada Pertemuan 7:
1. Membuat kode dan output program menggunakan pola arsitektur **MVC (Model-View-Controller)** sesuai struktur folder `penjualan-mvc`.
2. Membuat database MySQL untuk menampung data input program.
3. Menyertakan dokumentasi/screenshot hasil tugas (halaman daftar produk, form tambah produk, dan form edit produk).

---

## 2. Struktur Folder Proyek
Struktur folder `penjualan-mvc` dibuat sesuai ketentuan:

```text
penjualan-mvc/
├── index.php
├── koneksi.php
├── controllers/
│   └── ProdukController.php
├── models/
│   └── ProdukModel.php
└── views/
    └── produk/
        ├── index.php
        ├── create.php
        └── edit.php
```

---

## 3. Rancangan Database
- **Nama Database:** `penjualan`
- **Nama Tabel:** `produk`
- **Kolom:** `id`, `nama_produk`, `harga`, `stok`

Query SQL pembuatan database, tabel, dan data awal:

```sql
CREATE DATABASE IF NOT EXISTS penjualan;
USE penjualan;

CREATE TABLE IF NOT EXISTS produk (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama_produk VARCHAR(100) NOT NULL,
    harga INT NOT NULL,
    stok INT NOT NULL
);

INSERT INTO produk (nama_produk, harga, stok) VALUES
('Laptop ASUS Vivobook', 8500000, 10),
('Mouse Wireless Logitech', 250000, 25),
('Keyboard Mechanical', 650000, 15);
```

---

## 4. Penjelasan Implementasi MVC

### a. Koneksi Database (`penjualan-mvc/koneksi.php`)
Menghubungkan aplikasi PHP ke MySQL (`127.0.0.1:3306`, user `root`, database `penjualan`) menggunakan `mysqli_connect()`. Jika koneksi gagal, program berhenti dan menampilkan pesan error.

### b. Front Controller / Routing (`penjualan-mvc/index.php`)
Mengimpor `koneksi.php` dan `controllers/ProdukController.php`, membuat instance `ProdukController($koneksi)`, lalu membaca parameter `$_GET['action']` (default `index`) untuk memanggil method yang sesuai:
- `index` → `ProdukController::index()` (menampilkan daftar produk)
- `create` → `ProdukController::create()` (menampilkan form tambah atau memproses `POST`)
- `store` → `ProdukController::store()` (menyimpan produk baru)
- `edit` → `ProdukController::edit()` (menampilkan form edit berdasarkan `id` atau memproses `POST`)
- `update` → `ProdukController::update()` (memperbarui produk yang dipilih)
- `delete` → `ProdukController::delete()` (menghapus produk berdasarkan `id`)

### c. Model (`penjualan-mvc/models/ProdukModel.php`)
Class `ProdukModel` menangani seluruh interaksi dengan tabel `produk` menggunakan prepared statement `mysqli`:
- `getAllProduk()` — Mengambil seluruh data produk (`SELECT * FROM produk ORDER BY id ASC`).
- `getProdukById($id)` — Mengambil satu data produk berdasarkan `id`.
- `createProduk($nama_produk, $harga, $stok)` — Menambahkan data produk baru (`INSERT`).
- `updateProduk($id, $nama_produk, $harga, $stok)` — Memperbarui data produk (`UPDATE`).
- `deleteProduk($id)` — Menghapus data produk (`DELETE`).

### d. Controller (`penjualan-mvc/controllers/ProdukController.php`)
Class `ProdukController` menghubungkan `ProdukModel` dengan file view:
- Memvalidasi input (`nama_produk` tidak kosong, `harga` dan `stok` tidak bernilai negatif).
- Mengirim data `$produk` ke view atau mengarahkan kembali (`header("Location: index.php")`) setelah proses simpan, ubah, atau hapus selesai.

### e. View (`penjualan-mvc/views/produk/`)
- `index.php` — Menampilkan tabel daftar produk (`ID`, `Nama Produk`, `Harga` dalam format `Rp`, `Stok`, serta tombol aksi **Edit** dan **Hapus**) dan tombol **+ Tambah Produk**.
- `create.php` — Form tambah data produk (`nama_produk`, `harga`, `stok`) yang dikirim dengan method `POST` ke `index.php?action=store`.
- `edit.php` — Form ubah data produk yang sudah terisi nilai produk terpilih (`id` tersembunyi, `nama_produk`, `harga`, `stok`) dan dikirim dengan method `POST` ke `index.php?action=update`.

---

## 5. Cara Menjalankan Program
1. Pastikan service **Apache** dan **MySQL** di XAMPP aktif.
2. Pastikan database `penjualan` dan tabel `produk` sudah tersedia di MySQL.
3. Buka browser dan akses URL berikut:
   ```text
   http://localhost/pert%207/penjualan-mvc/index.php
   ```

---

## 6.Screenshot Tugas

### Lampiran Screenshot
Silakan lengkapi bagian di bawah ini dengan screenshot dari browser Anda:

1. **Halaman Daftar Produk (`index.php`)**
   - URL: `http://localhost/pert%207/penjualan-mvc/index.php`
   - (penjualan-mvc/screenshots/daftar-produk.png)

2. **Halaman Tambah Produk (`index.php?action=create`)**
   - URL: `http://localhost/pert%207/penjualan-mvc/index.php?action=create`
   - (penjualan-mvc/screenshots/tambah-produk.png)

3. **Halaman Edit Produk (`index.php?action=edit&id=1`)**
   - URL: `http://localhost/pert%207/penjualan-mvc/index.php?action=edit&id=1`
   - (penjualan-mvc/screenshots/edit-produk.png)
