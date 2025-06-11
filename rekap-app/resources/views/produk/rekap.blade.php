@extends('layouts.app') <!-- Pastikan Anda menggunakan layout utama, atau bisa diubah sesuai struktur layout Anda -->

@section('content')
<div class="d-flex">
  <!-- Include Sidebar Navbar -->
  @include('layouts.navbar') <!-- Mengimpor file navbar.blade.php -->
  @include('layouts.card')

  <!-- Konten di sebelah kanan sidebar -->
  <div class="p-4" style="flex-grow: 1; margin-left: 100px;">
    <div class="container">
        <br>
        <br>
        <br>
      <h2>Laporan Data Penjualan</h2>
      <a href="" class="btn btn-primary">Excel</a>
      <a href="" class="btn btn-secondary pull-right" target="_blank">PDF</a>
      <a href="" class="btn btn-dark">Chart</a>
      <table class="table table-bordered table-striped" id="tabel-produk">
          <thead>
              <tr>
                  <th style="width:1%">No.</th>
                  <th style="width:5%">Nama Toko</th>
                  <th style="width:5%">Alamat Toko</th>
                  <th style="width:5%">Tanggal Pemesanan</th>
                  <th style="width:5%">Ukuran</th>
                  <th style="width:5%">Jumlah Pesanan</th>
                  <th style="width:5%">Harga</th>
                  <th style="width:5%">Aksi</th>
              </tr>
          </thead>
      </table>
    </div>
  </div>
</div>
@endsection
