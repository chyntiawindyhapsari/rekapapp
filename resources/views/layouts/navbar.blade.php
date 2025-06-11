<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Nendra Print Sidebar</title>
    <!-- Link to Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Link to Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/css/navbar.css">
    <style>
        .navbar {
            background-image: url('images/navbar.jpeg');
        }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg flex-column p-5">
    <a class="navbar-brand" href="#">
        <span>NENDRA PRINT</span>
    </a>
    <img src="{{ asset('images/logo.png') }}" alt="Logo Nendra Print" class="logo">

    <!-- Button for small devices -->
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <!-- Menu -->
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav flex-column w-100">
            <li class="nav-item">
                <a class="nav-link" href="{{ route('rekap.index') }}">Beranda</a>
            </li>

            @auth
            @if(Auth::user()->usertype == 'owner')
                <!-- Lainnya untuk semua pengguna -->
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('produk.rekap') }}" aria-disabled="true">Laporan Penjualan</a>
                </li>
                @elseif(Auth::user()->usertype == 'admin')
                    <!-- Menu untuk Owner -->
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('produk.produk') }}">Data Toko</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('penjualan.penjualan') }}">Data Penjualan</a>
                    </li>
                @endif
            @endauth

            @auth
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        {{ Auth::user()->name }}
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li>
                            <a class="dropdown-item" href="#">Profile</a>
                        </li>
                        <li>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="dropdown-item">Logout</button>
                            </form>
                        </li>
                    </ul>
                </li>
            @else
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('login') }}">Login</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('register') }}">Register</a>
                </li>
            @endauth
        </ul>
    </div>
</nav>

<!-- Link to Bootstrap JS and dependencies -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
