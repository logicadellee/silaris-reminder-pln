<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'SILARIS') }}</title>

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="bg-body-tertiary">
        <div class="min-vh-100 d-flex flex-column justify-content-center align-items-center py-5">
            <div class="mb-4 text-center">
                <a href="/" class="d-inline-block">
                    <x-application-logo class="d-block" />
                </a>
            </div>

            <div class="card shadow-sm border-0 w-100 auth-card">
                <div class="card-body p-4 p-lg-5">
                    {{ $slot }}
                </div>
            </div>
        </div>
    </body>
</html>
