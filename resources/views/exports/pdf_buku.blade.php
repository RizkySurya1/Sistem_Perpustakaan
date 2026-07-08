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
    <h2>Laporan Data Buku</h2>
    <p class="sub">Perpustakaan Digital &mdash; Dicetak pada {{ now()->format('d-m-Y H:i') }}</p>
    <table>
        <thead>
            <tr><th>No</th><th>Judul</th><th>Pengarang</th><th>Penerbit</th><th>Tahun</th><th>Kategori</th><th>Stok</th></tr>
        </thead>
        <tbody>
            @foreach($bukus as $i => $b)
            <tr>
                <td>{{ $i + 1 }}</td>
                <td>{{ $b->judul }}</td>
                <td>{{ $b->pengarang }}</td>
                <td>{{ $b->penerbit }}</td>
                <td>{{ $b->tahun_terbit }}</td>
                <td>{{ $b->kategori->nama_kategori ?? '-' }}</td>
                <td>{{ $b->stok }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
