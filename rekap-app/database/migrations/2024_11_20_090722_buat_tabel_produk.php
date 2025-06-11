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
        Schema::create('produk', function (Blueprint $table) {
            $table->id();
            $table->string('nama_toko', 100); // panjang 100 karakter
            $table->string('alamat_toko', 255); // panjang 255 karakter
            $table->string('desain'); // Kolom untuk file desain (nama file atau path)
            $table->string('bentuk_desain', 100); // panjang 100 karakter
            $table->string('ukuran', 100); // panjang 100 karakter
            $table->integer('jumlah_pesanan'); // Menggunakan tipe integer untuk jumlah pesanan
            $table->timestamps(); // Kolom created_at dan updated_at
        });        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
