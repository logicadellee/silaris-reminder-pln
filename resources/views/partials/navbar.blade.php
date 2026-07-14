<nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom shadow-sm">
    <div class="container-fluid px-4 py-2">
        <div class="d-flex align-items-center gap-3">
            <button
                class="btn btn-outline-secondary rounded-circle d-flex align-items-center justify-content-center p-2"
                type="button"
                aria-label="Toggle sidebar"
            >
                <i class="bi bi-list fs-5"></i>
            </button>

            <div>
                <h1 class="h5 mb-0 text-dark fw-semibold">
                    @yield('title', 'Dashboard')
                </h1>
            </div>
        </div>

        <div class="ms-auto d-flex align-items-center gap-3">
            <span class="text-muted small fw-semibold d-none d-md-inline">
                {{ now()->translatedFormat('l, d F Y') }}
            </span>

            @auth
                <span class="text-dark fw-semibold d-none d-lg-inline">
                    {{ Auth::user()->name }}
                </span>
            @endauth

            <div class="dropdown">
                <button
                    class="btn btn-outline-secondary dropdown-toggle d-flex align-items-center gap-2"
                    type="button"
                    data-bs-toggle="dropdown"
                    aria-expanded="false"
                >
                    <i class="bi bi-person-circle fs-5"></i>
                </button>

                <ul class="dropdown-menu dropdown-menu-end shadow-sm border-0">
                    <li>
                        <a class="dropdown-item" href="{{ route('profile.edit') }}">
                            <i class="bi bi-person me-2"></i>
                            Profil
                        </a>
                    </li>
                    <li>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="dropdown-item">
                                <i class="bi bi-box-arrow-right me-2"></i>
                                Logout
                            </button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>
