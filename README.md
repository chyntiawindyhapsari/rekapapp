# Aplikasi Rekap Penjualan

## Tujuan

Aplikasi Rekap Penjualan dibuat untuk mempermudah pencatatan dan pengelolaan data penjualan secara terstruktur. Aplikasi ini dapat digunakan untuk mencatat transaksi penjualan serta melihat rekap pendapatan dan omzet berdasarkan data yang telah diinput.

## Fitur

### Manajemen Penjualan

* **Input Penjualan**
  Tambahkan data transaksi penjualan seperti tanggal, produk, jumlah, harga, dan total penjualan.

* **Edit Penjualan**
  Ubah data transaksi penjualan yang sudah tersimpan.

* **Hapus Penjualan**
  Hapus data transaksi dengan konfirmasi terlebih dahulu.

* **Pencarian Penjualan**
  Cari data penjualan berdasarkan informasi transaksi.

### Rekap Penjualan

* **Total Penjualan**
  Menampilkan jumlah keseluruhan transaksi penjualan.

* **Pendapatan**
  Menampilkan total pendapatan berdasarkan transaksi yang telah dicatat.

* **Omzet**
  Menampilkan total omzet penjualan dalam periode tertentu.

* **Rekap Berdasarkan Periode**
  Melihat data penjualan berdasarkan rentang tanggal tertentu.

### Dashboard

Dashboard menampilkan ringkasan informasi penjualan secara sederhana, seperti:

* Total transaksi
* Total produk terjual
* Total pendapatan
* Total omzet
* Rekap penjualan berdasarkan periode

## Cara Menjalankan

1. Clone repository ini:

   ```bash
   git clone https://github.com/chyntiawindyhapsari/rekap_app.git
   ```

2. Go to the project directory:

   ```bash
   cd rekap_app
   ```

3. Instal dependensi Laravel:

   ```bash
   composer install
   ```

4. Copy `.env.example` dan rename menjadi `.env`:

   ```bash
   cp .env.example .env
   ```

5. Generate application key:

   ```bash
   php artisan key:generate
   ```

6. Konfigurasi database pada file `.env`, kemudian jalankan migration:

   ```bash
   php artisan migrate
   ```

7. Jalankan aplikasi:

   ```bash
   php artisan serve
   ```

8. Buka aplikasi melalui:

   ```text
   http://127.0.0.1:8000
   ```

## Struktur Data Penjualan

Data penjualan dapat mencakup beberapa informasi seperti:

| Data       | Keterangan                |
| ---------- | ------------------------- |
| Tanggal    | Tanggal transaksi         |
| Produk     | Nama produk yang dijual   |
| Jumlah     | Jumlah produk terjual     |
| Harga      | Harga jual produk         |
| Total      | Total nilai transaksi     |
| Pendapatan | Pendapatan dari transaksi |
| Omzet      | Akumulasi nilai penjualan |

## Rekapitulasi

Aplikasi menyediakan informasi rekap untuk membantu pengguna memantau perkembangan penjualan, antara lain:

* Rekap penjualan harian
* Rekap penjualan bulanan
* Total pendapatan
* Total omzet
* Jumlah transaksi
* Jumlah produk terjual

## Teknologi

* **Laravel**
* **PHP**
* **MySQL**
* **Blade / HTML**
* **CSS**
* **JavaScript**

## Tentang Aplikasi

Aplikasi Rekap Penjualan merupakan aplikasi sederhana yang dibuat untuk membantu proses pencatatan transaksi dan pemantauan hasil penjualan secara lebih terorganisir.
