@extends('layouts.app')

@section('content')
<div class="d-flex">

  <!-- Main Content -->
  <div class="p-4" style="flex-grow: 1; margin-left: 0px;">
    <div class="container">
        <h2 class="text-left text-dark mb-4"><b>Edit Data Penjualan</b></h2>

        <!-- Form for Editing Sales Data -->
        <form action="{{ route('penjualan.update', $penjualan->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <!-- Nama Toko -->
            <div class="form-group">
                <label for="nama_toko" class="font-weight-bold text-dark">Nama Toko</label>
                <input type="text" name="nama_toko" id="nama_toko" 
                    class="form-control @error('nama_toko') is-invalid @enderror" 
                    value="{{ old('nama_toko', $penjualan->nama_toko) }}" 
                    readonly required autocomplete="off">
                @error('nama_toko')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>

            <!-- Tanggal Penjualan -->
            <div class="form-group">
                <label for="tanggal_penjualan" class="font-weight-bold text-dark">Tanggal Penjualan</label>
                <input type="date" name="tanggal_penjualan" id="tanggal_penjualan" 
                    class="form-control @error('tanggal_penjualan') is-invalid @enderror" 
                    value="{{ old('tanggal_penjualan', $penjualan->tanggal_penjualan) }}" required>
                @error('tanggal_penjualan')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>

            <!-- Desain Sebelumnya -->
            <div class="form-group">
                <label for="current_desain" class="font-weight-bold text-dark">Desain Sebelumnya</label>
                @if ($penjualan->desain)
                    <div class="mb-3">
                        <img src="{{ asset('images/' . $penjualan->desain) }}" alt="Desain Sebelumnya" class="img-fluid" style="max-width: 200px;">
                    </div>
                @else
                    <p>No design uploaded.</p>
                @endif
            </div>

            <!-- Upload Desain Baru -->
            <div class="form-group">
                <label for="desain" class="font-weight-bold text-dark">Desain Baru (Opsional)</label>
                <input type="file" name="desain" id="desain" 
                    class="form-control @error('desain') is-invalid @enderror">
                @error('desain')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>

            <!-- Bentuk Desain -->
            <div class="form-group">
                <label for="bentuk_desain" class="font-weight-bold text-dark">Bentuk Desain</label>
                <input type="text" name="bentuk_desain" id="bentuk_desain" 
                       class="form-control @error('bentuk_desain') is-invalid @enderror" 
                       value="{{ $penjualan->bentuk_desain }}" required>
                @error('bentuk_desain')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>

            <!-- Ukuran -->
            <div class="form-group">
                <label for="ukuran" class="font-weight-bold text-dark">Ukuran (cm)</label>
                <input type="text" name="ukuran" id="ukuran" 
                       class="form-control @error('ukuran') is-invalid @enderror" 
                       value="{{ $penjualan->ukuran }}" required>
                @error('ukuran')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>

            <!-- Jumlah Pesanan -->
            <div class="form-group">
                <label for="jumlah_pesanan" class="font-weight-bold text-dark">Jumlah Pesanan (pcs)</label>
                <input type="number" name="jumlah_pesanan" id="jumlah_pesanan" 
                       class="form-control @error('jumlah_pesanan') is-invalid @enderror" 
                       value="{{ $penjualan->jumlah_pesanan }}" required>
                @error('jumlah_pesanan')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>

            <!-- Harga -->
            <div class="form-group">
                <label for="harga" class="font-weight-bold text-dark">Harga (Otomatis)</label>
                <input type="number" name="harga" id="harga" 
                       class="form-control @error('harga') is-invalid @enderror" 
                       value="{{ $penjualan->harga }}" readonly>
                @error('harga')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>

            <!-- Action Buttons -->
            <div class="form-group d-flex justify-content-end">
                <button type="submit" class="btn btn-success btn-lg px-5 py-2 btn-3d mr-2">Simpan Perubahan</button>
                <a href="{{ route('penjualan.penjualan') }}" class="btn btn-secondary btn-lg px-5 py-2 btn-3d">Batal</a>
            </div>
        </form>
    </div>
  </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function () {
        // Initialize calculation
        function calculatePrice() {
            const ukuran = $('#ukuran').val();
            const jumlahPesanan = $('#jumlah_pesanan').val();

            if (ukuran && jumlahPesanan) {
                const ukuranParts = ukuran.split('x');
                if (ukuranParts.length === 2 && !isNaN(ukuranParts[0]) && !isNaN(ukuranParts[1])) {
                    const panjang = parseFloat(ukuranParts[0]);
                    const lebar = parseFloat(ukuranParts[1]);
                    const luas = panjang * lebar;
                    const hargaPerCm2 = 50; // Harga per cm²
                    const totalHarga = luas * jumlahPesanan * hargaPerCm2;
                    $('#harga').val(totalHarga);
                } else {
                    $('#harga').val('');
                }
            } else {
                $('#harga').val('');
            }
        }

        // Recalculate when inputs change
        $('#ukuran, #jumlah_pesanan').on('input', calculatePrice);

        // Perform an initial calculation
        calculatePrice();
    });
</script>
@endsection