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
            position:absolute;
            top:0;
            left:0;
            width:100%;
            z-index:999;
            padding:24px 60px;
            background:transparent;
            animation:logoFade 1s forwards;
        }
        .navbar-brand {
            display: flex;
            align-items: center;
            gap: 10px;
            font-weight: 800;
            font-size: 19px;
            color: var(--pln-blue);
        }
        .navbar-brand img { height: 24px; }

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
        .hero{
            position:relative;
            width:100%;
            height:92vh;
            min-height:680px;

            background:url("{{ asset('images/pln-worker.jpg') }}") center center/cover no-repeat;

            display:flex;
            align-items:center;
        }

        .hero::before{
            content:"";
            position:absolute;
            inset:0;

            background:
            linear-gradient(
                90deg,
                rgba(0,42,92,.90) 0%,
                rgba(0,62,125,.72) 45%,
                rgba(0,87,184,.35) 100%
            );
        }

        .hero-container{
            width:1100px;
            max-width:86%;
            margin:auto;

            position:relative;
            z-index:2;
        }

        .logo{
            display:flex;
            align-items:center;
            gap:14px;

            margin-bottom:70px;
        }

        .logo img{
            width:48px;
        }

        .logo span{
            color:white;
            font-size:34px;
            font-weight:800;
            letter-spacing:.5px;
        }

        .hero-content{
            max-width:620px;
        }

        .hero-badge{

            display:inline-block;

            padding:10px 20px;

            border-radius:40px;

            background:rgba(255,255,255,.12);

            color:white;

            font-size:13px;

            font-weight:600;

            backdrop-filter:blur(8px);

            margin-bottom:28px;

        }

        .hero h1{

            color:white;

            font-size:clamp(40px,4vw,54px);

            font-weight:800;

            line-height:1.15;

            margin-bottom:24px;

        }

        .hero h1 span{

            color:#FDB913;

        }

        .hero p{

            color:rgba(255,255,255,.90);

            font-size:16px;

            line-height:1.8;

            max-width:500px;

            margin-bottom:42px;

        }

        .btn-login{
            display:inline-flex;
            align-items:center;
            justify-content:center;
            padding:15px 34px;
            background:#FDB913;
            color:#003B7A;
            border-radius:50px;
            font-size:15px;
            font-weight:700;
            text-decoration:none;
            transition:.35s;
            position:relative;
            overflow:hidden;
        }

        .btn-login::before{

            content:"";

            position:absolute;

            top:0;
            left:-120%;

            width:100%;
            height:100%;

            background:

            linear-gradient(
            90deg,
            transparent,
            rgba(255,255,255,.5),
            transparent
            );

            transition:.7s;

        }

.btn-login:hover::before{

    left:120%;

}

        .btn-login:hover{

            transform:translateY(-4px);

            background:white;

            color:#0057B8;

            box-shadow:0 20px 40px rgba(0,0,0,.2);

        }

        .scroll-indicator{

            position:absolute;

            bottom:40px;

            left:50%;

            transform:translateX(-50%);

            color:white;

            font-size:13px;

            letter-spacing:3px;

            text-transform:uppercase;

            opacity:.8;

            animation:updown 2s infinite;

        }

        @keyframes updown{

            0%{transform:translate(-50%,0);}

            50%{transform:translate(-50%,10px);}

            100%{transform:translate(-50%,0);}

        }

        /* SECTION SHARED */
        .section {
            max-width:1200px;
            margin:auto;
            padding:90px 30px;
        }

        .features{
            display:grid;
            grid-template-columns:repeat(4,1fr);
            gap:30px;
            margin-top:70px;
        }

        .feature-card{

            background:#fff;

            border-radius:20px;

            padding:28px;

            box-shadow:0 15px 40px rgba(0,0,0,.08);

            transition:.35s;

            border:1px solid #edf2f8;

            opacity:0;

            transform:translateY(50px);

            transition:.7s;

        }

        .feature-card.show{

            opacity:1;

            transform:translateY(0);

        }

        .feature-card:hover{

            transform:translateY(-10px);

            box-shadow:0 25px 50px rgba(0,0,0,.12);

        }

        .section-head {
            text-align: center;
            max-width:720px;
            margin:0 auto 70px;
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
            font-size:40px;
            font-weight:800;
            margin:15px 0;
        }
        .section-head p {
            font-size:18px;
            color:#666;
            line-height:1.9;
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

        @media(max-width:992px){

            .features{

            grid-template-columns:repeat(2,1fr);

            }

            .hero h1{

            font-size:48px;

            text-shadow:

            0 6px 30px rgba(0,0,0,.35);

            }

            }

            @media(max-width:768px){

            .features{

            grid-template-columns:1fr;

            }

            .hero{

            height:auto;

            padding:160px 0 100px;

            animation:

            heroZoom 2s ease forwards,

            heroFloat 12s ease infinite alternate;

            }

            .hero h1{

            font-size:38px;

            }

            .hero p{

            font-size:16px;

            }

            }

        .dot{

            width:14px;

            height:14px;

            border-radius:50%;

            background:#FDB913;

            margin-bottom:20px;

        }

    .hero{
    overflow:hidden;
}

.hero::after{
    content:"";
    position:absolute;
    inset:0;

    background:inherit;
    z-index:-1;
}

.hero{

    animation:heroZoom 2.2s ease forwards;

}

.hero-content>*{

    opacity:0;

}

.hero-badge{

    animation:fadeUp .8s .3s forwards;

}

.hero h1{

    animation:fadeUp .8s .55s forwards;

}

.hero p{

    animation:fadeUp .8s .8s forwards;

}

.btn-login{

    opacity:0;

    animation:fadeUp .8s 1.05s forwards;

}

.scroll-indicator{

    opacity:0;

    animation:fadeIn 1s 1.4s forwards;

}

@keyframes heroZoom{

    from{

        transform:scale(1.08);

    }

    to{

        transform:scale(1);

    }

}

@keyframes fadeUp{

    from{

        opacity:0;

        transform:translateY(40px);

    }

    to{

        opacity:1;

        transform:translateY(0);

    }

}

@keyframes fadeIn{

    from{

        opacity:0;

    }

    to{

        opacity:.8;

    }

}

@keyframes logoFade{

    from{

        opacity:0;

        transform:translateY(-20px);

    }

    to{

        opacity:1;

        transform:translateY(0);

    }

}

@keyframes heroFloat{

    from{

        background-position:center center;

    }

    to{

        background-position:center top;

    }

}
    </style>
</head>
<body>

    <nav class="navbar">
        <div class="navbar-brand">
            <img src="{{ asset('images/pln.png') }}" alt="PLN">
        </div>
    </nav>

    <!-- HERO -->
    <section class="hero">

        <div class="hero-container">

            <div class="hero-content">

                <div class="hero-badge">

                    PT PLN (Persero) ULP Way Halim

                </div>

                <h1>

                    Sistem Reminder

                    <br>

                    <span>Pembayaran</span>

                    Tagihan Listrik

                </h1>

                <p>

                    Solusi digital untuk membantu petugas
                    PT PLN (Persero) ULP Way Halim dalam
                    mengelola data pelanggan, memonitor tagihan,
                    serta mengirim reminder pembayaran melalui
                    WhatsApp secara cepat, terstruktur,
                    dan efisien.

                </p>

                <a href="{{ route('login') }}" class="btn-login">

                    Masuk ke Sistem

                </a>

            </div>

        </div>

    </section>

    <section class="section">

        <div class="section-head reveal">

            <span>TENTANG SILARIS</span>

            <h2>
                Solusi Digital untuk PT PLN (Persero)
            </h2>

            <p>

                SILARIS membantu petugas
                dalam mengelola data pelanggan,
                data tagihan listrik,
                serta pengiriman reminder WhatsApp
                dalam satu sistem yang terintegrasi.

            </p>

        </div>

        <div class="features">

            <div class="feature-card">

                <div class="dot"></div>

                <h3>👥 Master Pelanggan</h3>

                <p>
                    Mengelola seluruh data pelanggan PLN.
                </p>

            </div>

            <div class="feature-card">

                <div class="dot"></div>

                <h3>📄 Tagihan</h3>

                <p>
                    Monitoring tagihan setiap periode.
                </p>

            </div>

            <div class="feature-card">

                <div class="dot"></div>

                <h3>💬 Reminder</h3>

                <p>
                    Mengirim reminder pembayaran melalui WhatsApp.
                </p>

            </div>

            <div class="feature-card">

                <div class="dot"></div>

                <h3>📊 Riwayat</h3>

                <p>
                    Melihat seluruh histori pengiriman reminder.
                </p>

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

            if(entry.isIntersecting){

                setTimeout(() => {
                    entry.target.classList.add("show");
                }, i * 120);

                observer.unobserve(entry.target);

            }

        });

    }, {
        threshold:0.15
    });

    document.querySelectorAll(".reveal").forEach(el=>{
        observer.observe(el);
    });

    document.querySelectorAll(".feature-card").forEach(card=>{
        observer.observe(card);
    });

    document.querySelectorAll(".section-head").forEach(head=>{
        observer.observe(head);
    });

    document.querySelectorAll(".benefit-card").forEach(card=>{
        observer.observe(card);
    });

    document.querySelectorAll(".cta-inner").forEach(cta=>{
        observer.observe(cta);
    });
    </script>

</body>
</html>