<?php

namespace App\Http\Controllers;

use App\Models\Peminjaman;
use App\Models\Pengembalian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PengembalianController extends Controller
{
    const DENDA_PER_HARI = 2000; // Rp 2.000 / hari keterlambatan

    public function index(Request $request)
    {
        $pengembalians = Pengembalian::with('peminjaman.anggota')
            ->latest('tanggal_dikembalikan')
            ->paginate(10);

        return view('pengembalian.index', compact('pengembalians'));
    }

    public function create()
    {
        // Hanya tampilkan peminjaman yang masih berstatus dipinjam/terlambat
        $peminjamen = Peminjaman::with('anggota')
            ->whereIn('status', ['dipinjam', 'terlambat'])
            ->orderBy('tanggal_kembali')
            ->get();

        return view('pengembalian.create', compact('peminjamen'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_pinjam' => 'required|exists:peminjaman,id_pinjam',
            'tanggal_dikembalikan' => 'required|date',
        ]);

        DB::transaction(function () use ($validated) {
            $peminjaman = Peminjaman::with('detail')->findOrFail($validated['id_pinjam']);

            $tglKembaliRencana = \Carbon\Carbon::parse($peminjaman->tanggal_kembali);
            $tglDikembalikan = \Carbon\Carbon::parse($validated['tanggal_dikembalikan']);

            $terlambatHari = $tglDikembalikan->gt($tglKembaliRencana)
                ? $tglKembaliRencana->diffInDays($tglDikembalikan)
                : 0;

            $denda = $terlambatHari * self::DENDA_PER_HARI;

            Pengembalian::create([
                'id_pinjam' => $peminjaman->id_pinjam,
                'tanggal_dikembalikan' => $validated['tanggal_dikembalikan'],
                'denda' => $denda,
            ]);

            // Kembalikan stok buku
            foreach ($peminjaman->detail as $detail) {
                $detail->buku()->increment('stok', $detail->jumlah);
            }

            $peminjaman->update(['status' => 'dikembalikan']);
        });

        return redirect()->route('pengembalian.index')->with('success', 'Pengembalian berhasil dicatat.');
    }
}
