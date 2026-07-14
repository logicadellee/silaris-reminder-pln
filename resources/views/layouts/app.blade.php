<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'SILARIS') }}</title>

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body>
        <div class="app-shell container-fluid px-0">
            <div class="row g-0 min-vh-100">
                <aside class="app-sidebar col-auto border-end bg-white">
                    @include('partials.sidebar')
                </aside>

                <div class="col d-flex flex-column">
                    <header class="app-navbar border-bottom bg-white">
                        @include('partials.navbar')
                    </header>

                    <main class="app-content flex-grow-1">
                        @isset($header)
                            <div class="mb-4">
                                {{ $header }}
                            </div>
                        @endisset

                        {{ $slot }}
                    </main>

                    <footer class="app-footer border-top bg-white">
                        @include('partials.footer')
                    </footer>
                </div>
            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.3/dist/chart.umd.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.12.0/dist/sweetalert2.all.min.js"></script>
    </body>
</html>
