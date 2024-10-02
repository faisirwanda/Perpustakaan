<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Perpustakaan | @yield('title')</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/5.2/examples/dashboard/">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    
    <!-- Custom styles for this template -->
    <link href="{{asset('css/dashboard.css')}}" rel="stylesheet">
    <link rel="icon" type="image/x-icon" href="{{asset('images/sma.png') }}">
  </head>
  <body>
    

<header class="navbar navbar-dark sticky-top bg-light flex-md-nowrap p-0 shadow">
    <div class="container-fluid d-flex align-items-center">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle sidebar" style="padding: 0.25rem 0.5rem; font-size: 0.75rem;">
              <span class="navbar-toggler-icon"></span>
            </button>
                            
            <!-- Rest of the code -->
      <a class="navbar-brand col-md-3 col-lg-2 me-0 px-0 fs-6 fw-bold d-flex align-items-center" href="#">
        Perpustakaan SMA N 1 Sreseh  <img src="{{ asset('images/sma.png') }}" class="card-img-top ms-2" style="max-width: 2rem; max-height: 2rem;" draggable="false">
      </a>
      <div class="navbar-nav">
        <div class="nav-item text-nowrap position-relative">
          <a class="text-decoration-none"  href="#" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            @if(Auth::User()->photo)
            <img src="{{ asset('storage/photo/'.Auth::User()->photo) }}" class="img-thumbnail rounded-circle" style="max-width: 2rem; max-height: 2rem;">
            @else
                <img src="{{ asset('images/user.png') }}" class="img-thumbnail rounded-circle" style="max-width: 2rem; max-height: 2rem;">
            @endif
          </a>
          <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
            @if (Auth::User())
            @if (Auth::User()->role_id==1)
            <li><a href="/admin/profile-admin" class="dropdown-item"><i class="bi bi-person-gear"></i> Profil </a></li>
            @elseif (Auth::User()->role_id==2)
            <li><a href="/user/profile-user" class="dropdown-item"><i class="bi bi-person-gear"></i> Profil </a></li>
            @elseif (Auth::User()->role_id==3)
            <li><a href="/super/profile-super" class="dropdown-item"><i class="bi bi-person-gear"></i> Profil </a></li>
            @endif
            @endif
            <li><a class="dropdown-item" href="/logout"><i class="bi bi-box-arrow-right"></i> Keluar</a></li>
          </ul>
        </div>
      </div>
    </div>
</header>

<div class="container-fluid">
    <div class="row">
        <div id="sidebarMenu">
            <!-- Existing sidebar content -->
            <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block sidebar collapse">
                @if (Auth::User())
                @if (Auth::User()->role_id==1)
            <div class="position-sticky pt-0 sidebar-sticky">
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a href="/admin/dashboard" @if(request()->route()->uri == 'admin/dashboard') class="nav-link active" aria-current="page"
                            @endif>
                            <i class="bi bi-house"></i>  
                            Beranda
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="/admin/books" @if (request()->route()->uri == 'admin/books' || request()->route()->uri == 'admin/book-add' || request()->route()->uri == 'admin/book-edit/{slug}' || request()->route()->uri == 'admin/book-delete/{slug}') class="nav-link active" @endif>
                            <i class="bi bi-book"></i> 
                            Kelola Buku
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="/admin/book-list"@if(request()->route()->uri == 'admin/book-list' || request()->route()->uri == 'admin/book-list-detail/{title}' || request()->route()->uri == 'admin/book-detail/{slug}') class="nav-link active" @endif>
                            <i class="bi bi-list-task"></i> 
                            List Buku
                        </a>                    
                    </li>
                    <li class="nav-item">
                        <li class="nav-item">
                            <a href="/admin/categories" @if (request()->route()->uri == 'admin/categories' || request()->route()->uri == 'admin/category-add' || request()->route()->uri == 'admin/category-edit/{slug}') class="nav-link active"
                                @endif>
                                <i class="bi bi-grid"></i> 
                                Kategori Buku
                            </a>  
                        </li>
                        <li class="nav-item">
                            <a href="/admin/places" @if (request()->route()->uri == 'admin/places' || request()->route()->uri == 'admin/cupboard-add' || request()->route()->uri == 'admin/rack-add' || request()->route()->uri == 'admin/cupboard-edit/{id}' || request()->route()->uri == 'admin/rack-edit/{id}') class="nav-link active"
                                @endif>
                                <i class="bi bi-geo-fill"></i> 
                                Tempat Buku
                            </a>  
                        </li>
                        <a href="/admin/users" @if (request()->route()->uri == 'admin/users' || request()->route()->uri == 'admin/registered-users' || request()->route()->uri == 'admin/user-detail/{slug}' || request()->route()->uri == 'admin/user-banned') class="nav-link active"
                            @endif>
                            <i class="bi bi-people"></i> 
                            Anggota
                        </a> 
                    </li>
                    <li class="nav-item">
                        <a href="/admin/book-rent"@if(request()->route()->uri == 'admin/book-rent' || request()->route()->uri == 'admin/book-rent-add') class="nav-link active" @endif>
                            <i class="bi bi-journal-arrow-down"></i> 
                            Peminjaman Buku
                        </a>                    
                    </li>
                    <li class="nav-item">
                        <a href="/admin/book-return"@if(request()->route()->uri == 'admin/book-return') class="nav-link active" @endif>
                            <i class="bi bi-journal-arrow-up"></i> 
                            Pengembalian Buku
                        </a>                    
                    </li>
                    <li class="nav-item">
                        <a href="/admin/transaction" @if (request()->route()->uri == 'admin/transaction' || request()->route()->uri == 'admin/transaction-teacher' || request()->route()->uri == 'admin/transaction-student') class="nav-link active"
                            @endif>
                            <i class="bi bi-arrow-left-right"></i> 
                            Histori Peminjaman
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="/admin/guest"@if(request()->route()->uri == 'admin/guest' || request()->route()->uri == 'admin/guest-add' || request()->route()->uri == 'admin/guest-teacher' || request()->route()->uri == 'admin/guest-student') class="nav-link active" @endif>
                            <i class="bi bi-person-bounding-box"></i> 
                            Buku Tamu
                        </a>                    
                    </li>
                    <li class="nav-item">
                        <a href="/admin/message"@if(request()->route()->uri == 'admin/message') class="nav-link active" @endif>
                            <i class="bi bi-envelope"></i> 
                            Surat
                        </a>                    
                    </li>
                </ul>
                @elseif (Auth::User()->role_id==2)
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a href="/user/dashboard-user" @if(request()->route()->uri == 'user/dashboard-user' || request()->route()->uri == 'user/dashboard-user/{title}' || request()->route()->uri == 'user/book-detail/{slug}') class="nav-link active" @endif><i class="bi bi-house-fill"></i> Beranda
                        </a>                
                    </li>
                    <li class="nav-item">
                        <a href="/user/book-history-loan-user" @if(request()->route()->uri == 'user/book-history-loan-user' || request()->route()->uri == 'user/book-rating-user/{id}') class="nav-link active" @endif><i class="bi bi-clock-history"></i> Riwayat Peminjaman
                        </a>                
                    </li>
                    <li class="nav-item">
                        <a href="/user/card-user" @if(request()->route()->uri == 'user/card-user') class="nav-link active" @endif><i class="bi bi-person-vcard"></i> 
                            Kartu Anggota
                        </a> 
                    </li>
                </ul>
                @elseif (Auth::User()->role_id==3)
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a href="/super/dashboard-super" @if(request()->route()->uri == 'super/dashboard-super') class="nav-link active" @endif><i class="bi bi-house-fill"></i> 
                            Beranda
                        </a>               
                    </li>
                    <li class="nav-item">
                        <a href="/super/admin" @if(request()->route()->uri == 'super/admin' || request()->route()->uri == 'super/admin-detail/{slug}') class="nav-link active" @endif><i class="bi bi-person-fill-check"></i> 
                            Kelola Admin
                        </a>            
                    </li>
                    <li class="nav-item">
                        <a href="/super/book-list-super"@if(request()->route()->uri == 'super/book-list-super' || request()->route()->uri == 'super/book-list-super-detail/{title}' || request()->route()->uri == 'super/book-detail/{slug}') class="nav-link active" @endif><i class="bi bi-list-task"></i> List Buku
                        </a>                                 
                    </li>
                    <li class="nav-item">
                        <a href="/super/guest-report" @if(request()->route()->uri == 'super/guest-report') class="nav-link active" @endif><i class="bi bi-journal-album"></i> 
                            Laporan Buku Tamu
                        </a>             
                    </li>
                    <li class="nav-item">
                        <a href="/super/transaction-report" @if(request()->route()->uri == 'super/transaction-report') class="nav-link active" @endif><i class="bi bi-journal-text"></i> 
                            Laporan Histori Peminjaman
                        </a>                 
                    </li>
                    </ul>
                @endif
            </div>
        </nav>
                @endif
    </div>

    <main id="mainContent"  class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-5 border-bottom">
            <h1 class="h2">@yield('title')</h1>
        </div>
        @yield('content')
    </main>
    
    </div>
</div>

<script>
    document.querySelector('.navbar-toggler').addEventListener('click', function() {
      const sidebarMenu = document.querySelector('#sidebarMenu');
      const mainContent = document.querySelector('.col-md-9');
      const isActive = sidebarMenu.classList.contains('active');
      
      if (isActive) {
        sidebarMenu.classList.remove('active');
        mainContent.classList.remove('col-lg-10');
        mainContent.classList.add('col-lg-12');
      } else {
        sidebarMenu.classList.add('active');
        mainContent.classList.remove('col-lg-12');
        mainContent.classList.add('col-lg-10');
      }
    });
</script>
  

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
</script>

  </body>
</html>
