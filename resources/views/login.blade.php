@extends('layouts.main')

@section('title', 'Masuk')

@section('content')
<div class="container">
    <div class="row mt-5">
        <div class="col-md-6 col-lg-5">
            @if (session('status'))
            @if (session('status') == 'success')
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('message') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @else
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('message') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            @endif

            <div class="card mt-4 mb-4" style="height: auto;">
                <div class="card-body">
                    <form action="{{ route('login') }}" method="post">
                        @csrf
                        <div class="mb-3">
                            <label for="usename" class="form-label fw-bold mt-2">Nama Pengguna</label>
                            <div class="input-group">
                                <span class="input-group-text">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="grey" class="bi bi-person" viewBox="0 0 16 16">
                                        <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6Zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0Zm4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4Zm-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10Z"/>
                                      </svg>
                                </span>
                                <input type="text" name="username" id="username" class="form-control @error ('username') is-invalid @enderror" value="{{ old('username') }}">
                                @error('username')
                                <div class="invalid-feedback fw-bold">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="mb-4">
                            <label for="password" class="form-label fw-bold">Password</label>
                            <div class="input-group">
                                <span class="input-group-text">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="grey" class="bi bi-lock" viewBox="0 0 16 16">
                                        <path d="M8 1a2 2 0 0 1 2 2v4H6V3a2 2 0 0 1 2-2zm3 6V3a3 3 0 0 0-6 0v4a2 2 0 0 0-2 2v5a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2zM5 8h6a1 1 0 0 1 1 1v5a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1V9a1 1 0 0 1 1-1z"/>
                                      </svg>
                                </span>
                                <input type="password" name="password" id="password" class="form-control @error ('password') is-invalid @enderror" name="password">
                                <button class="btn btn-outline-secondary" type="button" id="showPassword">
                                    <i class="bi bi-eye"></i>
                                </button>
                                @error('password')
                                <div class="invalid-feedback fw-bold">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="mb-3">
                            <button type="submit" class="btn btn-primary fw-bold w-25" style="margin-right: 11rem;" >Masuk</button>
                            <a href="forgot-password" class="text-decoration-none text-secondary">Lupa Password ?</a>
                        </div>
                        <div class="link text-center">
                            <h1 class="mb-3 fs-6 text-secondary"> Belum Punya Akun <h1>
                            <a href="register" class="btn btn-success" >Buat Akun</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    const passwordInput = document.getElementById('password');
    const showPasswordButton = document.getElementById('showPassword');

    showPasswordButton.addEventListener('click', function() {
        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            showPasswordButton.innerHTML = '<i class="bi bi-eye-slash"></i>';
        } else {
            passwordInput.type = 'password';
            showPasswordButton.innerHTML = '<i class="bi bi-eye"></i>';
        }
    });
</script>
@endsection