<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produk;
use App\Models\Penjualan;

class PenjualanController extends Controller
{
    public function index(Request $request)
    {
        // Ambil parameter filter dari request
        $beginDate = $request->input('beginDate');
        $endDate = $request->input('endDate');
        $month = $request->input('month');
        $year = $request->input('year');
    
        // Query untuk mengambil data penjualan dengan harga dihitung
        $query = Penjualan::query();
    
        // Filter berdasarkan rentang tanggal
        if ($beginDate && $endDate) {
            $query->whereBetween('tanggal_penjualan', [$beginDate, $endDate]);
        }
    
        // Filter berdasarkan bulan dan tahun
        if ($month && $year) {
            $query->whereMonth('tanggal_penjualan', $month)
                  ->whereYear('tanggal_penjualan', $year);
        } elseif ($month) {
            $query->whereMonth('tanggal_penjualan', $month);
        } elseif ($year) {
            $query->whereYear('tanggal_penjualan', $year);
        }
    
        // Perkalian kolom ukuran * jumlah_pesanan sebagai harga
        $data = $query->selectRaw('*, (CAST(ukuran AS DECIMAL(10,2)) * jumlah_pesanan) AS harga_total')->get();
    
        // Kirim data ke view
        return view('penjualan.penjualan', ['dataPenjualan' => $data]);
    }    

    // Menampilkan form tambah penjualan
    public function createjual()
    {
        return view('penjualan.createjual');
    }

    // Menampilkan form edit penjualan
    public function editjual($id)
    {
        $penjualan = Penjualan::findOrFail($id);

        return view('penjualan.editjual', compact('penjualan'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_toko' => 'required|string|max:100',
            'tanggal_penjualan' => 'required|date',
            'jumlah_pesanan' => 'required|integer|min:1',
            'desain' => 'nullable|file|mimes:jpg,jpeg,png|max:2048', // Maksimal 2MB
            'bentuk_desain' => 'required|string|max:255',
            'ukuran' => 'required|string|max:255',
        ]);
    
        // Hitung harga berdasarkan ukuran dan jumlah pesanan
        $ukuran = $request->ukuran;
        $jumlahPesanan = $request->jumlah_pesanan;
    
        // Konversi ukuran (misalnya "10x15" menjadi 10 * 15)
        $ukuranParts = explode('x', strtolower($ukuran));
        if (count($ukuranParts) === 2 && is_numeric($ukuranParts[0]) && is_numeric($ukuranParts[1])) {
            $luas = $ukuranParts[0] * $ukuranParts[1];
        } else {
            return back()->withErrors(['ukuran' => 'Ukuran harus dalam format panjangxlebar, contoh: 10x15'])->withInput();
        }
    
        // Harga dihitung berdasarkan luas ukuran dan jumlah pesanan (misalnya: 100 per cm²)
        $hargaPerCm2 = 50; // Ubah sesuai kebutuhan
        $harga = $luas * $jumlahPesanan * $hargaPerCm2;
    
        // Simpan data penjualan
        $penjualan = new Penjualan();
        $penjualan->nama_toko = $request->nama_toko;
        $penjualan->tanggal_penjualan = $request->tanggal_penjualan;
        $penjualan->jumlah_pesanan = $jumlahPesanan;
        $penjualan->harga = $harga;
    
        if ($request->hasFile('desain')) {
            $file = $request->file('desain');
            $fileName = time() . '_' . $file->getClientOriginalName();
            
            // Simpan ke storage/app/public/images
            $file->storeAs('images', $fileName, 'public');
            
            // Simpan path-nya di database
            $penjualan->desain = $fileName;
        }

    
        $penjualan->bentuk_desain = $request->bentuk_desain;
        $penjualan->ukuran = $ukuran;
        $penjualan->save();
    
        return redirect()->route('penjualan.penjualan')->with('success', 'Data penjualan berhasil ditambahkan.');
    }
    

    // Memperbarui data penjualan
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_toko' => 'required|string|max:100',
            'tanggal_penjualan' => 'required|date',
            'jumlah_pesanan' => 'required|integer|min:1',
            'harga' => 'required|numeric|min:0',
            'desain' => 'nullable|file|mimes:jpg,jpeg,png|max:2048',
            'bentuk_desain' => 'required|string|max:255',
            'ukuran' => 'required|string|max:255',
        ]);

        $penjualan = Penjualan::findOrFail($id);
        $penjualan->nama_toko = $request->nama_toko;
        $penjualan->tanggal_penjualan = $request->tanggal_penjualan;
        $penjualan->jumlah_pesanan = $request->jumlah_pesanan;

        // Hitung harga berdasarkan ukuran dan jumlah pesanan
        $ukuran = $request->ukuran;
        $jumlahPesanan = $request->jumlah_pesanan;
    
        // Konversi ukuran (misalnya "10x15" menjadi 10 * 15)
        $ukuranParts = explode('x', strtolower($ukuran));
        if (count($ukuranParts) === 2 && is_numeric($ukuranParts[0]) && is_numeric($ukuranParts[1])) {
            $luas = $ukuranParts[0] * $ukuranParts[1];
        } else {
            return back()->withErrors(['ukuran' => 'Ukuran harus dalam format panjangxlebar, contoh: 10x15'])->withInput();
        }
    
        // Harga dihitung berdasarkan luas ukuran dan jumlah pesanan (misalnya: 100 per cm²)
        $hargaPerCm2 = 50; // Ubah sesuai kebutuhan
        $harga = $luas * $jumlahPesanan * $hargaPerCm2;

        // Update harga
        $penjualan->harga = $harga;

        if ($request->hasFile('desain')) {
            $file = $request->file('desain');
            $fileName = time() . '_' . $file->getClientOriginalName();

            // Pastikan direktori sudah ada
            $destinationPath = public_path('images');
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }

            // Pindahkan file
            $file->move($destinationPath, $fileName);

            // Simpan nama file ke database
            $penjualan->desain = $fileName;
        }

        $penjualan->bentuk_desain = $request->bentuk_desain;
        $penjualan->ukuran = $request->ukuran;

        $penjualan->save();

        return redirect()->route('penjualan.penjualan')->with('success', 'Data penjualan berhasil diperbarui.');
    }

    // Menghapus data penjualan
    public function destroy($id)
    {
        $penjualan = Penjualan::findOrFail($id);

        if ($penjualan->desain && file_exists(public_path('images/' . $penjualan->desain))) {
            unlink(public_path('images/' . $penjualan->desain));
        }

        $penjualan->delete();

        return redirect()->route('penjualan.penjualan')->with('success', 'Data penjualan berhasil dihapus.');
    }

// In your PenjualanController.php

    public function searchToko(Request $request)
    {
        // Get the search query
        $query = $request->input('search');

        // Fetch matching toko names from the 'produk' table
        $tokoList = Produk::where('nama_toko', 'like', '%' . $query . '%')
                        ->select('nama_toko')
                        ->distinct()
                        ->get();

        // Return the toko list as a JSON response
        return response()->json($tokoList);
    }

}
