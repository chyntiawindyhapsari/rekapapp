@extends('layouts.app')

@section('content')
<div class="d-flex">

  <div class="p-4" style="flex-grow: 1; margin-left: 0px;">
    <div class="container">
        <h2 class="text-left text-dark mb-4"><b>Edit Data Penjualan</b></h2>

        <!-- Form untuk mengedit data penjualan -->
        <form action="{{ route('penjualan.update', $penjualan->id) }}" method="POST">
            @csrf
            @method('PUT') <!-- Tambahkan metode PUT untuk update -->
            <div class="form-group">
                <label for="nama_toko" class="font-weight-bold text-dark">Nama Toko</label>
                <input type="text" name="nama_toko" id="nama_toko" 
                    class="form-control @error('nama_toko') is-invalid @enderror" 
                    value="{{ old('nama_toko', $penjualan->nama_toko) }}" placeholder="Cari nama toko..." required autocomplete="off">
                @error('nama_toko')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="tanggal_penjualan" class="font-weight-bold text-dark">Tanggal Penjualan</label>
                <input type="date" name="tanggal_penjualan" id="tanggal_penjualan" class="form-control @error('tanggal_penjualan') is-invalid @enderror" value="{{ old('tanggal_penjualan', $penjualan->tanggal_penjualan) }}" required>
                @error('tanggal_penjualan')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="harga" class="font-weight-bold text-dark">Harga</label>
                <input type="number" name="harga" id="harga" class="form-control @error('harga') is-invalid @enderror" value="{{ old('harga', $penjualan->harga) }}" required>
                @error('harga')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="jumlah_pesanan">Jumlah Pesanan</label>
                <input type="number" id="jumlah_pesanan" class="form-control" value="{{ old('jumlah_pesanan', $penjualan->jumlah_pesanan) }}" required>
            </div>

            <div class="form-group d-flex justify-content-end">
                <button type="submit" class="btn btn-success btn-lg px-5 py-2 btn-3d mr-2">Perbarui Data</button>
                <a href="{{ route('penjualan.penjualan') }}" class="btn btn-secondary btn-lg px-5 py-2 btn-3d">Batal</a>
            </div>
        </form>
    </div>
  </div>
</div>
@endsection


@section('styles')
    <style>
        .container {
            max-width: 600px; /* Membatasi lebar form supaya tidak terlalu lebar */
        }
        .btn-lg {
            font-size: 12px;
            padding: 12px 25px;
        }
        .form-control {
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
        }

        .form-control:focus {
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
            transform: scale(1.05);
        }

        .font-weight-bold {
            font-weight: 600;
        }

        .text-dark {
            color: #333 !important;
        }

        .card {
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .invalid-feedback {
            display: block;
            color: #e74a3b;
        }

        .btn-3d {
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
            transition: all 0.3s ease;
        }

        .btn-3d:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
        }

        .text-center {
            text-align: center;
        }

        /* Menambahkan margin ke tombol tambah data */
        .form-group.d-flex {
            margin-top: 20px;
        }

        /* Agar tombol tidak terlalu rapat */
        .form-group .btn {
            margin-left: 10px;
        }
    </style>
@endsection
