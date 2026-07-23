<x-guest-layout>

    <x-auth-session-status class="alert alert-success mb-4" :status="session('status')" />

    <div>

        <h2 class="auth-title">
            Login Administrator
        </h2>

        <p class="auth-subtitle">
            Silakan login menggunakan akun administrator SILARIS.
        </p>

    </div>

    <form method="POST" action="{{ route('login') }}">

        @csrf

        {{-- EMAIL --}}
        <div class="mb-4">

            <label class="form-label fw-semibold">
                Email
            </label>

            <div class="input-group">

                <span class="input-group-text bg-white">
                    <i class="bi bi-envelope-fill text-primary"></i>
                </span>

                <input
                    type="email"
                    name="email"
                    id="email"
                    value="{{ old('email') }}"
                    class="form-control @error('email') is-invalid @enderror"
                    placeholder="Masukkan email"
                    required
                    autofocus>

            </div>

            @error('email')
                <small class="text-danger">
                    {{ $message }}
                </small>
            @enderror

        </div>

        {{-- PASSWORD --}}
        <div class="mb-4">

            <label class="form-label fw-semibold">
                Password
            </label>

            <div class="input-group">

                <span class="input-group-text bg-white">
                    <i class="bi bi-lock-fill text-warning"></i>
                </span>

                <input
                    type="password"
                    name="password"
                    id="password"
                    class="form-control @error('password') is-invalid @enderror"
                    placeholder="Masukkan password"
                    required>

                <button
                    type="button"
                    class="btn btn-outline-secondary"
                    id="togglePassword">

                    <i class="bi bi-eye" id="eyeIcon"></i>

                </button>

            </div>

            @error('password')
                <small class="text-danger">
                    {{ $message }}
                </small>
            @enderror

        </div>

        {{-- REMEMBER & FORGOT --}}
        <div class="d-flex justify-content-between align-items-center mb-4">

            <div class="form-check">

                <input
                    class="form-check-input"
                    type="checkbox"
                    name="remember"
                    id="remember">

                <label
                    class="form-check-label"
                    for="remember">

                    Remember Me

                </label>

            </div>

            @if (Route::has('password.request'))

                <a
                    href="{{ route('password.request') }}"
                    class="text-primary fw-semibold">

                    Lupa Password?

                </a>

            @endif

        </div>

        {{-- BUTTON --}}
        <button
            type="submit"
            class="btn btn-primary btn-login w-100">

            <i class="bi bi-box-arrow-in-right me-2"></i>

            Masuk

        </button>

    </form>

    <script>

        const password = document.getElementById("password");
        const toggle = document.getElementById("togglePassword");
        const eye = document.getElementById("eyeIcon");

        toggle.addEventListener("click", function(){

            if(password.type==="password"){

                password.type="text";

                eye.classList.remove("bi-eye");

                eye.classList.add("bi-eye-slash");

            }else{

                password.type="password";

                eye.classList.remove("bi-eye-slash");

                eye.classList.add("bi-eye");

            }

        });

    </script>

</x-guest-layout>