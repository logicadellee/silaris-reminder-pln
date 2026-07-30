<x-app-layout>

    <x-slot name="header">

        <div class="d-flex justify-content-between align-items-center">

            <div>

                <h3 class="fw-bold mb-0">
                    Dashboard SILARIS
                </h3>

                <small class="text-muted">
                    Sistem Reminder Pembayaran Tagihan PLN
                </small>

            </div>

        </div>

    </x-slot>

    <div class="container-fluid py-4">

        <!-- Welcome Banner -->

        <div class="card welcome-banner shadow-lg border-0 rounded-4 mb-4">

            <div class="card-body p-5">

                <div class="row align-items-center">

                    <div class="col-lg-8">

                        <span class="badge bg-light text-primary px-3 py-2 mb-3">

                            Dashboard SILARIS

                        </span>

                        <h2 class="fw-bold text-white">

                            Selamat Datang, Administrator

                        </h2>

                        <p class="mt-3 text-light fs-5">

                            Sistem Informasi Reminder Pembayaran Tagihan
                            PT PLN (Persero) ULP Way Halim.

                            Dashboard ini membantu memantau pelanggan,
                            tagihan listrik, dan proses pengiriman reminder
                            secara cepat dan real-time.

                        </p>

                        <div class="row mt-4">

                            <div class="col-md-6">

                                <div class="glass-box">

                                    <div class="d-flex align-items-center">

                                        <div class="mini-icon bg-primary">

                                            <i class="bi bi-calendar-event-fill"></i>

                                        </div>

                                        <div class="ms-3">

                                            <small>Hari Ini</small>

                                            <div class="fw-bold" id="tanggalBanner"></div>

                                        </div>

                                    </div>

                                </div>

                            </div>

                            <div class="col-md-6 mt-3 mt-md-0">

                                <div class="glass-box">

                                    <div class="d-flex align-items-center">

                                        <div class="mini-icon bg-success">

                                            <i class="bi bi-clock-fill"></i>

                                        </div>

                                        <div class="ms-3">

                                            <small>Jam Sekarang</small>

                                            <div class="fw-bold" id="jamBanner"></div>

                                        </div>

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                    <div class="col-lg-4 text-center">

                        <img

                            src="https://cdn-icons-png.flaticon.com/512/3135/3135715.png"

                            class="banner-image"

                            alt="Dashboard">

                    </div>

                </div>

            </div>

        </div>

        <!-- Statistik -->

        <div class="row g-4">

    {{-- Total Pelanggan --}}
    <div class="col-xl-3 col-md-6">

        <div class="card stat-card pelanggan h-100">

            <div class="card-body">

                <div class="d-flex justify-content-between align-items-start">

                    <div>

                        <span class="card-title-small">
                            Total Pelanggan
                        </span>

                        <h2 class="fw-bold mt-3 mb-1">
                            {{ number_format($totalPelanggan) }}
                        </h2>

                        <small class="text-muted">
                            Data pelanggan terdaftar
                        </small>

                    </div>

                    <div class="stat-icon bg-primary">

                        <i class="bi bi-people-fill"></i>

                    </div>

                </div>

            </div>

        </div>

    </div>

    {{-- Total Tagihan --}}
    <div class="col-xl-3 col-md-6">

        <div class="card stat-card tagihan h-100">

            <div class="card-body">

                <div class="d-flex justify-content-between align-items-start">

                    <div>

                        <span class="card-title-small">
                            Total Tagihan
                        </span>

                        <h2 class="fw-bold mt-3 mb-1">
                            {{ number_format($totalTagihan) }}
                        </h2>

                        <small class="text-muted">
                            Seluruh data tagihan
                        </small>

                    </div>

                    <div class="stat-icon bg-warning">

                        <i class="bi bi-receipt-cutoff"></i>

                    </div>

                </div>

            </div>

        </div>

    </div>

    {{-- Total Pengiriman --}}
    <div class="col-xl-3 col-md-6">

        <div class="card stat-card pengiriman h-100">

            <div class="card-body">

                <div class="d-flex justify-content-between align-items-start">

                    <div>

                        <span class="card-title-small">
                            Total Pengiriman
                        </span>

                        <h2 class="fw-bold mt-3 mb-1 text-info">
                            {{ number_format($totalPengiriman) }}
                        </h2>

                        <small class="text-muted">
                            Reminder berhasil dikirim
                        </small>

                    </div>

                    <div class="stat-icon bg-info">

                        <i class="bi bi-send-check-fill"></i>

                    </div>

                </div>

            </div>

        </div>

    </div>

    {{-- Persentase --}}
    <div class="col-xl-3 col-md-6">

        <div class="card stat-card persentase h-100">

            <div class="card-body">

                <div class="d-flex justify-content-between align-items-start">

                    <div>

                        <span class="card-title-small">
                            Persentase Pengiriman
                        </span>

                        <h2 class="fw-bold mt-3 mb-1 text-success">
                            {{ $persentasePengiriman }}%
                        </h2>

                        <small class="text-muted">
                            Tingkat keberhasilan
                        </small>

                    </div>

                    <div class="stat-icon bg-success">

                        <i class="bi bi-graph-up-arrow"></i>

                    </div>

                </div>

            </div>

        </div>

    </div>

    </div>

    <div class="row mt-4">

    <div class="col-lg-8">

        <div class="card border-0 shadow-lg rounded-4 h-100">

            <div class="card-body p-4">

                <div class="d-flex justify-content-between align-items-center mb-4">

                    <h5 class="fw-bold mb-0">

                        Progress Pengiriman Reminder

                    </h5>

                    <span class="badge bg-success fs-6">

                        {{ $persentasePengiriman }}%

                    </span>

                </div>

                <div class="progress progress-modern">

                    <div class="progress-bar progress-bar-striped progress-bar-animated bg-success"

                        style="width: {{ $persentasePengiriman }}%">

                    </div>

                </div>

                <div class="mt-3">

                    <small class="text-muted">

                        Sistem telah mengirim

                        <strong>{{ number_format($totalPengiriman) }}</strong>

                        reminder dari

                        <strong>{{ number_format($totalTagihan) }}</strong>

                        tagihan yang tersedia.

                    </small>

                </div>

            </div>

        </div>

    </div>

    <div class="col-lg-4 mt-4 mt-lg-0">

        <div class="card border-0 shadow-lg rounded-4 h-100">

            <div class="card-body p-4">

                <h5 class="fw-bold mb-4">

                    Informasi Sistem

                </h5>

                <div class="system-item">

                    <i class="bi bi-check-circle-fill text-success"></i>

                    <span>Sistem berjalan normal.</span>

                </div>

                <div class="system-item">

                    <i class="bi bi-database-fill text-primary"></i>

                    <span>Database berhasil terhubung.</span>

                </div>

                <div class="system-item">

                    <i class="bi bi-envelope-check-fill text-info"></i>

                    <span>Reminder siap dikirim.</span>

                </div>

                <div class="system-item">

                    <i class="bi bi-shield-check text-warning"></i>

                    <span>Data aman dan tersimpan.</span>

                </div>

            </div>

        </div>

    </div>

</div>

    </div>

    <style>

        body{
            background:#f4f7fb;
        }

        /* ==========================
           WELCOME BANNER
        ========================== */

        .welcome-banner{

    background:
        linear-gradient(
            90deg,
            rgba(13,110,253,.95) 0%,
            rgba(79,157,255,.90) 60%,
            rgba(79,157,255,.75) 100%
        ),
        url("{{ asset('images/tiang.jpg') }}");

    background-repeat:no-repeat;

    background-position:right center;

    background-size:contain;

    border:none;

    overflow:hidden;

}

        .welcome-banner h2{

            color:white;

            font-size:2rem;

        }

        .welcome-banner p{

            color:#eef4ff;

        }

        .glass-box{

            background:rgba(255,255,255,.18);

            backdrop-filter:blur(10px);

            border-radius:15px;

            padding:15px;

            color:white;

        }

        .glass-box small{

            color:#e9f2ff;

        }

        .banner-image{

            width:240px;

            max-width:100%;

            animation:float 4s ease-in-out infinite;

        }

        .mini-icon{

            width:50px;

            height:50px;

            border-radius:50%;

            display:flex;

            justify-content:center;

            align-items:center;

            color:white;

            font-size:22px;

        }

        /* ==========================
           CARD
        ========================== */

        .stat-card{

            border:none;

            border-radius:18px;

            overflow:hidden;

            transition:.35s;

            box-shadow:0 10px 25px rgba(0,0,0,.08);

            position:relative;

        }

        .stat-card:hover{

            transform:translateY(-8px);

            box-shadow:0 20px 40px rgba(0,0,0,.15);

        }

        .stat-card::before{

            content:"";

            position:absolute;

            left:0;

            top:0;

            width:100%;

            height:6px;

        }

        .pelanggan::before{

            background:#0d6efd;

        }

        .tagihan::before{

            background:#ffc107;

        }

        .pengiriman::before{

            background:#0dcaf0;

        }

        .persentase::before{

            background:#198754;

        }

        .card-title-small{

            color:#6c757d;

            font-size:.9rem;

        }

        .stat-icon{

            width:68px;

            height:68px;

            border-radius:18px;

            display:flex;

            justify-content:center;

            align-items:center;

            color:white;

            font-size:28px;

        }

        /* ==========================
           PROGRESS
        ========================== */

        .progress-modern{

            height:14px;

            border-radius:50px;

            background:#e9ecef;

        }

        .progress-bar{

            border-radius:50px;

        }

        /* ==========================
           INFORMASI
        ========================== */

        .system-item{

            display:flex;

            align-items:center;

            gap:12px;

            padding:12px 0;

            border-bottom:1px solid #efefef;

        }

        .system-item:last-child{

            border-bottom:none;

        }

        .system-item i{

            font-size:22px;

        }

        /* ==========================
           ANIMASI
        ========================== */

        @keyframes float{

            0%{

                transform:translateY(0);

            }

            50%{

                transform:translateY(-12px);

            }

            100%{

                transform:translateY(0);

            }

        }

        /* ==========================
           RESPONSIVE
        ========================== */

        @media(max-width:992px){

            .welcome-banner{

                text-align:center;

            }

            .banner-image{

                margin-top:35px;

                width:180px;

            }

        }

    </style>

   <script>

function updateClock(){

    const now = new Date();

    const tanggal = now.toLocaleDateString("id-ID",{
        weekday:"long",
        day:"numeric",
        month:"long",
        year:"numeric"
    });

    const jam = now.toLocaleTimeString("id-ID",{
        hour:"2-digit",
        minute:"2-digit",
        second:"2-digit"
    });

    document.getElementById("tanggalBanner").innerHTML = tanggal;
    document.getElementById("jamBanner").innerHTML = jam;

}

updateClock();
setInterval(updateClock,1000);

</script>

</x-app-layout>