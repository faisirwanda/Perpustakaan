@extends('layouts.mainlayout')

@section('title', 'Profil')

@section('content')
    
    <div class="mt-5">
        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}      
            </div>
        @endif
    </div>

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
                                @if($user->photo)
                                    <img src="{{ asset('storage/photo/'.$user->photo) }}" class="img-thumbnail rounded mx-auto d-block">
                                @else
                                    <img src="{{ asset('images/user.png') }}" class="img-thumbnail rounded mx-auto d-block">
                                @endif    
                            </div>
                            <div class="col-md-8">
                                    <div class="row mb-3">
                                        <label for="id" class="col-md-4 col-form-label text-md-end">{{ __('Nomor Induk') }}</label>
                                        <div class="col-md-8">
                                            <input id="id" type="text" class="form-control @error('id') is-invalid @enderror" name="id" value="{{ old('id', $user->id) }}" readonly>
                                            @error('id')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Nama') }}</label>
                                        <div class="col-md-8">
                                            <input id="username" type="text" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username', $user->username) }}" readonly>
                                            @error('username')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
    
                                    <div class="row mb-3">
                                        <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email') }}</label>
    
                                        <div class="col-md-8">
                                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email', $user->email) }}" readonly>
    
                                            @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="work_id" class="col-md-4 col-form-label text-md-end">{{ __('Pekerjaan') }}</label>
    
                                        <div class="col-md-8">  
                                            <input id="work_id" type="work_id" class="form-control @error('work_id') is-invalid @enderror" name="work_id" value="{{ old('work_id', $user->work->name) }}" readonly>
    
                                            @error('work_id')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="gender" class="col-md-4 col-form-label text-md-end">{{ __('Jenis Kelamin') }}</label>
    
                                        <div class="col-md-8">
                                            <input id="gender" type="gender" class="form-control @error('gender') is-invalid @enderror" name="gender" value="{{ old('gender', $user->gender) }}" readonly>
    
                                            @error('gender')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row mb-4">
                                        <label for="address" class="col-md-4 col-form-label text-md-end">{{ __('Alamat') }}</label>
                                         <div class="col-md-8">
                                            <input id="address" type="address" class="form-control @error('address') is-invalid @enderror" name="address" value="{{ old('address', $user->address) }}" readonly>
                                            @error('address')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div> 
                                    </div>
                                    </div>
                                    <div class="row mb-0">
                                        <div class="col-md-8 offset-md-4">
                                            <a href="/admin/profile-admin-edit" class="btn btn-warning text-white" ><i class="bi bi-pencil-square"></i> Edit Profil</a>
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