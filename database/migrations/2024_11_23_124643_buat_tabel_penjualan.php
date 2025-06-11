<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('penjualan', function (Blueprint $table) {
            $table->id(); // Kolom ID untuk penjualan
            $table->string('nama_toko', 100); // Nama toko, panjang 100 karakter
            $table->date('tanggal_penjualan'); // Tanggal penjualan
            $table->string('desain'); // Kolom untuk file desain (nama file atau path)
            $table->string('bentuk_desain', 100); // panjang 100 karakter
            $table->string('ukuran', 100); // panjang 100 karakter
            $table->integer('jumlah_pesanan'); // Menggunakan tipe integer untuk jumlah pesanan
            $table->decimal('harga', 15, 2); // Harga produk, dengan 2 angka desimal
            $table->timestamps(); // Kolom created_at dan updated_at
        });//
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
