<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penjualan extends Model
{
    use HasFactory;
    protected $table = 'penjualan';
    protected $primaryKey = 'id';
    protected $fillable = [
        'nama_toko',
        'tanggal_penjualan',
        'desain', 
        'bentuk_desain', 
        'ukuran',
        'jumlah_pesanan',
        'harga',
    ];
    protected $appends = ['harga_total'];

    public function getHargaTotalAttribute()
    {
        return (float) $this->ukuran * $this->jumlah_pesanan;
    }
}
