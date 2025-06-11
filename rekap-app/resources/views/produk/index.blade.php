@extends('layouts.app') <!-- Pastikan Anda menggunakan layout utama -->

@section('content')
<div class="d-flex">
    <!-- Include Sidebar Navbar -->
    @include('layouts.navbar') <!-- Pastikan file navbar.blade.php ada di dalam layouts -->

    <!-- Konten utama di sebelah kanan sidebar -->
    <link rel="stylesheet" href="/css/index.css">
    <div class="p-4" style="flex-grow: 1; margin-left: 250px;">
        <div class="container">
            <!-- Bagian Filter -->
            <div class="filter-section p-4 rounded mb-4" style="background-color: #d3d3d3;">
                <h4 class="mb-3">All Invoices</h4>
                <form class="row g-3 align-items-center">
                    <div class="col-md-3">
                        <label for="beginDate" class="form-label">Begin Date</label>
                        <input type="date" class="form-control" id="beginDate">
                    </div>
                    <div class="col-md-3">
                        <label for="endDate" class="form-label">End Date</label>
                        <input type="date" class="form-control" id="endDate">
                    </div>
                    <div class="col-md-2">
                        <label for="status" class="form-label">Status</label>
                        <select id="status" class="form-select">
                            <option selected>Any</option>
                            <option>Paid</option>
                            <option>Draft</option>
                            <option>Partial Payment</option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <label for="client" class="form-label">Client</label>
                        <select id="client" class="form-select">
                            <option selected>Any</option>
                            <option>Client 1</option>
                            <option>Client 2</option>
                        </select>
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
        // Data untuk chart
        const labels = ['Toko A', 'Toko B', 'Toko C', 'Toko D'];
        const data = {
            labels: labels,
            datasets: [{
                label: 'Persentase Penjualan',
                data: [70, 50, 30, 90], // Persentase untuk setiap toko
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
                        max: 100, // Batas maksimum 100% untuk persentase
                        title: {
                            display: true,
                            text: 'Persentase (%)'
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
