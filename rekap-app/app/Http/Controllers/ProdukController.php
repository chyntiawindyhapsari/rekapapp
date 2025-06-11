<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\Produk;

class ProdukController extends Controller
{
    public function index(){
        return view('produk.index');
    }//

    public function produk(){
        $data = Produk::all();
        $totalPesanan = Produk::sum('jumlah_pesanan');
    
        return view('produk.produk', [
            'dataProduk' => $data,
            'totalPesanan' => $totalPesanan
        ]);
    }

    public function createproduk(){
        return view('produk.createproduk');
    }

    public function editproduk($id)
    {
        // Mengambil data produk berdasarkan ID
        $data = Produk::findOrFail($id);

        // Mengirim data produk ke view editproduk
        return view('produk.editproduk', compact('data'));
    }

    public function update(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'nama_toko' => 'required|string|max:255',
            'alamat_toko' => 'required|string|max:1000',
            'desain' => 'nullable|file|mimes:jpg,jpeg,png|max:2048', // Maksimal 2MB, nullable agar tidak wajib
            'bentuk_desain' => 'required|string|max:255',
            'ukuran' => 'required|string|max:255',
            'jumlah_pesanan' => 'required|integer|min:1',
        ]);
    
        // Mencari produk berdasarkan ID
        $produk = Produk::findOrFail($id);
    
        // Mengupdate data produk kecuali file desain
        $produk->update($request->except('desain'));
    
        // Menyimpan file desain jika ada
        if ($request->hasFile('desain')) {
            // Hapus file desain lama jika ada
            if ($produk->desain) {
                $oldFilePath = public_path('images/' . $produk->desain);
                if (file_exists($oldFilePath)) {
                    unlink($oldFilePath); // Menghapus file lama
                }
            }
    
            // Simpan file desain yang baru
            $file = $request->file('desain');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('images'), $filename);
            $produk->desain = $filename; // Simpan nama file baru ke database
        }
    
        // Simpan perubahan
        $produk->save();
    
        // Redirect dengan pesan sukses
        return redirect()->route('produk.produk')->with('success', 'Data Produk Berhasil Diperbarui');
    }
    
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'nama_toko' => 'required|string|max:255',
            'alamat_toko' => 'required|string|max:1000',
            'desain' => 'required|file|mimes:jpg,jpeg,png|max:2048', // Maksimal 2MB
            'bentuk_desain' => 'required|string|max:255',
            'ukuran' => 'required|string|max:255',
            'jumlah_pesanan' => 'required|integer|min:1',
        ]);
    
        // Membuat data baru
        $produk = Produk::create($request->except('desain')); // Buat data kecuali file
    
        // Menyimpan file desain jika ada
        if ($request->hasFile('desain')) {
            $file = $request->file('desain');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            // Menyimpan file ke folder public/images
            $file->move(public_path('images'), $filename);
            $produk->desain = $filename; // Simpan nama file ke database
            $produk->save(); // Update data setelah menyimpan file
        }
    
        // Redirect dengan pesan sukses
        return redirect()->route('produk.produk')->with('success', 'Data Produk Berhasil Disimpan');
    }
    
    public function destroy($id)
    {
        // Mencari produk berdasarkan ID
        $produk = Produk::findOrFail($id);
    
        // Hapus file desain jika ada
        if ($produk->desain) {
            $filePath = public_path('images/' . $produk->desain);
            if (file_exists($filePath)) {
                unlink($filePath); // Menghapus file desain
            }
        }
    
        // Hapus data produk
        $produk->delete();
    
        // Redirect dengan pesan sukses
        return redirect()->route('produk.produk')->with('success', 'Data Produk Berhasil Dihapus');
    }
    
    public function penjualan(){
        return view('produk.penjualan');
    }

    public function rekap(){
        return view('produk.rekap');
    }

    public function login(){
        return view('produk.login');
    }
}
