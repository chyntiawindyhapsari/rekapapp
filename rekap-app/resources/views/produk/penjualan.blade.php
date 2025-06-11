@extends('layouts.app') <!-- Pastikan Anda menggunakan layout utama, atau bisa diubah sesuai struktur layout Anda -->

@section('content')
<div class="d-flex">
  <!-- Include Sidebar Navbar -->
  @include('layouts.navbar') <!-- Mengimpor file navbar.blade.php -->
  @include('layouts.card')
  <div class="p-4" style="flex-grow: 1; margin-left: 100px;">
    <div class="container">
        <br>
        <br>
        <br>
      <h2>Data Penjualan</h2>
      <a href="" class="btn btn-success">+Tambah Data</a>
      <table class="table table-bordered table-striped" id="tabel-produk">
          <thead>
              <tr>
                  <th style="width:1%">No.</th>
                  <th style="width:5%">Kode Pemesanan</th>
                  <th style="width:5%">Tanggal Pemesanan</th>
                  <th style="width:5%">Harga</th>
                  <th style="width:5%">Aksi</th>
              </tr>
          </thead>
      </table>
    </div>
  </div>
</div>
@endsection
