<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Perpustakaan | Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" 
    rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" 
    crossorigin="anonymous">
    <link rel="stylesheet" href="{{asset('css/login.css')}}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <link rel="icon" type="image/x-icon" href="{{asset('images/sma.png') }}">
</head>
<body class="main">
    <div class="background-image" style="background-image: url('{{ asset('images/bg.png') }}');"></div>
    <div class="container">
        <div class="row justify-content-center mt-5">
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

                <div class="card mt-4">
                    <div class="card-body">
                        <div class="text-center mb-4">
                            <img src="{{asset('images/sma.png') }}" class="card-img-top" style="max-width: 100px; max-height: 150px;" draggable="false">
                        </div>
                        <h3 class="text-center mb-3">Masukkan Kata Sandi Baru</h3 class="text-center mb-3">
                        <form action="{{ route('password.update', ['token' => $token]) }}" method="POST">
                            @csrf
                            <div>
                                <input type="hidden" name="token" value="{{ request()->token }}">
                                <input type="hidden" name="email" value="{{ request()->email }}">
                                <div class="mb-3">
                                    <label for="password" class="form-label fw-bold">Password</label>
                                    <div class="input-group">
                                        <input id="password" type="password" class="form-control @error ('password') is-invalid @enderror" name="password" value="{{ old('password') }}">
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
                                <div class="mb-4">
                                    <label for="password_confirm" class="form-label fw-bold">Konfirmasi Password</label>
                                    <div class="input-group">
                                        <input id="password_confirm" type="password" class="form-control @error('password_confirm') is-invalid @enderror" name="password_confirm">
                                        <button class="btn btn-outline-secondary" type="button" id="showPasswordConfirm">
                                            <i class="bi bi-eye"></i>
                                        </button>
                                        @error('password_confirm')
                                        <div class="invalid-feedback fw-bold">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <input type="submit" value="Reset Password" class="btn btn-primary mt-3 w-100">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" 
    integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" 
    crossorigin="anonymous"></script>

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
        document.addEventListener('trix-file-accept', function (e) {
        e.preventDefault();
    })
    const passwordConfirmInput = document.getElementById('password_confirm');
    const showPasswordConfirmButton = document.getElementById('showPasswordConfirm');

    showPasswordConfirmButton.addEventListener('click', function () {
        if (passwordConfirmInput.type === 'password') {
            passwordConfirmInput.type = 'text';
            showPasswordConfirmButton.innerHTML = '<i class="bi bi-eye-slash"></i>';
        } else {
            passwordConfirmInput.type = 'password';
            showPasswordConfirmButton.innerHTML = '<i class="bi bi-eye"></i>';
        }
    });
    </script>

</body>
</html>

@include('sweetalert::alert')