<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Perpustakaan Digital</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
</head>
<body class="auth-body">
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="card shadow-lg border-0">
                    <div class="card-body p-4 p-md-5">
                        <div class="row align-items-center g-4">
                            <div class="col-lg-7">
                                <h1 class="fw-bold mb-3">Sistem Perpustakaan Digital</h1>
                                <p class="text-muted mb-4">Kelola data buku, anggota, peminjaman, pengembalian, serta laporan secara terstruktur dari satu aplikasi.</p>
                                <div class="d-flex flex-wrap gap-2 mb-4">
                                    @auth
                                        <a href="{{ route('dashboard') }}" class="btn btn-primary"><i class="bi bi-speedometer2"></i> Ke Dashboard</a>
                                    @else
                                        <a href="{{ route('login') }}" class="btn btn-primary"><i class="bi bi-box-arrow-in-right"></i> Login</a>
                                        <a href="{{ route('register') }}" class="btn btn-outline-secondary"><i class="bi bi-person-plus"></i> Daftar</a>
                                    @endauth
                                </div>
                                <div class="row g-3">
                                    <div class="col-sm-6">
                                        <div class="border rounded p-3 h-100">
                                            <h6 class="fw-bold mb-2"><i class="bi bi-book"></i> Data Buku</h6>
                                            <p class="small text-muted mb-0">Catat koleksi buku, kategori, stok, dan informasi penting lainnya.</p>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="border rounded p-3 h-100">
                                            <h6 class="fw-bold mb-2"><i class="bi bi-journal-arrow-up"></i> Peminjaman</h6>
                                            <p class="small text-muted mb-0">Kelola proses peminjaman, batas pengembalian, dan status transaksi.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-5">
                                <div class="bg-light rounded p-4 h-100">
                                    <h5 class="fw-bold mb-3">Fitur Utama</h5>
                                    <ul class="list-unstyled mb-0">
                                        <li class="mb-2"><i class="bi bi-check-circle-fill text-success"></i> Dashboard statistik</li>
                                        <li class="mb-2"><i class="bi bi-check-circle-fill text-success"></i> Manajemen anggota dan kategori</li>
                                        <li class="mb-2"><i class="bi bi-check-circle-fill text-success"></i> Proses peminjaman & pengembalian</li>
                                        <li class="mb-2"><i class="bi bi-check-circle-fill text-success"></i> Export Excel & PDF</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>