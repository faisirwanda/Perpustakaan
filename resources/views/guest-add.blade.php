@extends('layouts.main')

@section('title', 'Tambah Tamu')

@section('content')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <div class=" justify-content-start w-50">
        
        <div class="mt-5">
            @if (session('message'))
                <div class="alert {{ session('alert-class') }}">
                    {{ session('message') }}      
                </div>
            @endif
        </div>
        <h2 class="mt-5">Isi Buku Tamu</h2>
        <hr>
        <form action="guest-add" method="post">
            @csrf
            <div class="mb-3">
                <label for="user" class="form-label fw-bold">Nama Lengkap</label>
                <input type="text" name="username" id="username" class="form-control w-75 @error ('username') is-invalid @enderror">
                @error('username')
                <div class="invalid-feedback fw-bold">
                    {{ $message }}
                 </div>
                 @enderror
            </div>
            <div>
                <button class="btn btn-success btn-md me-3" type="submit"><i class="bi bi-send"></i> Kirim</button>
            </div>  
        </form>
    </div>
<script src="https://code.jquery.com/jquery-3.6.3.min.js"></script>

@include('sweetalert::alert')
@endsection