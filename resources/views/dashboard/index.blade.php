<x-app-layout>

    <x-slot name="header">
        <div class="d-flex justify-content-between align-items-center">

            <div>

                <h3 class="fw-bold mb-0">
                    Dashboard SILARIS
                </h3>

                <small class="text-muted">
                    Sistem Reminder Tagihan PLN
                </small>

            </div>

            <div class="text-end">

                <div class="fw-semibold text-primary"
                    id="tanggalHari">
                </div>

                <small class="text-muted"
                    id="jamSekarang">
                </small>

            </div>

        </div>
    </x-slot>

    <div class="container-fluid py-4">

        {{-- CARD STATISTIK --}}

        <div class="row g-4">

            <div class="col-xl-4 col-md-6">

                <div class="card shadow border-0 rounded-4 h-100 dashboard-card">

                    <div class="card-body">

                        <div class="d-flex justify-content-between">

                            <div>

                                <small class="text-muted">
                                    Total Pelanggan
                                </small>

                                <h2 class="fw-bold mt-2">

                                    {{ number_format($totalPelanggan) }}

                                </h2>

                            </div>

                            <div class="icon-box bg-primary">

                                👥

                            </div>

                        </div>

                    </div>

                </div>

            </div>

            <div class="col-xl-4 col-md-6">

                <div class="card shadow border-0 rounded-4 h-100 dashboard-card">

                    <div class="card-body">

                        <div class="d-flex justify-content-between">

                            <div>

                                <small class="text-muted">
                                    Total Tagihan
                                </small>

                                <h2 class="fw-bold mt-2">

                                    {{ number_format($totalTagihan) }}

                                </h2>

                            </div>

                            <div class="icon-box bg-warning">

                                📄

                            </div>

                        </div>

                    </div>

                </div>

            </div>

            <div class="col-xl-4 col-md-6">

                <div class="card shadow border-0 rounded-4 h-100 dashboard-card">

                    <div class="card-body">

                        <div class="d-flex justify-content-between">

                            <div>

                                <small class="text-muted">
                                    Total Lunas
                                </small>

                                <h2 class="fw-bold text-success mt-2">

                                    {{ number_format($totalLunas) }}

                                </h2>

                            </div>

                            <div class="icon-box bg-success">

                                ✔

                            </div>

                        </div>

                    </div>

                </div>

            </div>

            <div class="col-xl-4 col-md-6">

                <div class="card shadow border-0 rounded-4 h-100 dashboard-card">

                    <div class="card-body">

                        <div class="d-flex justify-content-between">

                            <div>

                                <small class="text-muted">
                                    Belum Bayar
                                </small>

                                <h2 class="fw-bold text-danger mt-2">

                                    {{ number_format($totalBelumBayar) }}

                                </h2>

                            </div>

                            <div class="icon-box bg-danger">

                                !

                            </div>

                        </div>

                    </div>

                </div>

            </div>

            <div class="col-xl-4 col-md-6">

                <div class="card shadow border-0 rounded-4 h-100 dashboard-card">

                    <div class="card-body">

                        <small class="text-muted">

                            Persentase Lunas

                        </small>

                        <h2 class="fw-bold text-success mt-2">

                            {{ $persentaseLunas }}%

                        </h2>

                        <div class="progress mt-3">

                            <div
                                class="progress-bar bg-success"
                                style="width:{{ $persentaseLunas }}%">
                            </div>

                        </div>

                    </div>

                </div>

            </div>

            <div class="col-xl-4 col-md-6">

                <div class="card shadow border-0 rounded-4 h-100 dashboard-card">

                    <div class="card-body">

                        <div class="d-flex justify-content-between">

                            <div>

                                <small class="text-muted">

                                    Total Pengiriman

                                </small>

                                <h2 class="fw-bold text-info mt-2">

                                    {{ number_format($totalPengiriman) }}

                                </h2>

                            </div>

                            <div class="icon-box bg-info">

                                📨

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

        <div class="row mt-4">

            {{-- Grafik Donut --}}
        <div class="col-lg-4">

            <div class="card shadow border-0 rounded-4 h-100">

                <div class="card-header bg-white border-0">

                    <h5 class="fw-bold mb-0">
                        Statistik Pembayaran
                    </h5>

                </div>

                <div class="card-body">

                    <canvas id="donutChart" height="280"></canvas>

                </div>

            </div>

        </div>

        {{-- Tabel Tagihan --}}
        <div class="col-lg-8">

            <div class="card shadow border-0 rounded-4">

                <div class="card-header bg-white border-0 d-flex justify-content-between">

                    <h5 class="fw-bold mb-0">

                        5 Tagihan Jatuh Tempo Terdekat

                    </h5>

                    <span class="badge bg-danger">

                        {{ $tagihanTerdekat->count() }} Data

                    </span>

                </div>

                <div class="table-responsive">

                    <table class="table table-hover align-middle mb-0">

                        <thead class="table-light">

                        <tr>

                            <th>Nama Pelanggan</th>

                            <th>Periode</th>

                            <th>Jatuh Tempo</th>

                            <th>Status</th>

                        </tr>

                        </thead>

                        <tbody>

                        @forelse($tagihanTerdekat as $tagihan)

                            <tr>

                                <td>

                                    {{ $tagihan->pelanggan->nama }}

                                </td>

                                <td>

                                    {{ $tagihan->periode }}

                                </td>

                                <td>

                                    {{ $tagihan->jatuh_tempo->format('d M Y') }}

                                </td>

                                <td>

                                    <span class="badge bg-danger">

                                        Belum Bayar

                                    </span>

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td colspan="4"
                                    class="text-center text-muted">

                                    Tidak ada tagihan.

                                </td>

                            </tr>

                        @endforelse

                        </tbody>

                    </table>

                </div>

            </div>

        </div>

    </div>

    {{-- Baris kedua --}}

    <div class="row mt-4">
            {{-- Progress --}}
        <div class="col-lg-6">

            <div class="card shadow border-0 rounded-4 h-100">

                <div class="card-header bg-white border-0">

                    <h5 class="fw-bold mb-0">
                        Progress Pembayaran
                    </h5>

                </div>

                <div class="card-body">

                    <p class="mb-1">

                        Tagihan Lunas

                        <span class="float-end">

                            {{ $persentaseLunas }}%

                        </span>

                    </p>

                    <div class="progress mb-4" style="height:10px">

                        <div class="progress-bar bg-success"

                            style="width:{{ $persentaseLunas }}%">

                        </div>

                    </div>

                    <p class="mb-1">

                        Belum Bayar

                        <span class="float-end">

                            {{ 100-$persentaseLunas }}%

                        </span>

                    </p>

                    <div class="progress" style="height:10px">

                        <div class="progress-bar bg-danger"

                            style="width:{{ 100-$persentaseLunas }}%">

                        </div>

                    </div>

                </div>

            </div>

        </div>

        {{-- Informasi --}}
        <div class="col-lg-6">

            <div class="card shadow border-0 rounded-4 h-100">

                <div class="card-header bg-white border-0">

                    <h5 class="fw-bold mb-0">

                        Informasi Dashboard

                    </h5>

                </div>

                <div class="card-body">

                    <div class="alert alert-primary">

                        <strong>Total Pelanggan :</strong>

                        {{ number_format($totalPelanggan) }}

                    </div>

                    <div class="alert alert-warning">

                        <strong>Total Tagihan :</strong>

                        {{ number_format($totalTagihan) }}

                    </div>

                    <div class="alert alert-success">

                        <strong>Total Lunas :</strong>

                        {{ number_format($totalLunas) }}

                    </div>

                    <div class="alert alert-danger">

                        <strong>Belum Bayar :</strong>

                        {{ number_format($totalBelumBayar) }}

                    </div>

                </div>

            </div>

        </div>

    </div>

    <style>

    .dashboard-card{

    transition:.3s;

    }

    .dashboard-card:hover{

    transform:translateY(-6px);

    box-shadow:0 15px 35px rgba(0,0,0,.15)!important;

    }

    .icon-box{

    width:65px;

    height:65px;

    border-radius:50%;

    display:flex;

    justify-content:center;

    align-items:center;

    font-size:28px;

    color:white;

    }

    </style>

    <script>

    const donut=document.getElementById('donutChart');

    new Chart(donut,{

    type:'doughnut',

    data:{

    labels:['Lunas','Belum Bayar'],

    datasets:[{

    data:[

    {{ $totalLunas }},

    {{ $totalBelumBayar }}

    ],

    backgroundColor:[

    '#198754',

    '#dc3545'

    ]

    }]

    },

    options:{

    plugins:{

    legend:{

    position:'bottom'

    }

    }

    }

    });

    function updateClock(){

    const now=new Date();

    document.getElementById("tanggalHari").innerHTML=

    now.toLocaleDateString("id-ID",{

    weekday:'long',

    day:'numeric',

    month:'long',

    year:'numeric'

    });

    document.getElementById("jamSekarang").innerHTML=

    now.toLocaleTimeString("id-ID");

    }

    updateClock();

    setInterval(updateClock,1000);

    </script>

    </div>

    </x-app-layout>