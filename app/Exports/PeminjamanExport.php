<?php

namespace App\Exports;

use App\Models\Peminjaman;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class PeminjamanExport implements FromCollection, WithHeadings, WithMapping
{
    public function collection()
    {
        return Peminjaman::with(['anggota', 'detail.buku'])->latest('tanggal_pinjam')->get();
    }

    public function headings(): array
    {
        return ['ID', 'Anggota', 'Tanggal Pinjam', 'Tanggal Kembali', 'Status', 'Jumlah Buku'];
    }

    public function map($p): array
    {
        return [
            $p->id_pinjam,
            $p->anggota->nama ?? '-',
            $p->tanggal_pinjam,
            $p->tanggal_kembali,
            $p->status,
            $p->detail->sum('jumlah'),
        ];
    }
}
