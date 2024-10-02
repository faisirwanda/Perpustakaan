@extends('layouts.mainlayout')

@section('title', 'Detail Admin')

@section('content')
    
<div class="container mb-5">
    <div class="row justify-content-start">
        <div class="col-md-7">
            <div class="card">
                <div class="card-header">{{ __('Profil') }}</div>

                <div class="card-body">
                    
                    @if(session('status'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('status') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @endif

                    <div class="row">
                        <div class="col-md-3">
                            @if($admin->image)
                                <img src="{{ asset('storage/cover/'.$admin->image) }}" class="img-thumbnail rounded mx-auto d-block">
                            @else
                                <img src="{{ asset('images/user.png') }}" class="img-thumbnail rounded mx-auto d-block">
                            @endif
                            
                        </div>
                        <div class="col-md-8">
                                <div class="row mb-3">
                                    <label for="id" class="col-md-4 col-form-label text-md-end">{{ __('Nomor Induk') }}</label>
                                    <div class="col-md-8">
                                        <input id="id" type="text" class="form-control" name="id" value="{{ $admin->id }}" readonly>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Nama') }}</label>
                                    <div class="col-md-8">
                                        <input id="username" type="text" class="form-control" name="username" value="{{ $admin->username }}" readonly>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email') }}</label>
                                    <div class="col-md-8">
                                        <input id="email" type="email" class="form-control" name="email" value="{{  $admin->email }}" readonly>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="work" class="col-md-4 col-form-label text-md-end">{{ __('Pekerjaan') }}</label>
                                    <div class="col-md-8">
                                        <input id="work" type="work" class="form-control" name="work" value="{{ $admin->work->name }}" readonly>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="gender" class="col-md-4 col-form-label text-md-end">{{ __('Jenis Kelamin') }}</label>
                                    <div class="col-md-8">
                                        <input id="gender" type="gender" class="form-control" name="gender" value="{{ $admin->gender }}" readonly>
                                    </div>
                                </div>
                                {{-- <div class="row mb-3">
                                    <label for="class" class="col-md-4 col-form-label text-md-end">{{ __('Kelas') }}</label>
                                    <div class="col-md-8">
                                        <input id="class" type="class" class="form-control" name="class" value="{{  $admin->class }}" readonly>
                                    </div>
                                </div> --}}
                                <div class="row mb-3">
                                    <label for="address" class="col-md-4 col-form-label text-md-end">{{ __('Alamat') }}</label>
                                    <div class="col-md-8">
                                        <input id="address" type="address" class="form-control" name="address" value="{{ $admin->address }}" readonly>
                                    </div>
                                </div>
                                <div class="row mb-4">
                                    <label for="role" class="col-md-4 col-form-label text-md-end">{{ __('Peran') }}</label>
                                    <div class="col-md-8">
                                        <input id="role" type="role" class="form-control" name="role" value="{{ $admin->role->name }}" readonly>
                                    </div>
                                </div>

                                <div class="row mb-0">
                                    <div class="col-md-8 offset-md-4">
                                        @if ($admin->role->name === 'Anggota')    
                                            <a href="/super/admin-approve/{{$admin->slug}}" class="btn btn-success me-3"><i class="bi bi-person-fill-add"></i> Jadikan Admin</a>
                                            <a href="/super/admin" class="btn btn-danger"> <i class="bi bi-x-circle"></i> Batal </a>
                                        @else
                                            <a href="/super/admin-delete/{{$admin->slug}}" class="btn btn-danger"><i class="bi bi-person-fill-x"></i> Hapus</a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</div>

@include('sweetalert::alert')
@endsection