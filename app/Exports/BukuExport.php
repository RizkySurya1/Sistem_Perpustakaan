<?php

namespace App\Exports;

use App\Models\Buku;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class BukuExport implements FromCollection, WithHeadings, WithMapping
{
    public function collection()
    {
        return Buku::with('kategori')->orderBy('judul')->get();
    }

    public function headings(): array
    {
        return ['ID', 'Judul', 'Pengarang', 'Penerbit', 'Tahun Terbit', 'Kategori', 'Stok'];
    }

    public function map($buku): array
    {
        return [
            $buku->id_buku,
            $buku->judul,
            $buku->pengarang,
            $buku->penerbit,
            $buku->tahun_terbit,
            $buku->kategori->nama_kategori ?? '-',
            $buku->stok,
        ];
    }
}
