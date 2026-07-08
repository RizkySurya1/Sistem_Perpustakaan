<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use App\Models\Buku;
use App\Models\Kategori;
use App\Models\Peminjaman;
use App\Models\Pengembalian;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $totalBuku = Buku::count();
        $totalAnggota = Anggota::count();
        $totalKategori = Kategori::count();
        $totalDipinjam = Peminjaman::where('status', 'dipinjam')->count();
        $totalTerlambat = Pengembalian::where('denda', '>', 0)->count();
        $totalDenda = Pengembalian::sum('denda');

        // Peminjaman per hari dalam 1 bulan terakhir untuk grafik
        $startDate = now()->subDays(29)->startOfDay();
        $endDate = now()->endOfDay();

        $peminjamanPerHari = Peminjaman::select(
                DB::raw('DATE(tanggal_pinjam) as tanggal'),
                DB::raw('count(*) as total')
            )
            ->whereBetween('tanggal_pinjam', [$startDate, $endDate])
            ->groupBy(DB::raw('DATE(tanggal_pinjam)'))
            ->orderBy('tanggal')
            ->pluck('total', 'tanggal');

        $peminjamanPerBulan = collect();
        for ($date = $startDate->copy(); $date <= $endDate; $date->addDay()) {
            $key = $date->format('Y-m-d');
            $peminjamanPerBulan->push([
                'label' => $date->translatedFormat('d M'),
                'total' => $peminjamanPerHari[$key] ?? 0,
            ]);
        }

        // Buku per kategori untuk grafik pie
        $bukuPerKategori = Kategori::withCount('buku')->get();

        return view('dashboard', compact(
            'totalBuku', 'totalAnggota', 'totalKategori', 'totalDipinjam',
            'totalTerlambat', 'totalDenda', 'peminjamanPerBulan', 'bukuPerKategori'
        ));
    }
}
