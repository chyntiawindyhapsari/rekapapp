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
      <h2>Data Pembelian Produk</h2>
      <a href="{{route('produk.createproduk')}}" class="btn btn-success">+Tambah Data</a>
      <table class="table table-bordered table-striped" id="tabel-produk">
          <thead>
              <tr>
                  <th style="width:1%">No.</th>
                  <th style="width:5%">Nama Toko</th>
                  <th style="width:5%">Alamat Toko</th>
                  <th style="width:5%">Desain</th>
                  <th style="width:5%">Bentuk Desain</th>
                  <th style="width:5%">Ukuran</th>
                  <th style="width:5%">Jumlah Pesanan</th>
                  <th style="width:5%">Aksi</th>
              </tr>
          </thead>
          <tbody>
            @foreach ($dataProduk as $data)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $data->nama_toko }}</td>
                <td>{{ $data->alamat_toko }}</td>
                <td>
                    <img src="{{ asset('images/' . $data->desain) }}" alt="Desain Produk" style="width: 100px; height: auto;">
                </td>
                <td>{{ $data->bentuk_desain }}</td>
                <td>{{ $data->ukuran }}</td>
                <td>{{ $data->jumlah_pesanan }}</td>
                <td>
                  <form action="{{ route('produk.destroy', $data->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Apakah Anda yakin ingin menghapus produk ini?');">
                      @csrf
                      @method('DELETE')
                      <a href="{{ route('produk.edit', $data->id) }}" class="btn btn-warning">Ubah</a>
                      <button type="submit" class="btn btn-danger">Hapus</button>
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
