@extends('layouts.app')

@section('content')
<div class="d-flex">
  <!-- Include Sidebar Navbar -->
  @include('layouts.navbar')

  <!-- Main Content -->
  <div class="p-4" style="flex-grow: 1; margin-left: 250px;">
    <div class="container">
        <h2 class="text-left text-dark mb-4"><b>Tambah Data Penjualan</b></h2>

        <!-- Form for Adding Sales Data -->
        <form action="{{ route('penjualan.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <!-- Nama Toko -->
            <div class="form-group">
                <label for="nama_toko">Nama Toko</label>
                <input type="text" id="nama_toko" name="nama_toko" class="form-control" placeholder="Cari nama toko..." autocomplete="off">
                <ul id="nama_toko_list" class="list-group mt-2" style="display: none;"></ul>
            </div>
            <!-- Tanggal Penjualan -->
            <div class="form-group">
                <label for="tanggal_penjualan" class="font-weight-bold text-dark">Tanggal Penjualan</label>
                <input type="date" name="tanggal_penjualan" id="tanggal_penjualan" 
                       class="form-control @error('tanggal_penjualan') is-invalid @enderror" 
                       value="{{ old('tanggal_penjualan') }}" required>
                @error('tanggal_penjualan')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>

            <!-- Desain -->
            <div class="form-group">
                <label for="desain" class="font-weight-bold text-dark">Desain</label>
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
                       value="{{ old('bentuk_desain') }}" placeholder="Masukkan bentuk desain" required>
                @error('bentuk_desain')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>

            <!-- Ukuran -->
            <div class="form-group">
                <label for="ukuran" class="font-weight-bold text-dark">Ukuran (cm)</label>
                <input type="text" name="ukuran" id="ukuran" 
                       class="form-control @error('ukuran') is-invalid @enderror" 
                       value="{{ old('ukuran') }}" placeholder="Masukkan ukuran (contoh: 10x15)" required>
                @error('ukuran')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>

            <!-- Jumlah Pesanan -->
            <div class="form-group">
                <label for="jumlah_pesanan" class="font-weight-bold text-dark">Jumlah Pesanan (pcs)</label>
                <input type="number" name="jumlah_pesanan" id="jumlah_pesanan" 
                       class="form-control @error('jumlah_pesanan') is-invalid @enderror" 
                       value="{{ old('jumlah_pesanan', 1) }}" required>
                @error('jumlah_pesanan')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>

            <!-- Harga -->
            <div class="form-group">
                <label for="harga" class="font-weight-bold text-dark">Harga (Otomatis)</label>
                <input type="number" name="harga" id="harga" 
                    class="form-control @error('harga') is-invalid @enderror" 
                    value="{{ old('harga') }}" readonly>
                @error('harga')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>

            <!-- Action Buttons -->
            <div class="form-group d-flex justify-content-end">
                <button type="submit" class="btn btn-success btn-lg px-5 py-2 btn-3d mr-2">Tambah Data</button>
                <a href="{{ route('penjualan.penjualan') }}" class="btn btn-secondary btn-lg px-5 py-2 btn-3d">Batal</a>
            </div>
        </form>
    </div>
  </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function () {
        // Trigger the AJAX request immediately when the input field is focused
        $('#nama_toko').on('focus', function () {
            const query = $(this).val();
            if (query.length <= 2) {
                $.ajax({
                    url: "{{ route('search.toko') }}",
                    type: "GET",
                    data: { search: query },
                    success: function (response) {
                        let list = '';
                        if (response.length > 0) {
                            response.forEach(function (toko) {
                                list += `<li class="list-group-item" style="cursor: pointer;">${toko.nama_toko}</li>`;
                            });
                            $('#nama_toko_list').html(list).show();
                        } else {
                            $('#nama_toko_list').hide();
                        }
                    }
                });
            }
        });

        // Selecting a store name from the list and setting it to the input field
        $(document).on('click', '#nama_toko_list li', function () {
            $('#nama_toko').val($(this).text());
            $('#nama_toko_list').hide();
        });

        // Hide the list when the input field loses focus
        $('#nama_toko').on('blur', function () {
            setTimeout(function () {
                $('#nama_toko_list').hide();
            }, 200);
        });
    });

    $(document).ready(function () {
        function calculatePrice() {
            const ukuran = $('#ukuran').val();
            const jumlahPesanan = $('#jumlah_pesanan').val();

            if (ukuran && jumlahPesanan) {
                const ukuranParts = ukuran.split('x');
                if (ukuranParts.length === 2 && !isNaN(ukuranParts[0]) && !isNaN(ukuranParts[1])) {
                    const panjang = parseFloat(ukuranParts[0]);
                    const lebar = parseFloat(ukuranParts[1]);
                    const luas = panjang * lebar;
                    const hargaPerCm2 = 50; // Ubah sesuai kebutuhan
                    const totalHarga = luas * jumlahPesanan * hargaPerCm2;
                    $('#harga').val(totalHarga);
                } else {
                    $('#harga').val('');
                }
            } else {
                $('#harga').val('');
            }
        }

        $('#ukuran, #jumlah_pesanan').on('input', calculatePrice);
    });
</script>
@endsection
