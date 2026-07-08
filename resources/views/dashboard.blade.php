@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<h4 class="fw-bold mb-4">Dashboard</h4>

<div class="row g-3 mb-4">
    <div class="col-md-3 col-sm-6">
        <div class="stat-card" style="background: linear-gradient(135deg,#4f46e5,#6366f1);">
            <div class="small">Total Buku</div>
            <div class="fs-3 fw-bold">{{ $totalBuku }}</div>
            <i class="bi bi-book"></i>
        </div>
    </div>
    <div class="col-md-3 col-sm-6">
        <div class="stat-card" style="background: linear-gradient(135deg,#059669,#10b981);">
            <div class="small">Total Anggota</div>
            <div class="fs-3 fw-bold">{{ $totalAnggota }}</div>
            <i class="bi bi-people"></i>
        </div>
    </div>
    <div class="col-md-3 col-sm-6">
        <div class="stat-card" style="background: linear-gradient(135deg,#d97706,#f59e0b);">
            <div class="small">Sedang Dipinjam</div>
            <div class="fs-3 fw-bold">{{ $totalDipinjam }}</div>
            <i class="bi bi-journal-arrow-up"></i>
        </div>
    </div>
    <div class="col-md-3 col-sm-6">
        <div class="stat-card" style="background: linear-gradient(135deg,#dc2626,#ef4444);">
            <div class="small">Pengembalian Terlambat</div>
            <div class="fs-5 fw-bold">{{ $totalTerlambat }} transaksi</div>
            <div class="small">Total Denda: Rp {{ number_format($totalDenda, 0, ',', '.') }}</div>
        </div>
    </div>
</div>

<div class="row g-3">
    <div class="col-lg-7">
        <div class="card p-3 h-100 d-flex flex-column">
            <h6 class="fw-bold mb-3">Statistik Peminjaman (1 Bulan Terakhir)</h6>
            <div style="position:relative; flex:1; min-height:320px;">
                <canvas id="chartPeminjaman"></canvas>
            </div>
        </div>
    </div>
    <div class="col-lg-5">
        <div class="card p-3 h-100 d-flex flex-column">
            <h6 class="fw-bold mb-3">Buku per Kategori ({{ $totalKategori }} Kategori)</h6>
            <div style="position:relative; flex:1; min-height:320px;">
                <canvas id="chartKategori"></canvas>
            </div>
        </div>
    </div>
</div>

<div class="row g-3 mt-1">
    <div class="col-lg-8">
        <div class="card p-3">
            <h6 class="fw-bold mb-3">Akses Cepat</h6>
            <div class="d-flex flex-wrap gap-2">
                <a href="{{ route('buku.index') }}" class="btn btn-outline-primary btn-sm"><i class="bi bi-book"></i> Data Buku</a>
                <a href="{{ route('anggota.index') }}" class="btn btn-outline-success btn-sm"><i class="bi bi-people"></i> Anggota</a>
                <a href="{{ route('peminjaman.index') }}" class="btn btn-outline-warning btn-sm"><i class="bi bi-journal-arrow-up"></i> Peminjaman</a>
                <a href="{{ route('pengembalian.index') }}" class="btn btn-outline-danger btn-sm"><i class="bi bi-journal-arrow-down"></i> Pengembalian</a>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="card p-3">
            <h6 class="fw-bold mb-3">Status Sistem</h6>
            <p class="small text-muted mb-2">Sistem siap digunakan untuk mengelola perpustakaan secara teratur.</p>
            <div class="d-flex align-items-center gap-2 text-success fw-semibold">
                <i class="bi bi-check-circle-fill"></i> Semua modul utama aktif
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.4/dist/chart.umd.min.js"></script>
<script>
    const peminjamanLabels = {!! json_encode($peminjamanPerBulan->pluck('label')) !!};
    const peminjamanData = {!! json_encode($peminjamanPerBulan->pluck('total')) !!};

    new Chart(document.getElementById('chartPeminjaman'), {
        type: 'line',
        data: {
            labels: peminjamanLabels,
            datasets: [{
                label: 'Jumlah Peminjaman',
                data: peminjamanData,
                borderColor: '#4f46e5',
                backgroundColor: 'rgba(79,70,229,0.15)',
                borderWidth: 2,
                pointRadius: 4,
                pointHoverRadius: 6,
                tension: 0.3,
                fill: false,
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: { legend: { display: false } },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: { precision: 0 }
                }
            }
        }
    });

    const kategoriLabels = {!! json_encode($bukuPerKategori->pluck('nama_kategori')) !!};
    const kategoriData = {!! json_encode($bukuPerKategori->pluck('buku_count')) !!};

    new Chart(document.getElementById('chartKategori'), {
        type: 'doughnut',
        data: {
            labels: kategoriLabels,
            datasets: [{
                data: kategoriData,
                backgroundColor: ['#4f46e5','#10b981','#f59e0b','#ef4444','#0ea5e9','#8b5cf6','#ec4899','#14b8a6'],
            }]
        },
        options: { responsive: true }
    });
</script>
@endpush
