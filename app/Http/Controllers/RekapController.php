<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produk;
use App\Models\Penjualan;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\RekapExport;
use Barryvdh\DomPDF\Facade\Pdf;

class RekapController extends Controller
{
    public function index(){
        return view('produk.index');
    }

    public function index2(Request $request)
    {
        // Ambil parameter filter dari request
        $beginDate = $request->input('beginDate');
        $endDate = $request->input('endDate');
        $month = $request->input('month');
        $year = $request->input('year');
        
        // Mulai query untuk mendapatkan data penjualan
        $query = Penjualan::join('produk', 'penjualan.nama_toko', '=', 'produk.nama_toko')
            ->select(
                'produk.nama_toko',
                'penjualan.harga'
            );
        
        // Filter berdasarkan rentang tanggal
        if ($beginDate && $endDate) {
            $query->whereBetween('penjualan.tanggal_penjualan', [$beginDate, $endDate]);
        }
        
        // Filter berdasarkan bulan dan tahun
        if ($month && $year) {
            $query->whereMonth('penjualan.tanggal_penjualan', $month)
                  ->whereYear('penjualan.tanggal_penjualan', $year);
        } elseif ($month) {
            $query->whereMonth('penjualan.tanggal_penjualan', $month);
        } elseif ($year) {
            $query->whereYear('penjualan.tanggal_penjualan', $year);
        }
        
        // Ambil hasil query
        $dataRekap = $query->get();
        
        // Menghitung total harga penjualan per toko
        $salesData = [];
        foreach ($dataRekap as $data) {
            if (!isset($salesData[$data->nama_toko])) {
                $salesData[$data->nama_toko] = 0;
            }
            // Total harga = jumlah_pesanan * harga
            $salesData[$data->nama_toko] += $data->harga;
        }
        
        arsort($salesData);
        
        // Kirim data ke view produk.index2
        return view('produk.index', compact('salesData'));
    }

    public function pdfExport(Request $request)
    {
        // Ambil parameter filter dari request
        $beginDate = $request->input('beginDate');
        $endDate = $request->input('endDate');
        $month = $request->input('month');
        $year = $request->input('year');
    
        // Mulai query untuk mendapatkan data penjualan
        $query = Penjualan::join('produk', 'penjualan.nama_toko', '=', 'produk.nama_toko')
            ->select(
                'produk.nama_toko',
                'produk.alamat_toko',
                'penjualan.tanggal_penjualan',
                'penjualan.desain',
                'penjualan.ukuran',
                'penjualan.jumlah_pesanan',
                'penjualan.harga'
            );
    
        // Filter berdasarkan rentang tanggal
        if ($beginDate && $endDate) {
            $query->whereBetween('penjualan.tanggal_penjualan', [$beginDate, $endDate]);
        }
    
        // Filter berdasarkan bulan dan tahun
        if ($month && $year) {
            $query->whereMonth('penjualan.tanggal_penjualan', $month)
                  ->whereYear('penjualan.tanggal_penjualan', $year);
        } elseif ($month) {
            $query->whereMonth('penjualan.tanggal_penjualan', $month);
        } elseif ($year) {
            $query->whereYear('penjualan.tanggal_penjualan', $year);
        }
    
        // Ambil hasil query
        $dataRekap = $query->get();
    
        // Hitung total penjualan berdasarkan harga saja
        $totalPenjualan = $query->sum('penjualan.harga');  // Menghitung hanya berdasarkan harga
    
        // Update URL gambar dengan path absolut menggunakan public_path
        foreach ($dataRekap as $data) {
            // Gunakan URL absolut untuk gambar
            $data->desain = public_path('images/' . $data->desain);
        }
    
        // Render PDF dengan view produk.pdf
        $pdf = Pdf::loadView('produk.pdf', compact('dataRekap', 'totalPenjualan'));
        
        // Menampilkan PDF di browser
        return $pdf->stream('rekap_penjualan.pdf');
    }  

    public function rekap(Request $request)
    {
        // Ambil parameter filter dari request
        $beginDate = $request->input('beginDate');
        $endDate = $request->input('endDate');
        $month = $request->input('month');
        $year = $request->input('year');
        
        // Mulai query untuk mendapatkan data penjualan
        $query = Penjualan::join('produk', 'penjualan.nama_toko', '=', 'produk.nama_toko')
            ->select(
                'produk.nama_toko',
                'produk.alamat_toko',
                'penjualan.tanggal_penjualan',
                'penjualan.desain',
                'penjualan.ukuran',
                'penjualan.jumlah_pesanan',
                'penjualan.harga'
            );
    
        // Filter berdasarkan rentang tanggal
        if ($beginDate && $endDate) {
            $query->whereBetween('penjualan.tanggal_penjualan', [$beginDate, $endDate]);
        }
    
        // Filter berdasarkan bulan dan tahun
        if ($month && $year) {
            $query->whereMonth('penjualan.tanggal_penjualan', $month)
                    ->whereYear('penjualan.tanggal_penjualan', $year);
        } elseif ($month) {
            $query->whereMonth('penjualan.tanggal_penjualan', $month);
        } elseif ($year) {
            $query->whereYear('penjualan.tanggal_penjualan', $year);
        }
    
        // Ambil hasil query untuk penjualan yang difilter
        $dataRekap = $query->get();
    
        // Hitung total penjualan berdasarkan harga saja
        $totalPenjualan = $query->sum('penjualan.harga');  // Menghitung hanya berdasarkan harga
        
        // Hitung total pesanan berdasarkan jumlah pesanan yang difilter
        $totalPesanan = $query->sum('penjualan.jumlah_pesanan'); // Menghitung total berdasarkan jumlah pesanan
        
        // Kirim data ke view rekap
        return view('produk.rekap', compact('dataRekap', 'totalPenjualan', 'totalPesanan'));
    }
    

    public function rekapExport(Request $request)
    {
        // Ambil parameter filter dari request
        $beginDate = $request->input('beginDate');
        $endDate = $request->input('endDate');
        $month = $request->input('month');
        $year = $request->input('year');

        // Lakukan ekspor ke Excel
        return Excel::download(new RekapExport($beginDate, $endDate, $month, $year), 'rekap_penjualan.xlsx');
    }

    public function chart(Request $request)
    {
        // Ambil parameter filter dari request
        $beginDate = $request->input('beginDate');
        $endDate = $request->input('endDate');
        $month = $request->input('month');
        $year = $request->input('year');
    
        // Mulai query untuk mendapatkan data penjualan
        $query = Penjualan::join('produk', 'penjualan.nama_toko', '=', 'produk.nama_toko')
            ->select(
                'penjualan.tanggal_penjualan',
                'penjualan.jumlah_pesanan',
                'penjualan.nama_toko'
            );
    
        // Filter berdasarkan rentang tanggal
        if ($beginDate && $endDate) {
            $query->whereBetween('penjualan.tanggal_penjualan', [$beginDate, $endDate]);
        }
    
        // Filter berdasarkan bulan dan tahun
        if ($month && $year) {
            $query->whereMonth('penjualan.tanggal_penjualan', $month)
                  ->whereYear('penjualan.tanggal_penjualan', $year);
        } elseif ($month) {
            $query->whereMonth('penjualan.tanggal_penjualan', $month);
        } elseif ($year) {
            $query->whereYear('penjualan.tanggal_penjualan', $year);
        }
    
        // Ambil hasil query
        $dataRekap = $query->get();
    
        // Kirim data ke view chart
        return view('produk.chart', compact('dataRekap'));
    }

    // Optional: Handle other requests or actions as needed, such as resetting filters or managing additional logic
}