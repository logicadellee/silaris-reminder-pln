<nav class="sidebar">

    <div class="sidebar-header">

        <img src="{{ asset('images/pln.png') }}" class="logo-pln" alt="PLN">

        <h3>SILARIS</h3>

        <small>PT PLN (Persero)</small>

    </div>

    <div class="menu">

        <a href="{{ route('dashboard') }}"
           class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">
            <i class="bi bi-house-door"></i>
            Dashboard
        </a>

        <a href="{{ route('pelanggan.index') }}"
           class="{{ request()->routeIs('pelanggan.*') ? 'active' : '' }}">
            <i class="bi bi-people"></i>
            Master Pelanggan
        </a>

        <a href="{{ route('tagihan.index') }}"
           class="{{ request()->routeIs('tagihan.*') ? 'active' : '' }}">
            <i class="bi bi-file-earmark-text"></i>
            Tagihan
        </a>

        <a href="{{ route('riwayat.index') }}"
           class="{{ request()->routeIs('riwayat.*') ? 'active' : '' }}">
            <i class="bi bi-send"></i>
            Riwayat Pengiriman
        </a>

    </div>

    <form method="POST" action="{{ route('logout') }}" class="logout">
        @csrf

        <button type="submit">
            <i class="bi bi-box-arrow-right me-2"></i>
            Logout
        </button>
    </form>

    <div class="sidebar-bg"></div>

</nav>