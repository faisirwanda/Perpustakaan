@extends('layouts.mainlayout')

@section('title', 'Edit Profil')

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
                                @if($user->photo)
                                    <img src="{{ asset('storage/photo/'.$user->photo) }}" class="img-thumbnail rounded mx-auto d-block">
                                @else
                                    <img src="{{ asset('images/user.png') }}" class="img-thumbnail rounded mx-auto d-block">
                                @endif    
                            </div>
                            <div class="col-md-8">
                                <form method="POST" action="{{ route('profile_user_update') }}" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="row mb-3">
                                        <label for="id" class="col-md-4 col-form-label text-md-end">{{ __('Nomor Induk') }}</label>
                                        <div class="col-md-8">
                                            <input id="id" type="text" class="form-control @error('id') is-invalid @enderror" name="id" value="{{ old('id', $user->id) }}">

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
                                            <input id="username" type="text" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username', $user->username) }}" required autocomplete="username">
    
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
                                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email', $user->email) }}" required autocomplete="email">
    
                                            @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="work" class="col-md-4 col-form-label text-md-end">{{ __('Pekerjaan') }}</label>
    
                                        <div class="col-md-8">  
                                            <select name="work_id" id="class" class="form-select">
                                                @foreach ($works as $work)
                                                    <option value="{{ $work->id }}" {{ old('work_id', $user->work_id) == $work->id ? 'selected' : '' }}>
                                                        {{ $work->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="gender" class="col-md-4 col-form-label text-md-end">{{ __('Jenis Kelamin') }}</label>
    
                                        <div class="col-md-8">
                                            <input class="form-check-input" type="radio" name="gender" id="radio" value="Laki-laki" {{ old('gender', $user->gender) == 'Laki-laki' ? 'checked' : '' }}> Laki-laki 
                                            <input class="form-check-input" type="radio" name="gender" id="radio" value="Perempuan" {{ old('gender', $user->gender) == 'Perempuan' ? 'checked' : '' }}> Perempuan 
                                            
                                            @error('gender')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="class" class="col-md-4 col-form-label text-md-end">{{ __('Kelas') }}</label>
                                        <div class="col-md-8">
                                        <input id="class" type="text" class="form-control @error('class') is-invalid @enderror" name="class" value="{{ old('class', $user->class) }}" required autocomplete="class">
                                            @error('class')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="address" class="col-md-4 col-form-label text-md-end">{{ __('Alamat') }}</label>
                                         <div class="col-md-8">
                                            <input id="address" type="address" class="form-control @error('address') is-invalid @enderror" name="address" value="{{ old('address', $user->address) }}" required autocomplete="address">
                                            @error('address')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div> 
                                    </div>
                                    <div class="row mb-3">
                                        <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Ganti Password') }}</label>
                                         <div class="col-md-8">
                                            <div class="input-group">
                                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" value="{{ old('password') }}">
                                                <button class="btn btn-outline-secondary" type="button" id="showPassword">
                                                   <i class="bi bi-eye"></i>
                                               </button>
                                                    @error('password')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                            </div>
                                        </div> 
                                    </div>
                                    <div class="row mb-3">
                                        <label for="password_confirm" class="col-md-4 col-form-label text-md-end">{{ __('Konfirmasi Password') }}</label>
                                         <div class="col-md-8">
                                            <div class="input-group">
                                                <input id="password_confirm" type="password" class="form-control @error('password_confirm') is-invalid @enderror" name="password_confirm" value="{{ old('password_confirm') }}">
                                                <button class="btn btn-outline-secondary" type="button" id="showPasswordConfirm">
                                                    <i class="bi bi-eye"></i>
                                                </button>
                                                @error('password_confirm')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>                                    
                                        </div> 
                                    </div>
                                    <div class="row mb-3">
                                        <label for="image" class="col-md-4 col-form-label text-md-end">{{ __('Ganti Foto Profil') }}</label>
                                        <div class="col-md-8">
                                            <input class="form-control" type="file" id="image" name="image" onchange="previewImage()">
                                            <label for="image" class="form-label @error ('image') is-invalid @enderror"></label>
                                            <img class="img-preview img-fluid mb-3 col-sm-8">
                                        </div>
                                    </div>
                                    <div class="row mb-0">
                                        <div class="col-md-8 offset-md-2">
                                            <button class="btn btn-success btn-md me-3" type="submit"><i class="bi bi-file-earmark"></i> Simpan</button>
                                            <a href="/user/profile-admin" class="btn btn-danger"> <i class="bi bi-x-circle"></i> Batal </a>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
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

        document.addEventListener('trix-file-accept', function(e) {
        e.preventDefault();
    })

    function previewImage(){
        const image = document.querySelector('#image');
        const imgPreview = document.querySelector('.img-preview');

        imgPreview.style.display = 'block';

        const oFReader = new FileReader();
        oFReader.readAsDataURL(image.files[0]);

        oFReader.onload = function (oFREvent){
            imgPreview.src = oFREvent.target.result;
        }
    }

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
    

    @include('sweetalert::alert')
@endsection

