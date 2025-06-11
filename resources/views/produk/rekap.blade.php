@extends('layouts.app')

@section('content')
<div class="d-flex">
    <!-- Include Sidebar Navbar -->
    @include('layouts.navbar')
    @include('layouts.card')

    <!-- Konten di sebelah kanan sidebar -->
    <div class="p-4" style="flex-grow: 1; margin-left: 200px; margin-top: 50px;">
        <div class="container">
            <!-- Bagian Filter -->
            <div class="filter-section p-4 rounded mb-4" style="background-color: #d3d3d3;">
                <h4 class="mb-3">All Invoices</h4>
                <form class="row g-3 align-items-center" method="GET" action="{{ route('produk.rekap') }}">
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

            <!-- Card showing total order and total price -->
            <div class="card mb-4">
                <div class="card-body">
                    <h5 class="card-title">Total Orders & Total Price</h5>
                    <div class="row">
                        <div class="col-md-6">
                            <p class="card-text">Total Orders: {{ $dataRekap->count() }}</p>
                        </div>
                        <div class="col-md-6">
                            <p class="card-text">Total Price: {{ number_format($dataRekap->sum('harga'), 2) }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <h2>Rekap Data Penjualan</h2>
            <a href="{{ route('rekap.export', request()->query()) }}" class="btn btn-primary">Excel</a>
            <a href="{{route('rekap.pdf.export', request()->query()) }}" class="btn btn-secondary pull-right" target="_blank">PDF</a>
            <a href="{{route('rekap.chart', request()->query())}}" class="btn btn-dark">Chart</a>
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Nama Toko</th>
                        <th>Alamat Toko</th>
                        <th>Tanggal Pesanan</th>
                        <th>Desain</th>
                        <th>Ukuran</th>
                        <th>Jumlah Pesanan</th>
                        <th>Harga</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($dataRekap as $data)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $data->nama_toko }}</td>
                        <td>{{ $data->alamat_toko }}</td>
                        <td>{{ $data->tanggal_penjualan }}</td>
                        <td>
                            <img src="{{ asset('images/' . $data->desain) }}" alt="Desain Produk" style="width: 100px; height: auto;">
                        </td>
                        <td>{{ $data->ukuran }}</td>
                        <td>{{ $data->jumlah_pesanan }}</td>
                        <td>{{ number_format($data->harga, 2) }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
