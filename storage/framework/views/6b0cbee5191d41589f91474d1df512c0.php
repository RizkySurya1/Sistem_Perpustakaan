<!DOCTYPE html>
<html lang="id" data-bs-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $__env->yieldContent('title', 'Dashboard'); ?> - Perpustakaan Digital</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <link href="<?php echo e(asset('css/style.css')); ?>" rel="stylesheet">
    <?php echo $__env->yieldPushContent('styles'); ?>
</head>
<body>
    <nav class="navbar navbar-expand-lg sticky-top navbar-main px-3">
        <button class="btn btn-sm btn-outline-secondary d-lg-none me-2" id="sidebarToggle"><i class="bi bi-list"></i></button>
        <a class="navbar-brand fw-bold" href="<?php echo e(route('dashboard')); ?>">
            Perpustakaan Digital
        </a>
        <div class="ms-auto d-flex align-items-center gap-2">
            <button class="btn btn-sm btn-outline-secondary" id="darkModeToggle" title="Mode Gelap">
                <i class="bi bi-moon-stars"></i>
            </button>
            <div class="dropdown">
                <button class="btn btn-sm btn-outline-primary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                    <i class="bi bi-person-circle"></i> <?php echo e(auth()->user()->nama); ?>

                    <span class="badge text-bg-secondary ms-1"><?php echo e(ucfirst(auth()->user()->role)); ?></span>
                </button>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li>
                        <form action="<?php echo e(route('logout')); ?>" method="POST">
                            <?php echo csrf_field(); ?>
                            <button class="dropdown-item text-danger" type="submit"><i class="bi bi-box-arrow-right"></i> Logout</button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="d-flex">
        <aside class="sidebar" id="sidebar">
            <ul class="nav flex-column p-3">
                <li class="nav-item">
                    <a class="nav-link <?php echo e(request()->routeIs('dashboard') ? 'active' : ''); ?>" href="<?php echo e(route('dashboard')); ?>">
                        <i class="bi bi-speedometer2"></i> Dashboard
                    </a>
                </li>
                <?php if(auth()->user()->isAdmin()): ?>
                <li class="nav-item">
                    <a class="nav-link <?php echo e(request()->routeIs('kategori.*') ? 'active' : ''); ?>" href="<?php echo e(route('kategori.index')); ?>">
                        <i class="bi bi-tags"></i> Kategori Buku
                    </a>
                </li>
                <?php endif; ?>
                <li class="nav-item">
                    <a class="nav-link <?php echo e(request()->routeIs('buku.*') ? 'active' : ''); ?>" href="<?php echo e(route('buku.index')); ?>">
                        <i class="bi bi-book"></i> Data Buku
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo e(request()->routeIs('anggota.*') ? 'active' : ''); ?>" href="<?php echo e(route('anggota.index')); ?>">
                        <i class="bi bi-people"></i> Anggota
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo e(request()->routeIs('peminjaman.*') ? 'active' : ''); ?>" href="<?php echo e(route('peminjaman.index')); ?>">
                        <i class="bi bi-journal-arrow-up"></i> Peminjaman
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo e(request()->routeIs('pengembalian.*') ? 'active' : ''); ?>" href="<?php echo e(route('pengembalian.index')); ?>">
                        <i class="bi bi-journal-arrow-down"></i> Pengembalian &amp; Denda
                    </a>
                </li>
            </ul>
        </aside>

        <main class="content-area flex-fill p-4">
            <?php if(session('success')): ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <?php echo e(session('success')); ?>

                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            <?php endif; ?>
            <?php if($errors->any()): ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <ul class="mb-0">
                        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li><?php echo e($error); ?></li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            <?php endif; ?>

            <?php echo $__env->yieldContent('content'); ?>
        </main>
    </div>

    <footer class="app-footer px-4 py-3 small text-muted border-top bg-white">
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-center gap-2">
            <span>Sistem Perpustakaan Digital</span>
            <span>Versi 1.0 • Dikelola untuk kebutuhan administrasi perpustakaan</span>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="<?php echo e(asset('js/app.js')); ?>"></script>
    <?php echo $__env->yieldPushContent('scripts'); ?>
</body>
</html>
<?php /**PATH C:\laragon\www\perpustakaan-app\resources\views/layouts/app.blade.php ENDPATH**/ ?>