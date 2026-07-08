<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - Perpustakaan Digital</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
</head>
<body class="auth-body d-flex align-items-center justify-content-center min-vh-100">
    <div class="card shadow-lg auth-card">
        <div class="card-body p-4">
            <div class="text-center mb-4">
                <h4 class="fw-bold">Sistem Perpustakaan Digital</h4>
            </div>
            @yield('content')
        </div>
    </div>
</body>
</html>
