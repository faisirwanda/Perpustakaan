<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <style>
        .navbar-nav a.nav-link:hover{
            color: #ff8906; /* Warna untuk efek hover dan tautan aktif */
        }

        .navbar-nav a.nav-link.active {
            font-weight: bold; /* Memberikan efek tebal pada tautan aktif */
        }
    </style>
</head>
<body>
    
<nav class="navbar navbar-expand-lg bg-transparent navbar-dark position-fixed w-100">
    <div class="container-fluid">
        <a class="navbar-brand d-flex align-items-center" href="#">
            <img src="{{ asset('images/sma.png') }}" alt="Logo" width="30" class="me-2">Perpustakaan SMA N 1 Sreseh
        </a>
        
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>        
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto align-items-center">
                <li class="nav-item mx-3">
                    <a href="/" @if(request()->route()->uri == '/' || request()->route()->uri == 'book-detail/{slug}') class="nav-link active" @else class="nav-link" @endif>Beranda</a>
                </li>
                <li class="nav-item mx-3">
                    <a href="/guest-add" @if(request()->route()->uri == 'guest-add') class="nav-link active" @else class="nav-link" @endif>Kunjungan</a>
                </li>
                <li class="nav-item mx-3">
                    <a href="https://ths.li/Ql5H4hW"  target="_blank" @if(request()->route()->uri == '/https://ths.li/Ql5H4hW') class="nav-link active" @else class="nav-link" @endif>Virtual Tour</a>
                </li>
                <li class="nav-item mx-3">
                    <a href="/regulation" @if(request()->route()->uri == 'regulation') class="nav-link active" @else class="nav-link" @endif>Peraturan</a>
                </li>
                <li class="nav-item mx-3">
                    <a href="/librarian" @if(request()->route()->uri == 'librarian') class="nav-link active" @else class="nav-link" @endif>Pustakawan</a>
                </li>
                <li class="nav-item mx-3">
                    <a href="/login" @if(request()->route()->uri == 'login' || request()->route()->uri == 'register') class="nav-link active" @else class="nav-link" @endif>Masuk</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

</body>
</html>
