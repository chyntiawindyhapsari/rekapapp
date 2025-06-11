@extends('layouts.app')

@section('content')
<div class="d-flex">
  <!-- Include Sidebar Navbar -->
  @include('layouts.navbar')

  <!-- Konten di sebelah kanan sidebar -->
  <div class="p-4" style="flex-grow: 1; margin-left: 250px;">
    <div class="container">
        <h2 class="text-left text-dark mb-4"><b>Tambah Data Penjualan</b></h2>

        <!-- Form untuk menambahkan data penjualan -->
        <form action="{{ route('penjualan.store') }}" method="POST">
            @csrf
                <div class="form-group position-relative">
                    <label for="nama_toko" class="font-weight-bold text-dark">Nama Toko</label>
                    <input type="text" name="nama_toko" id="nama_toko" 
                        class="form-control @error('nama_toko') is-invalid @enderror" 
                        value="{{ old('nama_toko') }}" placeholder="Cari nama toko..." 
                        required autocomplete="off">
                    @error('nama_toko')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                    <!-- Dropdown untuk hasil pencarian -->
                    <div id="namaTokoDropdown" class="dropdown" style="display: none;">
                        <input type="text" id="dropdownSearch" class="form-control" placeholder="Search..." autocomplete="off">
                        <ul id="namaTokoList" class="list-group">
                        </ul>
                    </div>
                </div>
                <div class="form-group">
                    <label for="tanggal_penjualan" class="font-weight-bold text-dark">Tanggal Penjualan</label>
                    <input type="date" name="tanggal_penjualan" id="tanggal_penjualan" class="form-control @error('tanggal_penjualan') is-invalid @enderror" value="{{ old('tanggal_penjualan') }}" required>
                    @error('tanggal_penjualan')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="harga" class="font-weight-bold text-dark">Harga</label>
                    <input type="number" name="harga" id="harga" class="form-control @error('harga') is-invalid @enderror" value="{{ old('harga') }}" required>
                    @error('harga')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="jumlah_pesanan">Jumlah Pesanan</label>
                    <input type="number" name="jumlah_pesanan" id="jumlah_pesanan" class="form-control" value="0">
                </div>
                
                <!-- Tombol Posisi Pojok Kanan -->
                <div class="form-group d-flex justify-content-end">
                    <button type="submit" class="btn btn-success btn-lg px-5 py-2 btn-3d mr-2">Tambah Data</button>
                    <a href="{{ route('penjualan.penjualan') }}" class="btn btn-secondary btn-lg px-5 py-2 btn-3d">Batal</a>
                </div>
            </div>
        </form>
    </div>
  </div>
</div>
@endsection

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const namaTokoInput = document.getElementById("nama_toko");
        const jumlahPesananInput = document.getElementById("jumlah_pesanan");
        const namaTokoList = document.getElementById("namaTokoList");
        const dropdownSearch = document.getElementById("dropdownSearch");
        const namaTokoDropdown = document.getElementById("namaTokoDropdown");

        // Function to fetch and display store names
        function fetchStoreNames(query = '') {
            fetch(`/penjualan/search-toko?q=${query}`)
                .then(response => response.json())
                .then(data => {
                    namaTokoList.innerHTML = "";
                    if (data.length > 0) {
                        namaTokoDropdown.style.display = "block";
                        data.forEach(item => {
                            const listItem = document.createElement("li");
                            listItem.classList.add("list-group-item");
                            listItem.textContent = item.nama_toko;
                            listItem.style.cursor = "pointer";
                            listItem.addEventListener("click", () => {
                                namaTokoInput.value = item.nama_toko;

                                // Fetch jumlah pesanan berdasarkan nama toko yang dipilih
                                fetch(`/penjualan/jumlah-pesanan?nama_toko=${item.nama_toko}`)
                                    .then(response => response.json())
                                    .then(data => {
                                        if (data.jumlah_pesanan !== null) {
                                            jumlahPesananInput.value = data.jumlah_pesanan; // Set jumlah pesanan dari database
                                        } else {
                                            jumlahPesananInput.value = 0; // Jika tidak ada, set ke 0
                                        }
                                        jumlahPesananInput.setAttribute("readonly", true); // Make it readonly
                                    })
                                    .catch(error => console.error(error));

                                namaTokoDropdown.style.display = "none";
                            });
                            namaTokoList.appendChild(listItem);
                        });
                    } else {
                        namaTokoDropdown.style.display = "none";
                    }
                })
                .catch(error => console.error(error));
        }

        // Fetch all store names when the input field is focused
        namaTokoInput.addEventListener("focus", function () {
            fetchStoreNames();
        });

        // Filter dropdown items based on input
        dropdownSearch.addEventListener("input", function () {
            const query = dropdownSearch.value;
            fetchStoreNames(query);
        });

        // Existing input event listener for searching store names
        namaTokoInput.addEventListener("input", function () {
            const query = namaTokoInput.value;

            if (query.length > 1) {
                fetchStoreNames(query);
            } else {
                namaTokoDropdown.style.display = "none";
            }
        });

        // Close dropdown if clicking outside
        document.addEventListener("click", function (e) {
            if (!namaTokoInput.contains(e.target) && !namaTokoDropdown.contains(e.target)) {
                namaTokoDropdown.style.display = "none";
            }
        });
    });
</script>

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

        #namaTokoDropdown {
            position: absolute;
            background-color: #fff;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            z-index: 1000;
            width: 100%;
        }

        #dropdownSearch {
            border: none;
            border-bottom: 1px solid #ccc;
            border-radius: 0;
            padding: 8px;
            margin-bottom: 5px;
        }

        #dropdownSearch:focus {
            outline: none;
            border-bottom: 1px solid #007bff;
        }

        .list-group-item {
            padding: 10px;
            cursor: pointer;
        }

        .list-group-item:hover {
            background-color: #f8f9fa;
        }

        .list-group {
            max-height: 200px;
            overflow-y: auto;
            margin: 0;
            padding: 0;
        }
    </style>
@endsection
