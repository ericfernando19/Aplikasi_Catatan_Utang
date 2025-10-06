@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-center align-items-center" style="min-height: 80vh;">
    <div class="card shadow-lg border-0 rounded-4" style="max-width: 400px; width: 100%;">
        <div class="card-body p-4">
            <h3 class="text-center mb-4 text-primary fw-bold">🔐 Login</h3>

            {{-- ✅ Status Session --}}
            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf

                {{-- Email --}}
                <div class="mb-3">
                    <label for="email" class="form-label fw-semibold">Email</label>
                    <input id="email" type="email" name="email"
                        class="form-control @error('email') is-invalid @enderror"
                        value="{{ old('email') }}" required autofocus>
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Password --}}
                <div class="mb-3">
                    <label for="password" class="form-label fw-semibold">Password</label>
                    <input id="password" type="password" name="password"
                        class="form-control @error('password') is-invalid @enderror"
                        required>
                    @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Remember Me --}}
                <div class="form-check mb-3">
                    <input id="remember_me" type="checkbox" class="form-check-input" name="remember">
                    <label for="remember_me" class="form-check-label">Ingat saya</label>
                </div>

                {{-- Forgot password + Login button --}}
                <div class="d-flex justify-content-between align-items-center">
                    @if (Route::has('password.request'))
                        <a class="text-decoration-none small text-muted"
                           href="{{ route('password.request') }}">
                            Lupa password?
                        </a>
                    @endif

                    <button type="submit" class="btn btn-primary px-4">
                        Login
                    </button>
                </div>
            </form>
        </div>

        {{-- <div class="card-footer text-center bg-light rounded-bottom-4">
            <small class="text-muted">
                Belum punya akun?
                <a href="{{ route('register') }}" class="text-decoration-none">Daftar</a>
            </small>
        </div> --}}
    </div>
</div>
@endsection
