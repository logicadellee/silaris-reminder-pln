<nav class="d-flex flex-column h-100 bg-white border-end px-3 py-4">
    <div class="d-flex align-items-center gap-3 pb-3 border-bottom">
        <div class="sidebar-brand-badge rounded-circle bg-primary-subtle d-flex align-items-center justify-content-center">
            <i class="bi bi-lightning-charge-fill text-primary fs-4"></i>
        </div>
        <div>
            <div class="fw-bold text-primary text-uppercase small">SILARIS</div>
            <div class="small text-muted">PT PLN (Persero)</div>
        </div>
    </div>

    <div class="nav flex-column gap-2 mt-4">
        <a href="{{ route('dashboard') }}" class="nav-link rounded-3 px-3 py-2 d-flex align-items-center gap-3 text-dark fw-semibold">
            <i class="bi bi-grid-1x2-fill text-primary"></i>
            <span>Dashboard</span>
        </a>

        <a href="{{ route('pelanggan.index') }}" class="nav-link rounded-3 px-3 py-2 d-flex align-items-center gap-3 text-dark fw-semibold">
            <i class="bi bi-people-fill text-primary"></i>
            <span>Master Pelanggan</span>
        </a>

        <a href="{{ route('tagihan.index') }}" class="nav-link rounded-3 px-3 py-2 d-flex align-items-center gap-3 text-dark fw-semibold">
            <i class="bi bi-receipt-cutoff text-primary"></i>
            <span>Tagihan</span>
        </a>

        <a href="{{ route('riwayat.index') }}" class="nav-link rounded-3 px-3 py-2 d-flex align-items-center gap-3 text-dark fw-semibold">
            <i class="bi bi-send-check-fill text-primary"></i>
            <span>Riwayat Pengiriman</span>
        </a>
    </div>

    <div class="mt-auto pt-4 border-top">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="btn btn-outline-danger w-100 d-flex align-items-center justify-content-center gap-2">
                <i class="bi bi-box-arrow-right"></i>
                <span>Logout</span>
            </button>
        </form>
    </div>
</nav>
