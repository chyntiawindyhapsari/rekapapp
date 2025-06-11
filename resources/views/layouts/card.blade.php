<link rel="stylesheet" href="/css/card.css">
<style>
    .card {
        background-image: url('images/card.jpeg');
    }
    </style>
<div class="container mt-5">
    <!-- Section untuk Cards -->
    <div class="row mb-1">
        <div class="col-sm-4 mb-2" style="margin-left: 225px;">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Jumlah Produk</h5>
                    <h6 class="card-text">{{ $totalPesanan }}</h6>
                </div>
            </div>
        </div>
        <div class="col-sm-4 mb-2">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Total Penjualan</h5>
                    <h6 class="card-text">Rp {{ number_format($totalPenjualan, 2, ',', '.') }}</h6> <!-- Menampilkan total penjualan -->
                </div>
            </div>
        </div>