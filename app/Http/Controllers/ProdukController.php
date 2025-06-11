<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produk;

class ProdukController extends Controller
{
    // Menampilkan halaman daftar produk
    public function produk()
    {
        $dataProduk = Produk::all(); // Mengambil semua data produk dari tabel `produk`
        return view('produk.produk', compact('dataProduk'));
    }

    // Menampilkan halaman tambah data produk
    public function createproduk()
    {
        return view('produk.createproduk');
    }

    // Menyimpan data produk baru ke database
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'nama_toko' => 'required|string|max:255',
            'alamat_toko' => 'required|string|max:1000',
        ]);

        // Menyimpan data produk ke database
        Produk::create([
            'nama_toko' => $request->nama_toko,
            'alamat_toko' => $request->alamat_toko,
        ]);

        // Redirect dengan pesan sukses
        return redirect()->route('produk.produk')->with('success', 'Data Produk Berhasil Disimpan');
    }

    // Menampilkan halaman edit produk berdasarkan ID
    public function editproduk($id)
    {
        $data = Produk::findOrFail($id); // Mencari produk berdasarkan ID
        return view('produk.editproduk', compact('data'));
    }

    // Mengupdate data produk berdasarkan ID
    public function update(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'nama_toko' => 'required|string|max:255',
            'alamat_toko' => 'required|string|max:1000',
        ]);

        // Mencari produk dan mengupdate data
        $produk = Produk::findOrFail($id);
        $produk->update([
            'nama_toko' => $request->nama_toko,
            'alamat_toko' => $request->alamat_toko,
        ]);

        // Redirect dengan pesan sukses
        return redirect()->route('produk.produk')->with('success', 'Data Produk Berhasil Diperbarui');
    }

    // Menghapus data produk berdasarkan ID
    public function destroy($id)
    {
        $produk = Produk::findOrFail($id); // Mencari produk berdasarkan ID
        $produk->delete(); // Menghapus data

        // Redirect dengan pesan sukses
        return redirect()->route('produk.produk')->with('success', 'Data Produk Berhasil Dihapus');
    }
}
