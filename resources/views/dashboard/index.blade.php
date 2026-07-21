<x-app-layout>

    <x-slot name="header">
        <h4 class="fw-bold mb-0">
            Dashboard SILARIS
        </h4>
    </x-slot>

    <div class="container-fluid">

        {{-- Statistik --}}
        <div class="row g-4 mb-4">

            <div class="col-md-3">
                <div class="card shadow-sm border-0 rounded-4">
                    <div class="card-body">

                        <small class="text-muted">
                            Total Pelanggan
                        </small>

                        <h2 class="fw-bold text-primary mt-2">
                            0
                        </h2>

                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card shadow-sm border-0 rounded-4">
                    <div class="card-body">

                        <small class="text-muted">
                            Tagihan Belum Bayar
                        </small>

                        <h2 class="fw-bold text-danger mt-2">
                            0
                        </h2>

                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card shadow-sm border-0 rounded-4">
                    <div class="card-body">

                        <small class="text-muted">
                            Reminder Hari Ini
                        </small>

                        <h2 class="fw-bold text-warning mt-2">
                            0
                        </h2>

                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card shadow-sm border-0 rounded-4">
                    <div class="card-body">

                        <small class="text-muted">
                            Pengiriman Berhasil
                        </small>

                        <h2 class="fw-bold text-success mt-2">
                            0
                        </h2>

                    </div>
                </div>
            </div>

        </div>

        {{-- Chart --}}
        <div class="row">

            <div class="col-lg-8">

                <div class="card shadow-sm border-0 rounded-4">

                    <div class="card-header bg-white fw-semibold">

                        Grafik Reminder

                    </div>

                    <div class="card-body">

                        <canvas id="dashboardChart" height="120"></canvas>

                    </div>

                </div>

            </div>

            <div class="col-lg-4">

                <div class="card shadow-sm border-0 rounded-4">

                    <div class="card-header bg-white fw-semibold">

                        Informasi

                    </div>

                    <div class="card-body">

                        <ul class="list-group list-group-flush">

                            <li class="list-group-item">
                                Belum ada data.
                            </li>

                            <li class="list-group-item">
                                Import data tagihan terlebih dahulu.
                            </li>

                            <li class="list-group-item">
                                Reminder akan muncul di sini.
                            </li>

                        </ul>

                    </div>

                </div>

            </div>

        </div>

    </div>

    <script>

        const ctx = document.getElementById('dashboardChart');

        new Chart(ctx,{

            type:'line',

            data:{

                labels:[
                    'Sen',
                    'Sel',
                    'Rab',
                    'Kam',
                    'Jum',
                    'Sab',
                    'Min'
                ],

                datasets:[{

                    label:'Reminder',

                    data:[
                        0,
                        0,
                        0,
                        0,
                        0,
                        0,
                        0
                    ],

                    tension:0.4

                }]

            }

        });

    </script>

</x-app-layout>