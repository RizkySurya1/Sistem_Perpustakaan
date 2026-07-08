<?php

namespace App\Http\Controllers;

use App\Exports\BukuExport;
use App\Exports\PeminjamanExport;
use App\Models\Buku;
use App\Models\Peminjaman;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;

class ExportController extends Controller
{
    public function bukuExcel()
    {
        return Excel::download(new BukuExport, 'data-buku.xlsx');
    }

    public function bukuPdf()
    {
        $bukus = Buku::with('kategori')->orderBy('judul')->get();
        $pdf = Pdf::loadView('exports.pdf_buku', compact('bukus'))->setPaper('a4', 'landscape');
        return $pdf->download('data-buku.pdf');
    }

    public function peminjamanExcel()
    {
        return Excel::download(new PeminjamanExport, 'data-peminjaman.xlsx');
    }

    public function peminjamanPdf()
    {
        $peminjamen = Peminjaman::with(['anggota', 'detail.buku'])->latest('tanggal_pinjam')->get();
        $pdf = Pdf::loadView('exports.pdf_peminjaman', compact('peminjamen'))->setPaper('a4', 'landscape');
        return $pdf->download('data-peminjaman.pdf');
    }
}
