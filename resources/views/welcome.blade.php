<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ config('app.name', 'SILARIS') }}</title>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="bg-body-tertiary">
        <div class="container py-5">
            <div class="row align-items-center min-vh-100 g-4">
                <div class="col-lg-6">
                    <span class="badge text-bg-primary mb-3">SILARIS</span>
                    <h1 class="display-5 fw-bold mb-3">Sistem Reminder Pembayaran Tagihan Listrik</h1>
                    <p class="lead text-muted mb-4">
                        Aplikasi internal admin PLN untuk mengelola pelanggan,
                        tagihan listrik, dan pengiriman reminder pembayaran melalui WhatsApp Gateway.
                    </p>

                    <div class="d-flex flex-wrap gap-2">
                        @auth
                            <a href="{{ url('/dashboard') }}" class="btn btn-primary">Dashboard</a>
                        @else
                            <a href="{{ route('login') }}" class="btn btn-primary">Masuk</a>

                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="btn btn-outline-secondary">Daftar</a>
                            @endif
                        @endauth
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="card border-0 shadow-lg">
                        <div class="card-body p-4 p-lg-5">
                            <div class="row g-3">
                                <div class="col-sm-6">
                                    <div class="card h-100 border-0 bg-light">
                                        <div class="card-body">
                                            <h2 class="h6 text-uppercase text-body-secondary">Pelanggan</h2>
                                            <p class="fs-4 fw-semibold mb-0">1.248</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="card h-100 border-0 bg-light">
                                        <div class="card-body">
                                            <h2 class="h6 text-uppercase text-body-secondary">Tagihan</h2>
                                            <p class="fs-4 fw-semibold mb-0">184</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="card h-100 border-0 bg-light">
                                        <div class="card-body">
                                            <h2 class="h6 text-uppercase text-body-secondary">Reminder</h2>
                                            <p class="fs-4 fw-semibold mb-0">96</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="card h-100 border-0 bg-light">
                                        <div class="card-body">
                                            <h2 class="h6 text-uppercase text-body-secondary">Status</h2>
                                            <p class="fs-4 fw-semibold mb-0">Aktif</p>
                                        </div>
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
