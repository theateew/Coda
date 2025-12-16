<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Coda - Note Taking App</title>
    <link href="https://fonts.bunny.net/css?family=Inter:400,500,600,700" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
        .hero {
            min-height: 100vh;
            display: flex;
            align-items: center;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }
        .feature-icon {
            font-size: 3rem;
            margin-bottom: 1rem;
            color: #667eea;
        }
        .card {
            transition: transform 0.3s;
            border: none;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        }
        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 12px rgba(0,0,0,0.15);
        }
    </style>
</head>
<body>
    <!-- Hero Section -->
    <section class="hero">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <h1 class="display-3 fw-bold mb-4">
                        <i class="bi bi-journal-text"></i> Coda
                    </h1>
                    <p class="lead mb-4">
                        Aplikasi catatan modern yang membantu Anda mengorganisir ide, tugas, dan pemikiran dengan mudah.
                    </p>
                    <div class="d-flex gap-3">
                        @auth
                            <a href="{{ route('dashboard') }}" class="btn btn-light btn-lg">
                                <i class="bi bi-speedometer2"></i> Dashboard
                            </a>
                        @else
                            <a href="{{ route('register') }}" class="btn btn-light btn-lg">
                                <i class="bi bi-person-plus"></i> Daftar Gratis
                            </a>
                            <a href="{{ route('login') }}" class="btn btn-outline-light btn-lg">
                                <i class="bi bi-box-arrow-in-right"></i> Login
                            </a>
                        @endauth
                    </div>
                </div>
                <div class="col-lg-6 text-center">
                    <i class="bi bi-journal-richtext" style="font-size: 15rem; opacity: 0.2;"></i>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="py-5">
        <div class="container">
            <h2 class="text-center mb-5">Fitur Unggulan</h2>
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="card text-center p-4 h-100">
                        <i class="bi bi-journal-plus feature-icon"></i>
                        <h5>CRUD Lengkap</h5>
                        <p class="text-muted">Buat, baca, edit, dan hapus catatan dengan mudah dan cepat.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card text-center p-4 h-100">
                        <i class="bi bi-search feature-icon"></i>
                        <h5>Pencarian Cepat</h5>
                        <p class="text-muted">Temukan catatan berdasarkan judul atau isi dengan fitur pencarian.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card text-center p-4 h-100">
                        <i class="bi bi-folder feature-icon"></i>
                        <h5>Organisasi Kategori</h5>
                        <p class="text-muted">Kelompokkan catatan dengan kategori berwarna yang dapat disesuaikan.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card text-center p-4 h-100">
                        <i class="bi bi-pin-angle feature-icon"></i>
                        <h5>Pin Catatan</h5>
                        <p class="text-muted">Sematkan catatan penting agar selalu berada di bagian atas.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card text-center p-4 h-100">
                        <i class="bi bi-moon-stars feature-icon"></i>
                        <h5>Dark Mode</h5>
                        <p class="text-muted">Bekerja nyaman di malam hari dengan mode gelap.</p>
                    </div>
                </div>
                <div class="col-md-4">
<div class="card text-center p-4 h-100">
<i class="bi bi-shield-check feature-icon"></i>
<h5>Aman & Privat</h5>
<p class="text-muted">Catatan Anda tersimpan aman dengan autentikasi email.</p>
</div>
</div>
</div>
</div>
</section>
<!-- CTA Section -->
<section class="py-5 bg-light">
    <div class="container text-center">
        <h2 class="mb-4">Siap Mulai Mencatat?</h2>
        <p class="lead mb-4">Bergabunglah dengan pengguna lain yang sudah mempercayai Coda</p>
        @guest
            <a href="{{ route('register') }}" class="btn btn-primary btn-lg">
                <i class="bi bi-rocket-takeoff"></i> Mulai Sekarang - Gratis!
            </a>
        @else
            <a href="{{ route('dashboard') }}" class="btn btn-primary btn-lg">
                <i class="bi bi-speedometer2"></i> Buka Dashboard
            </a>
        @endguest
    </div>
</section>

<!-- Footer -->
<footer class="py-4 bg-dark text-white text-center">
    <div class="container">
        <p class="mb-0">
            © {{ date('Y') }} Coda - Note Taking App. 
            Dibuat dengan menggunakan Laravel {{ app()->version() }}
        </p>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>