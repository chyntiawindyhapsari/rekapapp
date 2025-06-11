@extends('layouts.app') <!-- Pastikan Anda menggunakan layout utama, atau bisa diubah sesuai struktur layout Anda -->

@section('content')
<div class="d-flex">
  <!-- Include Sidebar Navbar -->
  @include('layouts.navbar') <!-- Mengimpor file navbar.blade.php -->
  <div class="p-4" style="flex-grow: 1; margin-left: 250px;">
    <div class="container">
        <br>
        <br>
        <br>
      <h2>Data Penjualan</h2>
      <a href="{{route('penjualan.createjual')}}" class="btn btn-success">+Tambah Data</a>
      <table class="table table-bordered table-striped" id="tabel-produk">
          <thead>
              <tr>
                  <th style="width:1%">No.</th>
                  <th style="width:5%">Nama Toko</th>
                  <th style="width:5%">Tanggal Pemesanan</th>
                  <th style="width:5%">Jumlah Pesanan</th>
                  <th style="width:5%">Harga</th>
                  <th style="width:5%">Aksi</th>
              </tr>
          </thead>
          <tbody>
              @foreach ($dataPenjualan as $data)
              <tr>
                  <td>{{ $loop->iteration }}</td> <!-- Menampilkan nomor urut -->
                  <td>{{ $data->nama_toko }}</td> <!-- Nama toko dari database -->
                  <td>{{ $data->tanggal_penjualan }}</td> <!-- Tanggal penjualan -->
                  <td>{{ $data->jumlah_pesanan }}</td> <!-- Jumlah produk -->
                  <td>{{ number_format($data->harga, 2) }}</td> <!-- Harga produk dengan format dua angka desimal -->
                  <td>
                      <a href="{{ route('penjualan.editjual', $data->id) }}" class="btn btn-warning btn-sm">Edit</a> <!-- Tombol edit -->
                      <form action="" method="POST" style="display:inline;">
                          @csrf
                          @method('DELETE')
                          <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this item?')">Delete</button> <!-- Tombol delete -->
                      </form>
                  </td>
              </tr>
              @endforeach
          </tbody>
      </table>
    </div>
  </div>
</div>
@endsection
