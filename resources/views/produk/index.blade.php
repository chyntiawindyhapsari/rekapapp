@extends('layouts.app')

@section('content')
<div class="d-flex">
    <!-- Include Sidebar Navbar -->
    @include('layouts.navbar')

    <!-- Konten utama di sebelah kanan sidebar -->
    <link rel="stylesheet" href="/css/index.css">
    <div class="p-4" style="flex-grow: 1; margin-left: 250px;">
        <div class="container">
            <!-- Bagian Filter -->
            <div class="filter-section p-4 rounded mb-4" style="background-color: #d3d3d3;">
                <h4 class="mb-3">All Invoices</h4>
                <form class="row g-3 align-items-center" method="GET" action="{{ route('rekap.index') }}">
                    <!-- Filter Rentang Tanggal -->
                    <div class="col-md-3">
                        <label for="beginDate" class="form-label">Begin Date</label>
                        <input type="date" class="form-control" id="beginDate" name="beginDate" value="{{ request('beginDate') }}">
                    </div>
                    <div class="col-md-3">
                        <label for="endDate" class="form-label">End Date</label>
                        <input type="date" class="form-control" id="endDate" name="endDate" value="{{ request('endDate') }}">
                    </div>

                    <!-- Filter Rentang Bulan -->
                    <div class="col-md-3">
                        <label for="month" class="form-label">Select Month</label>
                        <select class="form-control" id="month" name="month">
                            <option value="">Any Month</option>
                            <option value="01" {{ request('month') == '01' ? 'selected' : '' }}>January</option>
                            <option value="02" {{ request('month') == '02' ? 'selected' : '' }}>February</option>
                            <option value="03" {{ request('month') == '03' ? 'selected' : '' }}>March</option>
                            <option value="04" {{ request('month') == '04' ? 'selected' : '' }}>April</option>
                            <option value="05" {{ request('month') == '05' ? 'selected' : '' }}>May</option>
                            <option value="06" {{ request('month') == '06' ? 'selected' : '' }}>June</option>
                            <option value="07" {{ request('month') == '07' ? 'selected' : '' }}>July</option>
                            <option value="08" {{ request('month') == '08' ? 'selected' : '' }}>August</option>
                            <option value="09" {{ request('month') == '09' ? 'selected' : '' }}>September</option>
                            <option value="10" {{ request('month') == '10' ? 'selected' : '' }}>October</option>
                            <option value="11" {{ request('month') == '11' ? 'selected' : '' }}>November</option>
                            <option value="12" {{ request('month') == '12' ? 'selected' : '' }}>December</option>
                        </select>
                    </div>

                    <!-- Filter Tahun -->
                    <div class="col-md-2">
                        <label for="year" class="form-label">Year</label>
                        <input type="number" class="form-control" id="year" name="year" value="{{ request('year') }}" placeholder="Year">
                    </div>

                    <div class="col-md-2">
                        <button type="submit" class="btn btn-primary w-100 mt-4">Filter</button>
                    </div>
                </form>
            </div>

            <!-- Bagian Chart -->
            <div class="chart-container p-4 rounded" style="background-color: #fff; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">
                <h2 class="text-center mb-4">Rekap Data Penjualan</h2>
                <canvas id="salesChart"></canvas>
            </div>
        </div>
    </div>
</div>

<!-- Script untuk Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Ambil data dari PHP
        const salesData = @json($salesData);
        
        // Menyiapkan data untuk chart
        const labels = Object.keys(salesData);
        const dataValues = Object.values(salesData);

        const data = {
            labels: labels,
            datasets: [{
                label: 'Jumlah Penjualan',
                data: dataValues, // Menggunakan data penjualan dari controller
                backgroundColor: [
                    '#007bff',
                    '#28a745',
                    '#ffc107',
                    '#dc3545'
                ],
                borderColor: [
                    '#0056b3',
                    '#1e7e34',
                    '#d39e00',
                    '#bd2130'
                ],
                borderWidth: 1
            }]
        };

        // Konfigurasi chart
        const config = {
            type: 'bar',
            data: data,
            options: {
                indexAxis: 'y', // Membuat chart menjadi horizontal
                responsive: true,
                plugins: {
                    legend: {
                        display: true,
                        position: 'top'
                    }
                },
                scales: {
                    x: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'Jumlah Penjualan'
                        }
                    },
                    y: {
                        title: {
                            display: true,
                            text: 'Nama Toko'
                        }
                    }
                }
            }
        };

        // Inisialisasi Chart.js
        const ctx = document.getElementById('salesChart').getContext('2d');
        new Chart(ctx, config);
    });
</script>
@endsection