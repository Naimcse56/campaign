@extends('layouts.auth_layout')

@section('content')
<div class="container-fluid">
    <div class="authentication-card">
        <div class="card shadow rounded-0 overflow-hidden">
            <div class="row g-0">
                <div class="col-lg-6 bg-login d-flex align-items-center justify-content-center">
                    <img src="{{ asset('images/error/login-img.jpg') }}" class="img-fluid" alt="">
                </div>
                <div class="col-lg-6">
                    <div class="card-body p-4 p-sm-5">
                        <form class="form-body" method="POST" action="{{ route('login') }}">
                            @csrf
                            <div class="login-separater text-center mb-4"> <span class="text-primary fw-bold">SIGN IN WITH EMAIL</span>
                                <hr>
                            </div>
                            <div class="row g-3">
                                <div class="col-12">
                                    <label for="email" class="form-label">Email Address</label>
                                    <div class="ms-auto position-relative">
                                        <div class="position-absolute top-50 translate-middle-y search-icon px-3"><i class="bi bi-envelope-fill"></i></div>
                                        <input type="email" class="form-control radius-30 ps-5 @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Email Address">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <label for="password" class="form-label">Enter Password</label>
                                    <div class="ms-auto position-relative">
                                        <div class="position-absolute top-50 translate-middle-y search-icon px-3"><i class="bi bi-lock-fill"></i></div>
                                        <input type="password" class="form-control radius-30 ps-5 @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" id="password" placeholder="Enter Password">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" id="remember" name="remember" {{ old('remember') ? 'checked' : '' }}>
                                        <label class="form-check-label" for="remember">Remember Me</label>
                                    </div>
                                </div>
                                <div class="col-6 text-end">
                                    <a href="{{ route('password.request') }}">Forgot Password ?</a>
                                </div>
                                <div class="col-12">
                                    <div class="d-grid">
                                        <button type="submit" class="btn btn-primary radius-30">Sign In</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
