@extends('layouts.app')

@section('content')
<div class="d-flex">
  <!-- Include Sidebar Navbar -->
  @include('layouts.navbar')

  <!-- Konten di sebelah kanan sidebar -->
  <div class="p-4" style="flex-grow: 1; margin-left: 250px;">
    <div class="container">
        <h2 class="text-left text-dark mb-4"><b>Tambah Data Pembelian Produk</b></h2>

        <!-- Form untuk menambahkan data produk -->
        <form action="{{route('produk.store')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="card shadow-sm p-4 mb-4">
                <div class="form-group">
                    <label for="nama_toko" class="font-weight-bold text-dark">Nama Toko</label>
                    <input type="text" name="nama_toko" id="nama_toko" class="form-control @error('nama_toko') is-invalid @enderror" value="{{ old('nama_toko') }}" required>
                    @error('nama_toko')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="alamat_toko" class="font-weight-bold text-dark">Alamat Toko</label>
                    <textarea name="alamat_toko" id="alamat_toko" class="form-control @error('alamat_toko') is-invalid @enderror" rows="4" placeholder="Masukkan alamat toko di sini" required>{{ old('alamat_toko') }}</textarea>
                    @error('alamat_toko')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="desain" class="font-weight-bold text-dark">Desain</label>
                    <input type="file" name="desain" id="desain" class="form-control @error('desain') is-invalid @enderror" accept=".png, .jpg, .jpeg" required>
                    @error('desain')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="bentuk_desain" class="font-weight-bold text-dark">Bentuk Desain</label>
                    <input type="text" name="bentuk_desain" id="bentuk_desain" class="form-control @error('bentuk_desain') is-invalid @enderror" value="{{ old('bentuk_desain') }}" required>
                    @error('bentuk_desain')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="ukuran" class="font-weight-bold text-dark">Ukuran</label>
                    <input type="text" name="ukuran" id="ukuran" class="form-control @error('ukuran') is-invalid @enderror" value="{{ old('ukuran') }}" required>
                    @error('ukuran')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="jumlah_pesanan" class="font-weight-bold text-dark">Jumlah Pesanan</label>
                    <input type="number" name="jumlah_pesanan" id="jumlah_pesanan" class="form-control @error('jumlah_pesanan') is-invalid @enderror" value="{{ old('jumlah_pesanan') }}" required>
                    @error('jumlah_pesanan')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
                
                <!-- Tombol Posisi Pojok Kanan -->
                <div class="form-group d-flex justify-content-end">
                    <button type="submit" class="btn btn-success btn-lg px-5 py-2 btn-3d mr-2">Tambah Data</button>
                    <a href="{{ route('produk.produk') }}" class="btn btn-secondary btn-lg px-5 py-2 btn-3d">Batal</a>
                </div>
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
