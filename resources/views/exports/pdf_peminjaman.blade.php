<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <style>
        body { font-family: sans-serif; font-size: 12px; }
        h2 { text-align: center; margin-bottom: 4px; }
        p.sub { text-align: center; margin-top: 0; color: #555; }
        table { width: 100%; border-collapse: collapse; margin-top: 15px; }
        th, td { border: 1px solid #999; padding: 6px 8px; text-align: left; }
        th { background-color: #4f46e5; color: #fff; }
        tr:nth-child(even) { background-color: #f4f6f9; }
    </style>
</head>
<body>
    <h2>Laporan Data Peminjaman</h2>
    <p class="sub">Perpustakaan Digital &mdash; Dicetak pada {{ now()->format('d-m-Y H:i') }}</p>
    <table>
        <thead>
            <tr><th>No</th><th>Anggota</th><th>Tgl Pinjam</th><th>Tgl Kembali</th><th>Status</th><th>Jumlah Buku</th></tr>
        </thead>
        <tbody>
            @foreach($peminjamen as $i => $p)
            <tr>
                <td>{{ $i + 1 }}</td>
                <td>{{ $p->anggota->nama ?? '-' }}</td>
                <td>{{ \Carbon\Carbon::parse($p->tanggal_pinjam)->format('d-m-Y') }}</td>
                <td>{{ \Carbon\Carbon::parse($p->tanggal_kembali)->format('d-m-Y') }}</td>
                <td>{{ ucfirst($p->status) }}</td>
                <td>{{ $p->detail->sum('jumlah') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
