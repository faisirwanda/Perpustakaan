<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Perpustakaan SMA 1 Sreseh</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">

    {{-- Font Google --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap" rel="stylesheet">

    {{-- Css --}}
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/responsive.css') }}">

    {{-- ikon web--}}
    {{-- <link rel="icon" href="{{ asset('images/sma.png') }}" type="image/x-icon"> --}}

  </head>
  <body>
    {{-- navbar --}}
    <nav class="navbar navbar-expand-lg bg-transparent navbar-dark position-fixed w-100">
        <div class="container-fluid">
          <a class="navbar-brand" href="#">
            <img src="{{ asset('images/sma.png') }}" alt="Logo" width="30" class="d-inline-block align-text-top me-3">Perpustakaan 
          </a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
              <li class="nav-item mx-2">
                <a class="nav-link active" aria-current="page" href="#">Beranda</a>
              </li>
              <li class="nav-item mx-2">
                <a class="nav-link" href="#">Peraturan</a>
              </li>
              <li class="nav-item dropdown mx-2">
                <a class="nav-link dropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                  Anggota
                </a>
                <ul class="dropdown-menu">
                  <li><a class="dropdown-item" href="#">Daftar</a></li>
                  <li><a class="dropdown-item" href="#">Masuk</a></li>
                </ul>
              </li>
              <li class="nav-item mx-2">
                <a class="nav-link" href="#">Pustakawan</a>
              </li>
            </ul>
          </div>
        </div>
    </nav>
    
    {{-- section hero --}}
    <section id="hero">
      <div class="container h-100">
        <div class="row h-100">
          <div class="col-md-6 hero-tagline my-auto">
            <h1>Perpustakaan SMA 1 Sreseh</h1>
            <p><span class="fw-bold">Lorem</span> ipsum dolor sit, amet consectetur adipisicing elit. Veritatis saepe enim reiciendis doloribus? Magni, blanditiis.</p>
            <button class="btn-hero">Temukan Buku</button> 
            <a href=""> 
              <img src="{{ asset('storage/image/Right Arrow.png') }}" class="ms-2" alt="">
            </a>
          </div>
        </div>
        <img src="{{ asset('storage/image/Hero Image.png') }}" alt="" class="position-absolute end-0 bottom-0 img-hero">
        <img src="{{ asset('storage/image/Accsent 1.png') }}" alt="" class="h-100 position-absolute top-0 start-0 accsent-img">
      </div>
    </section>

    {{-- section category --}}
    <section id="category">
        <div class="container">
          <div class="row">
            <div class="col-12 text-center">
                <h2>Kategoru Buku</h2>
                <span class="sub-title">Lorem ipsum dolor sit amet consectetur adipisicing elit. Eum, corporis.</span>
            </div>
          </div>

          <div class="row mt-5">
            <div class="col-md-4 text-center">
              <div class="card-category">
                <div class="circle-icon position-relative mx-auto">
                  <img src="{{ asset('storage/image/icon1.png') }}" alt="" style="width: 50px;" class="position-absolute top-50 start-50 translate-middle">
                </div>
                <h3 class="mt-4">Ilmu Murni</h3>
                  <p class="mt-3">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Velit, sint?</p>
              </div>
            </div>
            <div class="col-md-4 text-center">
              <div class="card-category">
                <div class="circle-icon position-relative mx-auto">
                  <img src="{{ asset('storage/image/icon sewa.png') }}" alt="" style="width: 50px;" class="position-absolute top-50 start-50 translate-middle">
                </div>
                <h3 class="mt-4">Ilmu Murni</h3>
                  <p class="mt-3">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Velit, sint?</p>
              </div>
            </div>
            <div class="col-md-4 text-center">
              <div class="card-category">
                <div class="circle-icon position-relative mx-auto">
                  <img src="{{ asset('storage/image/icon beli.png') }}" alt="" style="width: 50px;" class="position-absolute top-50 start-50 translate-middle">
                </div>
                <h3 class="mt-4">Ilmu Murni</h3>
                  <p class="mt-3">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Velit, sint?</p>
              </div>
            </div>
          </div>
        </div>
    </section>

    {{-- search section --}}
    <section id="search" style="background-image: url('{{ asset('storage/image/Img-search.png') }}');" class="d-flex align-items-center">
      <div class="container">
        <div class="row">
          <div class="col-12 text-center">
            <h2>Buku Populer</h2>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Nulla dicta, aliquam delectus eius nesciunt veniam.</p>
          </div>
        </div>
        
      <div class="col-10 mx-auto mt-5">
        <ul class="nav nav-tabs" id="myTab" role="tablist">
          <li class="nav-item" role="presentation">
            <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home-tab-pane" type="button" role="tab" aria-controls="home-tab-pane" aria-selected="true">Home</button>
          </li>
          <li class="nav-item" role="presentation">
            <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile-tab-pane" type="button" role="tab" aria-controls="profile-tab-pane" aria-selected="false">Profile</button>
          </li>
          <li class="nav-item" role="presentation">
            <button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#contact-tab-pane" type="button" role="tab" aria-controls="contact-tab-pane" aria-selected="false">Contact</button>
          </li>
        </ul>
        <div class="tab-content" id="myTabContent">
          {{-- Home --}}
          <div class="tab-pane fade show active" id="home-tab-pane" role="tabpanel" aria-labelledby="home-tab" tabindex="0">
            <div class="input-group input-cari mb-3">
              <button class="btn-down dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false" >
                <img src="{{ asset('storage/image/Home Icon.png') }}" alt="" class="d-block d-lg-inline mx-auto">
                Menu</button>
              <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="#">Action</a></li>
                <li><a class="dropdown-item" href="#">Another action</a></li>
                <li><a class="dropdown-item" href="#">Something else here</a></li>
                <li><hr class="dropdown-divider"></li>
                <li><a class="dropdown-item" href="#">Separated link</a></li>
              </ul>    
              {{-- Harga --}}
              <button class="btn-down dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false" >
                <img src="{{ asset('storage/image/Money-icon.png') }}" alt="" class="d-block d-lg-inline mx-auto">
                Harga</button>
              <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="#">Action</a></li>
                <li><a class="dropdown-item" href="#">Another action</a></li>
                <li><a class="dropdown-item" href="#">Something else here</a></li>
                <li><hr class="dropdown-divider"></li>
                <li><a class="dropdown-item" href="#">Separated link</a></li>
              </ul>
              <input type="text" class="form-control" name="" aria-label="Text input with dropdown button" placeholder="Cari Koleksi">
              <button class="btn-cari">Cari</button>
            </div>            
          </div>

          {{-- Profile --}}
          <div class="tab-pane fade" id="profile-tab-pane" role="tabpanel" aria-labelledby="profile-tab" tabindex="0">
            <div class="tab-pane fade show active" id="home-tab-pane" role="tabpanel" aria-labelledby="home-tab" tabindex="0">
              <div class="input-group input-cari mb-3">
                <button class="btn-down dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false" >
                  <img src="{{ asset('storage/image/Home Icon.png') }}" alt="" class="d-block d-lg-inline mx-auto">
                  Menu</button>
                <ul class="dropdown-menu">
                  <li><a class="dropdown-item" href="#">Action</a></li>
                  <li><a class="dropdown-item" href="#">Another action</a></li>
                  <li><a class="dropdown-item" href="#">Something else here</a></li>
                  <li><hr class="dropdown-divider"></li>
                  <li><a class="dropdown-item" href="#">Separated link</a></li>
                </ul>    
                {{-- Harga --}}
                <button class="btn-down dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false" >
                  <img src="{{ asset('storage/image/Money-icon.png') }}" alt="" class="d-block d-lg-inline mx-auto">
                  Harga</button>
                <ul class="dropdown-menu">
                  <li><a class="dropdown-item" href="#">Action</a></li>
                  <li><a class="dropdown-item" href="#">Another action</a></li>
                  <li><a class="dropdown-item" href="#">Something else here</a></li>
                  <li><hr class="dropdown-divider"></li>
                  <li><a class="dropdown-item" href="#">Separated link</a></li>
                </ul>
                <input type="text" class="form-control" aria-label="Text input with dropdown button" placeholder="Cari Koleksi">
                <button class="btn-cari">Cari</button>
              </div>            
            </div>
          </div>

          {{-- Contact --}}
          <div class="tab-pane fade" id="contact-tab-pane" role="tabpanel" aria-labelledby="contact-tab" tabindex="0">
            <div class="tab-pane fade show active" id="home-tab-pane" role="tabpanel" aria-labelledby="home-tab" tabindex="0">
              <div class="input-group input-cari mb-3">
                <button class="btn-down dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false" >
                  <img src="{{ asset('storage/image/Home Icon.png') }}" alt="" class="d-block d-lg-inline mx-auto">
                  Menu</button>
                <ul class="dropdown-menu">
                  <li><a class="dropdown-item" href="#">Action</a></li>
                  <li><a class="dropdown-item" href="#">Another action</a></li>
                  <li><a class="dropdown-item" href="#">Something else here</a></li>
                  <li><hr class="dropdown-divider"></li>
                  <li><a class="dropdown-item" href="#">Separated link</a></li>
                </ul>    
                {{-- Harga --}}
                <button class="btn-down dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false" >
                  <img src="{{ asset('storage/image/Money-icon.png') }}" alt="" class="d-block d-lg-inline mx-auto">
                  Harga</button>
                <ul class="dropdown-menu">
                  <li><a class="dropdown-item" href="#">Action</a></li>
                  <li><a class="dropdown-item" href="#">Another action</a></li>
                  <li><a class="dropdown-item" href="#">Something else here</a></li>
                  <li><hr class="dropdown-divider"></li>
                  <li><a class="dropdown-item" href="#">Separated link</a></li>
                </ul>
                <input type="text" class="form-control" aria-label="Text input with dropdown button" placeholder="Cari Koleksi">
                <button class="btn-cari">Cari</button>
              </div>            
            </div>
          </div>

        </div>
      </div>

      </div>
    </section>

    {{-- rekomendasi setion --}}
    <section id="rekomendasi">
      <div class="container">
        <div class="row mb-4">
          <div class="col-12 text-center">
            <h2>Buku Rekomendasi</h2>
          </div>
        </div>
        <div class="row">
          {{-- 1 --}}
          <div class="col-lg-4 col-md-6 mb-4 d-flex justify-content-evenly">
            <div class="card p-2" style="width: 22rem;">
              <img src="{{ asset('storage/image/Rekomendasi1.png') }}" alt="">
              <div class="card-body">
                <h4>Judul Buku</h4>
                <p class="mb-4 lh-sm">Lorem, ipsum dolor <br> <span class="text-danger">Pinjam</span></p>
              </div>
              <div class="card-fasilitas d-flex justify-content-between px-2">
                <span>
                  <img src="{{ asset('storage/image/Icon Kamar Tidur.png') }}" alt=""> 3
                  <p>Kamar Tidur</p>
                </span>
                <span>
                  <img src="{{ asset('storage/image/Icon Kamar Mandi.png') }}" alt=""> 3
                  <p>Kamar Mandi</p>
                </span>
                <span>
                  <img src="{{ asset('storage/image/Icon Luas Tanah.png') }}" alt=""> 3
                  <p>Luas Tanah</p>
                </span>
              </div>
            </div>
          </div>
          {{-- 2 --}}
          <div class="col-lg-4 col-md-6 mb-4 d-flex justify-content-evenly">
            <div class="card p-2" style="width: 22rem;">
              <img src="{{ asset('storage/image/Rekomendasi2.png') }}" alt="">
              <div class="card-body">
                <h4>Judul Buku</h4>
                <p class="mb-4 lh-sm">Lorem, ipsum dolor <br> <span class="text-danger">Pinjam</span></p>
              </div>
              <div class="card-fasilitas d-flex justify-content-between px-2">
                <span>
                  <img src="{{ asset('storage/image/Icon Kamar Tidur.png') }}" alt=""> 3
                  <p>Kamar Tidur</p>
                </span>
                <span>
                  <img src="{{ asset('storage/image/Icon Kamar Mandi.png') }}" alt=""> 3
                  <p>Kamar Mandi</p>
                </span>
                <span>
                  <img src="{{ asset('storage/image/Icon Luas Tanah.png') }}" alt=""> 3
                  <p>Luas Tanah</p>
                </span>
              </div>
            </div>
          </div>
          {{-- 3 --}}
          <div class="col-lg-4 col-md-6 mb-4 d-flex justify-content-evenly">
            <div class="card p-2" style="width: 22rem;">
              <img src="{{ asset('storage/image/Rekomendasi3.png') }}" alt="">
              <div class="card-body">
                <h4>Judul Buku</h4>
                <p class="mb-4 lh-sm">Lorem, ipsum dolor <br> <span class="text-danger">Pinjam</span></p>
              </div>
              <div class="card-fasilitas d-flex justify-content-between px-2">
                <span>
                  <img src="{{ asset('storage/image/Icon Kamar Tidur.png') }}" alt=""> 3
                  <p>Kamar Tidur</p>
                </span>
                <span>
                  <img src="{{ asset('storage/image/Icon Kamar Mandi.png') }}" alt=""> 3
                  <p>Kamar Mandi</p>
                </span>
                <span>
                  <img src="{{ asset('storage/image/Icon Luas Tanah.png') }}" alt=""> 3
                  <p>Luas Tanah</p>
                </span>
              </div>
            </div>
          </div>
          {{-- 4 --}}
          <div class="col-lg-4 col-md-6 mb-4 d-flex justify-content-evenly">
            <div class="card p-2" style="width: 22rem;">
              <img src="{{ asset('storage/image/Rekomendasi4.png') }}" alt="">
              <div class="card-body">
                <h4>Judul Buku</h4>
                <p class="mb-4 lh-sm">Lorem, ipsum dolor <br> <span class="text-danger">Pinjam</span></p>
              </div>
              <div class="card-fasilitas d-flex justify-content-between px-2">
                <span>
                  <img src="{{ asset('storage/image/Icon Kamar Tidur.png') }}" alt=""> 3
                  <p>Kamar Tidur</p>
                </span>
                <span>
                  <img src="{{ asset('storage/image/Icon Kamar Mandi.png') }}" alt=""> 3
                  <p>Kamar Mandi</p>
                </span>
                <span>
                  <img src="{{ asset('storage/image/Icon Luas Tanah.png') }}" alt=""> 3
                  <p>Luas Tanah</p>
                </span>
              </div>
            </div>
          </div>
          {{-- 5 --}}
          <div class="col-lg-4 col-md-6 mb-4 d-flex justify-content-evenly">
            <div class="card p-2" style="width: 22rem;">
              <img src="{{ asset('storage/image/Rekomendasi5.png') }}" alt="">
              <div class="card-body">
                <h4>Judul Buku</h4>
                <p class="mb-4 lh-sm">Lorem, ipsum dolor <br> <span class="text-danger">Pinjam</span></p>
              </div>
              <div class="card-fasilitas d-flex justify-content-between px-2">
                <span>
                  <img src="{{ asset('storage/image/Icon Kamar Tidur.png') }}" alt=""> 3
                  <p>Kamar Tidur</p>
                </span>
                <span>
                  <img src="{{ asset('storage/image/Icon Kamar Mandi.png') }}" alt=""> 3
                  <p>Kamar Mandi</p>
                </span>
                <span>
                  <img src="{{ asset('storage/image/Icon Luas Tanah.png') }}" alt=""> 3
                  <p>Luas Tanah</p>
                </span>
              </div>
            </div>
          </div>
          {{-- 6 --}}
          <div class="col-lg-4 col-md-6 mb-4 d-flex justify-content-evenly">
            <div class="card p-2" style="width: 22rem;">
              <img src="{{ asset('storage/image/Rekomendasi6.png') }}" alt="">
              <div class="card-body">
                <h4>Judul Buku</h4>
                <p class="mb-4 lh-sm">Lorem, ipsum dolor <br> <span class="text-danger">Pinjam</span></p>
              </div>
              <div class="card-fasilitas d-flex justify-content-between px-2">
                <span>
                  <img src="{{ asset('storage/image/Icon Kamar Tidur.png') }}" alt=""> 3
                  <p>Kamar Tidur</p>
                </span>
                <span>
                  <img src="{{ asset('storage/image/Icon Kamar Mandi.png') }}" alt=""> 3
                  <p>Kamar Mandi</p>
                </span>
                <span>
                  <img src="{{ asset('storage/image/Icon Luas Tanah.png') }}" alt=""> 3
                  <p>Luas Tanah</p>
                </span>
              </div>
            </div>
          </div>

        </div>
      </div>
    </section>

    {{-- fitur section --}}
    <section id="fitur" class="mt-5 overflow-hidden">
      <div class="container position-relative">
        <div class="row mb-4">
          <div class="col-lg-9 col-md-12 text-center text-lg-start">
            <h2>Fitur Perpustakaan</h2>
          </div>
          <div class="col-lg-3 col-md-12">
            <button class="btn-fitur">Lihat Semua..
              <img src="{{ asset('storage/image/Right Arrow.png') }}" class="ms-2" alt="">
            </button>
          </div>
        </div>
        <div class="container position-relative mt-5">
          <div class="row">
            <div class="col-12 d-flex justify-content-start">
              <div class="card-fitur me-3 position-relative">
                <img src="{{ asset('storage/image/Fitur Rumah 1.png') }}" alt="">
                <div class="overlay position-absolute top-0 bottom-0 start-0 end-0 w-100 h-100">
                  <div class="position-absolute top-50 start-50 translate-middle text-center w-100">
                    <h5>Buku Baru</h5>
                    <span>Lorem ipsum dolor sit.</span>
                    <h6>Informasi</h6>
                    <button>Lihat Buku</button>
                  </div>
                </div>
              </div>
              <div class="card-fitur me-3 position-relative">
                <img src="{{ asset('storage/image/Fitur Rumah 1.png') }}" alt="">
                <div class="overlay position-absolute top-0 bottom-0 start-0 end-0 w-100 h-100">
                  <div class="position-absolute top-50 start-50 translate-middle text-center w-100">
                    <h5>Buku Baru</h5>
                    <span>Lorem ipsum dolor sit.</span>
                    <h6>Informasi</h6>
                    <button>Lihat Buku</button>
                  </div>
                </div>
              </div>
              <div class="card-fitur me-3 position-relative">
                <img src="{{ asset('storage/image/Fitur Rumah 1.png') }}" alt="">
                <div class="overlay position-absolute top-0 bottom-0 start-0 end-0 w-100 h-100">
                  <div class="position-absolute top-50 start-50 translate-middle text-center w-100">
                    <h5>Buku Baru</h5>
                    <span>Lorem ipsum dolor sit.</span>
                    <h6>Informasi</h6>
                    <button>Lihat Buku</button>
                  </div>
                </div>
              </div>
              <div class="card-fitur me-3 position-relative">
                <img src="{{ asset('storage/image/Fitur Rumah 1.png') }}" alt="">
                <div class="overlay position-absolute top-0 bottom-0 start-0 end-0 w-100 h-100">
                  <div class="position-absolute top-50 start-50 translate-middle text-center w-100">
                    <h5>Buku Baru</h5>
                    <span>Lorem ipsum dolor sit.</span>
                    <h6>Informasi</h6>
                    <button>Lihat Buku</button>
                  </div>
                </div>
              </div>
            </div>
          </div>
            <button class="btn-arrow-left position-absolute start-0 top-50 translate-middle-y">
              <img src="{{ asset('storage/image/Left Arrow lg.png') }}" alt="" style="width: 50px;">
            </button>
            <button class="btn-arrow-right position-absolute end-0 top-50 translate-middle-y">
              <img src="{{ asset('storage/image/Right Arrow lg.png') }}" alt="" style="width: 50px;">
            </button>
        </div>
      </div>
    </section>

    {{-- contact section --}}
    <section id="contact" style="background-image: url('{{ asset('storage/image/kontak-img.png') }}');">
      <div class="container-fluid overlay h-100">
        <div class="container">
          <div class="row">
            <div class="col-md-6">
              <h3>Butuh Konsultasi..? Silahkan Kontak Kami Kami Siap Membantu</h3>
              <div class="kontak">
                <h6>Kontak</h6>
                <div class="mb-3 d-flex align-items-center">
                  <div>
                    <img src="{{ asset('storage/image/Alamat Icon.png') }}" alt="">
                  </div>
                  <a href="#">Jl Raya Noreh No. 22 Sreseh Sampang Jawa Timur Indonesia</a>
                </div>
                <div class="mb-3">
                  <img src="{{ asset('storage/image/Instagram Icon.png') }}" alt="">
                  <a href="#">081</a>
                </div>
                <div class="mb-3">
                  <img src="{{ asset('storage/image/Facebook Icon.png') }}" alt="">
                  <a href="#">Smanser@gmail.com</a>
                </div>
              </div>
              <h6>Social Media</h6>
              <a href="" class="me-lg-3 me-1"><img src="{{ asset('storage/image/Facebook Icon.png') }}" alt=""></a>
              <a href="" class="me-lg-3 me-1"><img src="{{ asset('storage/image/Instagram Icon.png') }}" alt=""></a>
              <a href="" class="me-lg-3 me-1"><img src="{{ asset('storage/image/Whatsapp Icon.png') }}" alt=""></a>
              <a href="" class="link-sma">Smanser Perpustakaan</a>
            </div>

            <div class="col-md-6">
                <div class="card-contact w-100 position-relative">
                    <form>
                      <h2>Ada Pertanyaan..?</h2>
                      <div class="form-floating mb-3 d-flex">
                        <input type="email" class="form-control" id="floatingInput" placeholder="Masukkan email">
                        <label for="floatingInput" class="d-flex align-items-center">Masukkan email</label>
                      </div>
                      <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="floatingInput" placeholder="Masukkan Pertanyaan">
                        <label for="floatingInput" class="d-flex align-items-center">Masukkan pertanyaan</label>
                      </div>
                      <button type="submit" class="btn-kontak">Kirim</button>
                    </form>
                </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    {{-- footer --}}
    {{-- <footer class="d-flex align-items-center position-relative">
      <div class="container-fluid">
        <div class="container">
          <div class="row">
            <div class="col-md-7 d-flex align-items-center justify-content-center">
              <img src="{{ asset('images/sma.png') }}" alt="Logo" width="30" class="me-3"><a href="#">Perpustakaan SMA</a>
            </div>
            <div class="col-md-5 d-flex justify-content-evenly">
              <a href="#hero">Beranda</a>
              <a href="#category">Kategori</a>
              <a href="#fitur">Fitur</a>
              <a href="#contact">Kontak</a>
            </div>
          </div>
          <div class="row position-absolute copyright start-50 translate-middle">
            <div class="col-12">
              <p>&copy; Copy Right SMA 1 Sreseh</p>
            </div>
          </div>
        </div>
      </div>
    </footer> --}}

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
    <script src="{{ asset('js/script.js') }}"></script>
  </body>
</html>