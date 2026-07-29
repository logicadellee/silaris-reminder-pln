<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>SILARIS - PT PLN (Persero)</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --pln-blue: #0057B8;
            --pln-blue-dark: #003B7A;
            --pln-yellow: #FDB913;
            --text-dark: #1a1a1a;
            --text-gray: #5a6472;
        }

        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: 'Poppins', 'Segoe UI', Arial, sans-serif;
            background: #fff;
            overflow-x: hidden;
        }

        /* NAVBAR */
        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 22px 60px;
            background: #fff;
        }
        .navbar-brand {
            display: flex;
            align-items: center;
            gap: 10px;
            font-weight: 800;
            font-size: 19px;
            color: var(--pln-blue);
        }
        .navbar-brand img { height: 30px; }

        .btn {
            padding: 12px 26px;
            border-radius: 8px;
            font-weight: 600;
            font-size: 14px;
            text-decoration: none;
            transition: all 0.2s ease;
            display: inline-block;
            border: none;
            cursor: pointer;
        }
        .btn-primary {
            background: var(--pln-blue);
            color: #fff;
        }
        .btn-primary:hover { background: var(--pln-blue-dark); }

        /* HERO */
        .hero {
            display: flex;
            max-width: 1160px;
            margin: 30px auto 80px auto;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 20px 50px rgba(0,59,122,0.12);
            min-height: 520px;
        }

        .hero-panel {
            flex: 1;
            min-width: 300px;
            background: var(--pln-blue);
            position: relative;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
            padding: 60px 40px;
            overflow: hidden;
        }

        .hero-panel .circle {
            position: absolute;
            border-radius: 50%;
            background: rgba(255,255,255,0.06);
        }
        .circle-1 { width: 260px; height: 260px; top: -60px; left: -80px; animation: float1 9s ease-in-out infinite; }
        .circle-2 { width: 180px; height: 180px; bottom: -50px; right: -40px; animation: float2 11s ease-in-out infinite; }
        .circle-3 { width: 90px; height: 90px; bottom: 40px; left: 20px; background: rgba(255,199,44,0.15); animation: float1 7s ease-in-out infinite; }

        @keyframes float1 {
            0%, 100% { transform: translate(0, 0); }
            50% { transform: translate(14px, 18px); }
        }
        @keyframes float2 {
            0%, 100% { transform: translate(0, 0); }
            50% { transform: translate(-16px, -12px); }
        }

        .hero-panel img.logo {
            width: 76px;
            margin-bottom: 20px;
            position: relative;
            z-index: 1;
        }
        .hero-panel h2 {
            color: #fff;
            font-size: 30px;
            font-weight: 800;
            letter-spacing: 1px;
            margin-bottom: 10px;
            position: relative;
            z-index: 1;
        }
        .hero-panel p {
            color: #cfe0f5;
            font-size: 14.5px;
            line-height: 1.7;
            max-width: 280px;
            position: relative;
            z-index: 1;
        }

        .hero-content {
            flex: 1.3;
            min-width: 340px;
            background: #fff;
            padding: 70px 56px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .badge {
            display: inline-block;
            width: fit-content;
            background: #EAF2FC;
            color: var(--pln-blue);
            font-weight: 700;
            font-size: 12px;
            letter-spacing: 1px;
            padding: 6px 14px;
            border-radius: 20px;
            margin-bottom: 22px;
            opacity: 0;
            animation: fadeInUp 0.6s ease forwards;
        }

        .hero-content h1 {
            font-size: 34px;
            font-weight: 800;
            line-height: 1.3;
            color: var(--text-dark);
            margin-bottom: 18px;
            opacity: 0;
            animation: fadeInUp 0.6s ease 0.12s forwards;
        }

        .hero-content h1 span { color: var(--pln-blue); }

        .hero-content p {
            color: var(--text-gray);
            font-size: 15px;
            line-height: 1.75;
            margin-bottom: 32px;
            max-width: 460px;
            opacity: 0;
            animation: fadeInUp 0.6s ease 0.24s forwards;
        }

        .hero-buttons {
            display: flex;
            gap: 12px;
            opacity: 0;
            animation: fadeInUp 0.6s ease 0.36s forwards;
        }

        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(18px); }
            to { opacity: 1; transform: translateY(0); }
        }

        /* SECTION SHARED */
        .section {
            max-width: 1160px;
            margin: 0 auto;
            padding: 0 40px 90px 40px;
        }

        .section-head {
            text-align: center;
            max-width: 560px;
            margin: 0 auto 56px auto;
            opacity: 0;
            transform: translateY(20px);
            transition: all 0.5s ease;
        }
        .section-head.show { opacity: 1; transform: translateY(0); }

        .section-head span {
            color: var(--pln-blue);
            font-weight: 700;
            font-size: 12px;
            letter-spacing: 1px;
        }
        .section-head h2 {
            font-size: 26px;
            font-weight: 800;
            color: var(--text-dark);
            margin: 8px 0 10px 0;
        }
        .section-head p {
            color: var(--text-gray);
            font-size: 14.5px;
            line-height: 1.7;
        }

        /* MENGAPA SILARIS - 3 KEUNGGULAN */
        .benefits {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 28px;
        }
        .benefit-card {
            background: #F7FAFE;
            border: 1px solid #E7EFFA;
            border-radius: 16px;
            padding: 34px 28px;
            opacity: 0;
            transform: translateY(20px);
            transition: all 0.5s ease;
        }
        .benefit-card.show { opacity: 1; transform: translateY(0); }
        .benefit-icon {
            width: 52px;
            height: 52px;
            border-radius: 14px;
            background: var(--pln-blue);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 22px;
            margin-bottom: 20px;
            box-shadow: 0 10px 20px rgba(0,87,184,0.2);
        }
        .benefit-card h3 {
            font-size: 16.5px;
            font-weight: 700;
            color: var(--text-dark);
            margin-bottom: 8px;
        }
        .benefit-card p {
            font-size: 13.5px;
            color: var(--text-gray);
            line-height: 1.65;
        }

        /* FITUR UTAMA - 4 KARTU */
        .features {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 20px;
        }
        .feature-card {
            padding: 26px 22px;
            border-radius: 14px;
            border: 1px solid #EAEFF5;
            opacity: 0;
            transform: translateY(20px);
            transition: all 0.5s ease;
        }
        .feature-card.show { opacity: 1; transform: translateY(0); }
        .feature-card .dot {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background: var(--pln-yellow);
            margin-bottom: 16px;
        }
        .feature-card h3 {
            font-size: 15px;
            font-weight: 700;
            color: var(--text-dark);
            margin-bottom: 8px;
        }
        .feature-card p {
            font-size: 13px;
            color: var(--text-gray);
            line-height: 1.6;
        }

        /* ALUR PENGGUNAAN */
        .flow {
            display: flex;
            align-items: flex-start;
            gap: 0;
            position: relative;
        }

        .flow-step {
            flex: 1;
            text-align: center;
            padding: 0 16px;
            position: relative;
            opacity: 0;
            transform: translateY(20px);
        }
        .flow-step.show { opacity: 1; transform: translateY(0); }

        .flow-step::after {
            content: "";
            position: absolute;
            top: 28px;
            right: -8%;
            width: 16%;
            height: 2px;
            background: repeating-linear-gradient(90deg, #cfe0f5 0, #cfe0f5 6px, transparent 6px, transparent 12px);
        }
        .flow-step:last-child::after { display: none; }

        .flow-number {
            width: 56px;
            height: 56px;
            border-radius: 50%;
            background: var(--pln-blue);
            color: #fff;
            font-weight: 800;
            font-size: 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 18px auto;
            position: relative;
            z-index: 1;
            box-shadow: 0 10px 20px rgba(0,87,184,0.25);
        }

        .flow-step h3 {
            font-size: 15px;
            font-weight: 700;
            color: var(--text-dark);
            margin-bottom: 6px;
        }
        .flow-step p {
            font-size: 13px;
            color: var(--text-gray);
            line-height: 1.6;
            max-width: 200px;
            margin: 0 auto;
        }

        
        .cta {
            max-width: 1160px;
            margin: 0 auto 90px auto;
            padding: 0 40px;
        }
        .cta-inner {
            background: var(--pln-blue);
            border-radius: 20px;
            padding: 56px 60px;
            text-align: center;
            opacity: 0;
            transform: translateY(20px);
            transition: all 0.5s ease;
        }
        .cta-inner.show { opacity: 1; transform: translateY(0); }
        .cta-inner h2 {
            color: #fff;
            font-size: 24px;
            font-weight: 800;
            margin-bottom: 14px;
            max-width: 640px;
            margin-left: auto;
            margin-right: auto;
        }
        .cta-inner p {
            color: #cfe0f5;
            font-size: 14.5px;
            line-height: 1.75;
            max-width: 560px;
            margin: 0 auto;
        }

        footer {
            background: var(--pln-blue-dark);
            color: #cdd8ee;
            padding: 32px 60px;
            text-align: center;
            font-size: 12.5px;
        }
        footer strong { color: #fff; }

        @media (max-width: 900px) {
            .hero { flex-direction: column; margin: 0; border-radius: 0; }
            .hero-panel { padding: 40px 30px; min-height: 220px; }
            .benefits { grid-template-columns: 1fr; }
            .features { grid-template-columns: repeat(2, 1fr); }
            .flow { flex-direction: column; gap: 36px; }
            .flow-step::after { display: none; }
        }
        @media (max-width: 600px) {
            .navbar { padding: 16px 24px; }
            .hero-content { padding: 44px 26px; }
            .hero-content h1 { font-size: 26px; }
            .section { padding: 0 20px 60px 20px; }
            .features { grid-template-columns: 1fr; }
            .cta-inner { padding: 40px 28px; }
        }
    </style>
</head>
<body>

    <nav class="navbar">
        <div class="navbar-brand">
            <img src="{{ asset('images/pln.png') }}" alt="PLN">
            SILARIS
        </div>
        <a href="{{ route('login') }}" class="btn btn-primary">Masuk</a>
    </nav>

    <!-- HERO -->
    <section class="hero">
        <div class="hero-content">
            <span class="badge">PT PLN (PERSERO) ULP WAY HALIM</span>
            <h1>Permudah Pengelolaan <span>Tagihan Listrik</span> dalam Satu Sistem</h1>
            <p>SILARIS merupakan sistem informasi yang membantu petugas PT PLN (Persero) ULP Way Halim dalam mengelola data pelanggan, memantau tagihan, serta menyampaikan informasi pembayaran secara lebih terstruktur, cepat, dan efisien.</p>
            <div class="hero-buttons">
                <a href="{{ route('login') }}" class="btn btn-primary">Masuk ke Sistem</a>
            </div>
        </div>

        <div class="hero-panel">
            <div class="circle circle-1"></div>
            <div class="circle circle-2"></div>
            <div class="circle circle-3"></div>
            <img class="logo" src="{{ asset('images/pln.png') }}" alt="PLN">
            <h2>SILARIS</h2>
            <p>PT PLN (Persero)<br>ULP Way Halim</p>
        </div>
    </section>

    <!-- MENGAPA SILARIS -->
    <section class="section">
        <div class="section-head reveal">
            <span>MENGAPA SILARIS</span>
            <h2>Dibangun untuk Pekerjaan Petugas Sehari-hari</h2>
            <p>Bukan sekadar aplikasi pencatat, tapi sistem yang bikin proses pemantauan tagihan lebih ringan.</p>
        </div>
        <div class="benefits">
            <div class="benefit-card reveal">
                <div class="benefit-icon">📂</div>
                <h3>Pengelolaan Data Terpusat</h3>
                <p>Seluruh data pelanggan dan tagihan tersimpan dalam satu sistem sehingga lebih mudah dikelola.</p>
            </div>
            <div class="benefit-card reveal">
                <div class="benefit-icon">📊</div>
                <h3>Monitoring Lebih Efisien</h3>
                <p>Petugas dapat memantau kondisi tagihan dan aktivitas pengiriman melalui dashboard secara real-time.</p>
            </div>
            <div class="benefit-card reveal">
                <div class="benefit-icon">⚡</div>
                <h3>Proses Kerja Lebih Cepat</h3>
                <p>Mengurangi pekerjaan manual sehingga proses pengelolaan tagihan menjadi lebih efektif dan konsisten.</p>
            </div>
        </div>
    </section>

    <!-- FITUR UTAMA -->
    <section class="section">
        <div class="section-head reveal">
            <span>FITUR UTAMA</span>
            <h2>Semua yang Dibutuhkan Petugas, dalam Satu Tempat</h2>
            <p>Empat modul yang menopang alur kerja harian, dari data pelanggan sampai riwayat pengiriman.</p>
        </div>
        <div class="features">
            <div class="feature-card reveal">
                <div class="dot"></div>
                <h3>Dashboard</h3>
                <p>Menampilkan ringkasan informasi pelanggan dan aktivitas sistem.</p>
            </div>
            <div class="feature-card reveal">
                <div class="dot"></div>
                <h3>Master Pelanggan</h3>
                <p>Mengelola data pelanggan melalui proses impor maupun pengelolaan data secara langsung.</p>
            </div>
            <div class="feature-card reveal">
                <div class="dot"></div>
                <h3>Tagihan</h3>
                <p>Memantau data tagihan aktif serta mempersiapkan proses pengiriman reminder.</p>
            </div>
            <div class="feature-card reveal">
                <div class="dot"></div>
                <h3>Riwayat Pengiriman</h3>
                <p>Menampilkan histori aktivitas pengiriman sebagai bahan monitoring dan evaluasi.</p>
            </div>
        </div>
    </section>

    <!-- ALUR PENGGUNAAN -->
    <section class="section">
        <div class="section-head reveal">
            <span>ALUR PENGGUNAAN</span>
            <h2>Empat Langkah, Satu Alur Kerja</h2>
            <p>Dari data pelanggan sampai laporan pengiriman, semuanya tersambung dalam satu sistem.</p>
        </div>
        <div class="flow">
            <div class="flow-step reveal">
                <div class="flow-number">1</div>
                <h3>Kelola Data</h3>
                <p>Input dan kelola data pelanggan — ID, tarif, daya, nomor WhatsApp.</p>
            </div>
            <div class="flow-step reveal">
                <div class="flow-number">2</div>
                <h3>Pantau Tagihan</h3>
                <p>Sistem menampilkan status tagihan yang mendekati atau lewat jatuh tempo.</p>
            </div>
            <div class="flow-step reveal">
                <div class="flow-number">3</div>
                <h3>Kirim Reminder</h3>
                <p>Pesan pengingat dikirim ke WhatsApp pelanggan secara terjadwal.</p>
            </div>
            <div class="flow-step reveal">
                <div class="flow-number">4</div>
                <h3>Monitoring</h3>
                <p>Riwayat pengiriman tercatat lengkap sebagai bahan evaluasi petugas.</p>
            </div>
        </div>
    </section>

    <!-- CTA PENUTUP -->
    <section class="cta">
        <div class="cta-inner reveal">
            <h2>Dirancang untuk Mendukung Operasional PT PLN (Persero) ULP Way Halim</h2>
            <p>SILARIS hadir sebagai solusi digital yang membantu proses pengelolaan pelanggan dan penyampaian informasi tagihan secara lebih efektif, sehingga pekerjaan petugas menjadi lebih mudah, terstruktur, dan efisien.</p>
        </div>
    </section>

    <footer>
        <strong> Sistem Reminder Pembayaran Tagihan Listrik<br>
        PT PLN (Persero) ULP Way Halim &copy; 2026
    </footer>

    <script>
        const observer = new IntersectionObserver((entries) => {
            entries.forEach((entry, i) => {
                if (entry.isIntersecting) {
                    setTimeout(() => entry.target.classList.add('show'), i * 80);
                    observer.unobserve(entry.target);
                }
            });
        }, { threshold: 0.15 });

        document.querySelectorAll('.reveal').forEach(el => observer.observe(el));
    </script>

</body>
</html>