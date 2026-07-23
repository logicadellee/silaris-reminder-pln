<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'SILARIS') }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    {{-- Bootstrap Icons --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>

        *{
            margin:0;
            padding:0;
            box-sizing:border-box;
            font-family:'Segoe UI',sans-serif;
        }

        body{

            min-height:100vh;

            background:
            linear-gradient(
            135deg,
            #0057b8 0%,
            #1976d2 45%,
            #42a5f5 100%);

            display:flex;
            justify-content:center;
            align-items:center;

            padding:30px;

        }

        .login-card{

            width:1150px;
            max-width:100%;

            background:#fff;

            border-radius:24px;

            overflow:hidden;

            box-shadow:
            0 25px 60px rgba(0,0,0,.25);

        }

        .left-side{

            background:#0057b8;

            color:white;

            min-height:650px;

            display:flex;

            flex-direction:column;

            justify-content:center;

            align-items:center;

            text-align:center;

            padding:60px;

            position:relative;

        }

        .left-side::before{

            content:"";

            position:absolute;

            width:300px;
            height:300px;

            border-radius:50%;

            background:rgba(255,255,255,.05);

            top:-80px;
            left:-80px;

        }

        .left-side::after{

            content:"";

            position:absolute;

            width:250px;
            height:250px;

            border-radius:50%;

            background:rgba(255,255,255,.05);

            bottom:-90px;
            right:-90px;

        }

        .left-side img{

            width:180px;

            margin-bottom:35px;

        }

        .left-side h1{

            font-size:48px;

            letter-spacing:2px;

        }

        .left-side p{

            font-size:20px;

            opacity:.95;

        }

        .left-side .company{

            z-index:2;

            font-size:18px;

            opacity:.9;

        }

        .right-side{

            padding:70px 65px;

            display:flex;

            align-items:center;

        }

        .auth-wrapper{

            width:100%;

        }

        .auth-title{

            font-size:46px;

            font-weight:700;

            color:#0057b8;

            margin-bottom:10px;

        }

        .auth-subtitle{

            color:#666;

            font-size:18px;

            margin-bottom:40px;

        }

        .form-control{

            height:55px;

            border-radius:12px;

        }

        .input-group-text{

            border-radius:12px 0 0 12px;

        }

        .btn-login{

            height:55px;

            border-radius:12px;

            font-size:18px;

            font-weight:600;

            background:#0057b8;

            border:none;

            transition:.3s;

        }

        .btn-login:hover{

            background:#00428b;

        }

        a{

            text-decoration:none;

        }

        @media(max-width:992px){

            .left-side{

                display:none;

            }

            .right-side{

                padding:45px 35px;

            }

            .auth-title{

                font-size:36px;

            }

        }

    </style>

</head>

<body>

<div class="login-card">

    <div class="row g-0">

        <div class="col-lg-5">

            <div class="left-side">

                <img src="{{ asset('images/pln.png') }}" alt="PLN">

                <h1>SILARIS</h1>

                <p>

                    Sistem Reminder
                    <br>
                    Pembayaran Tagihan
                    <br>
                    Listrik

                </p>

                <div class="company">

                    PT PLN (Persero)
                    <br>
                    ULP Way Halim

                </div>

            </div>

        </div>

        <div class="col-lg-7">

            <div class="right-side">

                <div class="auth-wrapper">

                    {{ $slot }}

                </div>

            </div>

        </div>

    </div>

</div>

</body>
</html>