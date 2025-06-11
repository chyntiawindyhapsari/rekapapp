@extends('layouts.app') <!-- Pastikan Anda menggunakan layout utama -->

@section('content')
<div class="d-flex">
    <!-- Include Sidebar Navbar -->
    @include('layouts.navbar') <!-- Mengimpor file navbar.blade.php -->

    <!-- Main Content -->
    <div class="p-4" style="flex-grow: 1; margin-left: 250px;">
        <div class="container">
            <!-- Bagian Filter -->
            <div class="filter-section p-4 rounded mb-4" style="background-color: #d3d3d3;">
                <h4 class="mb-3">All Invoices</h4>
                <form class="row g-3 align-items-center" method="GET" action="{{ route('penjualan.penjualan') }}">
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

            <!-- Bagian Data Penjualan -->
            <div>
                <h2>Data Penjualan</h2>
                <a href="{{ route('penjualan.createjual') }}" class="btn btn-success mb-3">+ Tambah Data</a>
                <table class="table table-bordered table-striped" id="tabel-produk">
                    <thead>
                        <tr>
                            <th style="width:1%">No.</th>
                            <th style="width:5%">Nama Toko</th>
                            <th style="width:5%">Tanggal Pemesanan</th>
                            <th style="width:5%">Desain</th>
                            <th style="width:5%">Bentuk Desain</th>
                            <th style="width:5%">Ukuran (cm)</th>
                            <th style="width:5%">Jumlah Pesanan (pcs)</th>
                            <th style="width:5%">Harga</th>
                            <th style="width:5%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($dataPenjualan as $data)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $data->nama_toko }}</td>
                            <td>{{ $data->tanggal_penjualan }}</td>
                            <td>
                                <img src="{{ asset('images/' . $data->desain) }}" alt="Desain Produk" style="width: 100px; height: auto;">
                            </td>
                            <td>{{ $data->bentuk_desain }}</td>
                            <td>{{ $data->ukuran }}</td>
                            <td>{{ $data->jumlah_pesanan }}</td>
                            <td>{{ number_format($data->harga, 2) }}</td>
                            <td>
                                <a href="{{ route('penjualan.editjual', $data->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                <form action="{{ route('penjualan.destroy', $data->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this item?')">Delete</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
