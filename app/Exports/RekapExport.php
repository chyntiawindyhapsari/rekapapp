<?php

namespace App\Exports;

use App\Models\Penjualan;
use App\Models\Produk;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithDrawings;
use Maatwebsite\Excel\Concerns\WithEvents; // Import WithEvents interface
use Maatwebsite\Excel\Concerns\AfterSheet;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;

class RekapExport implements FromCollection, WithHeadings, WithDrawings, WithEvents
{
    protected $beginDate;
    protected $endDate;
    protected $month;
    protected $year;

    public function __construct($beginDate, $endDate, $month, $year)
    {
        $this->beginDate = $beginDate;
        $this->endDate = $endDate;
        $this->month = $month;
        $this->year = $year;
    }

    public function collection(): Collection
    {
        return Penjualan::join('produk', 'penjualan.nama_toko', '=', 'produk.nama_toko')
            ->select(
                'produk.nama_toko',
                'produk.alamat_toko',
                'penjualan.desain',
                'penjualan.tanggal_penjualan',
                'penjualan.ukuran',
                'penjualan.jumlah_pesanan',
                'penjualan.harga'
            )
            ->when($this->beginDate && $this->endDate, function ($query) {
                $query->whereBetween('penjualan.tanggal_penjualan', [$this->beginDate, $this->endDate]);
            })
            ->when($this->month && $this->year, function ($query) {
                $query->whereMonth('penjualan.tanggal_penjualan', $this->month)
                      ->whereYear('penjualan.tanggal_penjualan', $this->year);
            })
            ->when($this->month && !$this->year, function ($query) {
                $query->whereMonth('penjualan.tanggal_penjualan', $this->month);
            })
            ->when($this->year && !$this->month, function ($query) {
                $query->whereYear('penjualan.tanggal_penjualan', $this->year);
            })
            ->get();
    }

    public function headings(): array
    {
        return [
            'Nama Toko',
            'Alamat Toko',
            'Desain',
            'Tanggal Penjualan',
            'Ukuran Produk',
            'Jumlah Pesanan',
            'Harga Produk',
        ];
    }

    public function drawings()
    {
        $drawings = [];
        $data = $this->collection();

        foreach ($data as $key => $row) {
            if ($row->desain) {
                $drawing = new Drawing();
                $drawing->setName('Desain Produk');
                $drawing->setDescription('Desain Produk');
                $drawing->setPath(public_path('images/' . $row->desain));
                $drawing->setHeight(100);
                $drawing->setCoordinates('C' . ($key + 2));
                $drawings[] = $drawing;
            }
        }

        return $drawings;
    }

    // Implement registerEvents method to register the afterSheet event
    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                // Menghitung total harga dari semua toko
                $totalHarga = $this->collection()->sum('harga'); // Menjumlahkan semua harga produk

                // Menambahkan baris total harga di bawah data
                $rowCount = count($this->collection()) + 2; // Menghitung jumlah baris data
                $event->sheet->setCellValue('A' . $rowCount, 'TOTAL HARGA SEMUA TOKO');
                $event->sheet->setCellValue('H' . $rowCount, $totalHarga); // Menampilkan total harga di kolom H

                // Mengatur format angka pada kolom H sebagai format currency
                $event->sheet->getStyle('H' . $rowCount)->getNumberFormat()->setFormatCode('[$Rp-421]#,##0');
            },
        ];
    }
}
