<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use App\Models\Buku;
use App\Models\DetailPeminjaman;
use App\Models\Peminjaman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PeminjamanController extends Controller
{
    public function index(Request $request)
    {
        $peminjamen = Peminjaman::with(['anggota', 'user', 'detail.buku'])
            ->when($request->search, function ($q) use ($request) {
                $q->whereHas('anggota', function ($qq) use ($request) {
                    $qq->where('nama', 'like', '%' . $request->search . '%');
                });
            })
            ->latest('tanggal_pinjam')
            ->paginate(10)
            ->withQueryString();

        return view('peminjaman.index', compact('peminjamen'));
    }

    public function create()
    {
        $anggotas = Anggota::orderBy('nama')->get();
        $bukus = Buku::where('stok', '>', 0)->orderBy('judul')->get();

        return view('peminjaman.create', compact('anggotas', 'bukus'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_anggota' => 'required|exists:anggota,id_anggota',
            'tanggal_pinjam' => 'required|date',
            'tanggal_kembali' => 'required|date|after_or_equal:tanggal_pinjam',
            'buku' => 'required|array|min:1',
            'buku.*' => 'exists:buku,id_buku',
            'jumlah' => 'required|array',
            'jumlah.*' => 'integer|min:1',
        ]);

        DB::transaction(function () use ($validated, $request) {
            $peminjaman = Peminjaman::create([
                'id_anggota' => $validated['id_anggota'],
                'id_user' => auth()->id(),
                'tanggal_pinjam' => $validated['tanggal_pinjam'],
                'tanggal_kembali' => $validated['tanggal_kembali'],
                'status' => 'dipinjam',
            ]);

            foreach ($request->buku as $index => $idBuku) {
                $jumlah = $request->jumlah[$index] ?? 1;

                DetailPeminjaman::create([
                    'id_pinjam' => $peminjaman->id_pinjam,
                    'id_buku' => $idBuku,
                    'jumlah' => $jumlah,
                ]);

                $buku = Buku::find($idBuku);
                $buku->decrement('stok', $jumlah);
            }
        });

        return redirect()->route('peminjaman.index')->with('success', 'Peminjaman berhasil dicatat.');
    }

    public function show(Peminjaman $peminjaman)
    {
        $peminjaman->load(['anggota', 'user', 'detail.buku', 'pengembalian']);
        return view('peminjaman.show', compact('peminjaman'));
    }

    public function destroy(Peminjaman $peminjaman)
    {
        $peminjaman->delete();
        return redirect()->route('peminjaman.index')->with('success', 'Data peminjaman berhasil dihapus.');
    }
}
