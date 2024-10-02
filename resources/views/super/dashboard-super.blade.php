@extends('layouts.mainlayout')

@section('title', 'Beranda')

@section('content')

    {{-- <h3>Selamat Datang, {{Auth::User()->username}}</h3> --}}

    <div class="row mt-5">
        <div class="col-lg-4">
           <div class="card-data book">
            <div class="row">
                <div class="col-6"><i class="bi bi-journal-bookmark"></i></div>
                <div class="col-6 d-flex flex-column justify-content-center align-items-end">
                    <div class="card-desc"><a href="/super/book-list-super"> Buku </a></div>
                    <div class="card-count">{{$book_count}}</div>
                </div>
            </div>
           </div>
        </div>
        <div class="col-lg-4">
           <div class="card-data user">
            <div class="row">
                <div class="col-6"><i class="bi bi-people"></i></div>
                <div class="col-6 d-flex flex-column justify-content-center align-items-end">
                    <div class="card-desc"><a href="/super/admin"> Anggota</a></div>
                    <div class="card-count">{{$user_count}}</div>
                </div>
            </div>
           </div>
        </div>
    </div>

    <div class="mt-5 col-12" >
        <h2>Statistik Peminjaman Buku</h2>
        {!! $chart->container() !!}
        <script src="{{ $chart->cdn() }}"></script>
        {{ $chart->script() }}
    </div>

    <div class="mt-5 col-12" >
        <h2>Statistik Peminjaman Anggota</h2>
        {!! $datachart->container() !!}
        <script src="{{ $datachart->cdn() }}"></script>
        {{ $datachart->script() }}
    </div>
    
    @include('sweetalert::alert')
@endsection