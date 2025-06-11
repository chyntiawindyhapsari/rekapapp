@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Rekap Penjualan</h2>

    <canvas id="salesChart" width="400" height="200"></canvas>
</div>

<script>
    const ctx = document.getElementById('salesChart').getContext('2d');

    // Data penjualan yang akan ditampilkan dalam grafik
    const labels = @json($dataRekap->pluck('nama_toko'));

    const data = {
        labels: labels,
        datasets: [{
            label: 'Jumlah Pesanan',
            data: @json($dataRekap->pluck('jumlah_pesanan')),
            backgroundColor: 'rgba(75, 192, 192, 0.2)',
            borderColor: 'rgba(75, 192, 192, 1)',
            borderWidth: 1
        }]
    };

    const config = {
        type: 'bar', // Jenis grafik: 'line', 'bar', 'pie', dll.
        data: data,
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    };

    const salesChart = new Chart(ctx, config);
</script>
@endsection