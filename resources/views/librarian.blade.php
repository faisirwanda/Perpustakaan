@extends('layouts.main')

@section('title', 'Pustakawan')

@section('content')
<section id="profile">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
            <h2 class="mt-4">Profil Pustakawan</h2>
            <hr>
        </div>
      </div>
      <div class="row mt-3">
        <div class="col-lg-6 col-md-6 mb-4">
          <div class="card-profile">
          <div class="row">
                <div class="col-md-10">
                    <table class="table table-borderless mb-0">
                      <tr>
                        <th colspan="2">
                          <div class="circle-profile position-relative col-2">
                            @if($user->photo)
                                <img src="{{ asset('storage/photo/'.$user->photo) }}" class="img-thumbnail rounded mx-auto d-block">
                            @else
                                <img src="{{ asset('images/user.png') }}" class="img-thumbnail rounded mx-auto d-block">
                            @endif      
                          </div>
                          
                        </th>
                      </tr>
                        <tr>
                            <th style="width: 200px;" class="fw-light">Nama</th>
                            <td class="px-0 fw-light">: {{ $user->username }}</td>
                        </tr>
                        <tr>
                            <th style="width: 200px;" class="fw-light">Email</th>
                            <td class="px-0 fw-light">: {{ $user->email }} </td>
                        </tr>
                        <tr>
                            <th style="width: 200px;" class="fw-light">Jenis Kelamin</th>
                            <td class="px-0 fw-light">: {{ $user->gender }}</td>
                        </tr>
                        <tr>
                            <th style="width: 200px;" class="fw-light">Alamat</th>
                            <td class="px-0 fw-light">: {{ $user->address }}</td>
                        </tr>                                
                    </table>                            
                </div>
            </div>
          </div>
        </div>
      </div>
    </div>
</section>
@endsection

{{-- @extends('layouts.main')

@section('title', 'Pustakawan')

@section('content')
<head>
    <!-- ... Kode lainnya ... -->
    <style>
        .card-header {
            background-color: #007bff;
        }

        .card-body {
            padding: 20px;
        }

        .card-body .form-control {
            border: none;
            border-radius: 0;
            background-color: #f7f7f7;
        }

        .card-body .row {
            margin-bottom: 10px;
        }

        .btn-danger {
            background-color: #dc3565;
            border-color: #dc3545;
        }

        .btn-danger:hover {
            background-color: #c82333;
            border-color: #bd2130;
        }

        .text-white {
            color: #fff;
        }
    </style>
</head>

    <div class="container">
        <div class="row justify-content-start">
            <div class="col-md-6">
                <div class="card mb-4">
                    <div class="card-header bg-primary text-white text-center fs-3 d-flex align-items-center">
                        <img src="{{ asset('images/sma.png') }}" style="width: 45px; height: 45px;" class="me-1" alt="">
                        {{ __('Kartu Anggota Perpustakaan') }}
                        <img src="{{ asset('images/lambang.png') }}" style="width: 45px; height: 45px;" class="ms-1" alt="">
                    </div>
                    <div class="card-body">
                        @if(session('status'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('status') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif
                        <div class="row">
                            <div class="col-md-3">
                                @if($user->photo)
                                    <img src="{{ asset('storage/photo/'.$user->photo) }}" class="img-thumbnail rounded mx-auto d-block">
                                @else
                                    <img src="{{ asset('images/user.png') }}" class="img-thumbnail rounded mx-auto d-block">
                                @endif    
                            </div>
                            <div class="col-md-8">
                                <table class="table table-borderless fs-6 mb-0">
                                    <tr>
                                        <th style="width: 120px;">Nama </th>
                                        <td class="px-0 fw-bold">:</td>
                                        <td class="fw-bold">{{ $user->username }}</td>
                                    </tr>
                                    <tr>
                                        <th style="width: 120px;">Pekerjaan</th>
                                        <td class="px-0 fw-bold">:</td>
                                        <td class="fw-bold">{{ $user->work->name }}</td>
                                    </tr>
                                    <tr>
                                        <th style="width: 120px;">Jenis Kelamin</th>
                                        <td class="px-0 fw-bold">:</td>
                                        <td class="fw-bold">{{ $user->gender }}</td>
                                    </tr>
                                    <tr>
                                        <th style="width: 120px;">Kelas</th>
                                        <td class="px-0 fw-bold">:</td>
                                        <td class="fw-bold">{{ $user->class }}</td>
                                    </tr>
                                    <tr>
                                        <th style="width: 120px;">Alamat</th>
                                        <td class="px-0 fw-bold">:</td>
                                        <td class="fw-bold">{{ $user->address }}</td>
                                    </tr>                                
                                </table>                            
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-8">
                        <a href="/card-user-print" class="btn btn-danger text-white"><i class="bi bi-file-earmark-pdf"></i> Cetak</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('sweetalert::alert')
@endsection --}}
