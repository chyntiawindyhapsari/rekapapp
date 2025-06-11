<!-- resources/views/produk/pdf.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rekap Penjualan</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        h1 {
            text-align: center;
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            padding: 8px;
            text-align: left;
            border: 1px solid #ddd;
        }
        th {
            background-color: #f2f2f2;
        }
        img {
            max-width: 100px;
            max-height: 100px;
        }
        .footer {
            text-align: center;
            margin-top: 20px;
            font-size: 12px;
        }
    </style>
</head>
<body>
    <h1>Rekap Data Penjualan</h1>
    <table>
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
                    <!-- Menampilkan gambar menggunakan path absolut -->
                    <img src="{{ 'file://' . $data->desain }}" alt="Desain Produk">
                </td>
                <td>{{ $data->ukuran }}</td>
                <td>{{ $data->jumlah_pesanan }}</td>
                <td>{{ number_format($data->harga, 2) }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <table>
        <tfoot>
            <tr class="total-row">
                <td colspan="7" style="text-align: right;">Total Penjualan Keseluruhan:</td>
                <td>{{ number_format($totalPenjualan, 2) }}</td>
            </tr>
        </tfoot>
    </table>

    <div class="footer">
        <p>&copy; {{ now()->year }} Rekap Penjualan</p>
    </div>
</body>
</html>
