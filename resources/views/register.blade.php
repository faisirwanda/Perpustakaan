@extends('layouts.main')

@section('title', 'Registrasi')

@section('content')
<div class="container">
    <div class="row mt-5">
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

            <div class="card mb-4" style="height: auto;">
                <div class="card-body">
                    <form action="" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="id" class="form-label fw-bold">Nomor Induk</label>
                            <input type="text" name="id" id="id" class="form-control @error ('id') is-invalid @enderror" value="{{ old('id') }}">
                            @error('id')
                            <div class="invalid-feedback fw-bold">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="usename" class="form-label fw-bold">Nama Lengkap</label>
                            <input type="text" name="username" id="username" class="form-control @error ('username') is-invalid @enderror" value="{{ old('username') }}">
                            @error('username')
                            <div class="invalid-feedback fw-bold">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label fw-bold">Email</label>
                            <input type="email" name="email" id="email" class="form-control @error ('email') is-invalid @enderror" value="{{ old('email') }}">
                            @error('email')
                            <div class="invalid-feedback fw-bold">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="work_id" class="form-label fw-bold">Pekerjaan</label>
                            <select class="form-select @error ('work_id') is-invalid @enderror" name="work_id" id="work_id" >
                                <option value="" disabled selected>-Pilih Pekerjaan-</option>
                                @foreach ($work as $item)
                                    <option value="{{ $item->id }}" {{ old('work_id') == $item->id ? 'selected' : '' }}>{{ $item->name }}</option>
                                @endforeach
                            </select>
                            @error('work_id')
                            <div class="invalid-feedback fw-bold">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="mb-3" id="kelasInputDiv">
                            <label for="class" class="form-label fw-bold">Kelas</label>
                            <input type="text" name="class" id="class" class="form-control @error ('class') is-invalid @enderror" value="{{ old('class') }}">
                            @error('class')
                            <div class="invalid-feedback fw-bold">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>        
                        <div class="mb-3">
                            <label for="gender" class="form-label fw-bold">Jenis Kelamin</label>  
                            <div>
                                <input class="form-check-input @error ('gender') is-invalid @enderror" type="radio" name="gender" id="radio1" value="Laki-laki" {{ old('gender') == 'Laki-laki' ? 'checked' : '' }}> 
                                <label for="radio1" class="form-check-label">Laki-laki</label>
                            </div>
                            <div>
                                <input class="form-check-input @error ('gender') is-invalid @enderror" type="radio" name="gender" id="radio3" value="Perempuan" {{ old('gender') == 'Perempuan' ? 'checked' : '' }}>
                                <label for="radio3" class="form-check-label">Perempuan</label>
                            </div>
                            @error('gender')
                            <div class="invalid-feedback fw-bold">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>                    
                        <div class="mb-3">
                            <label for="address" class="form-label fw-bold">Alamat</label>
                            <textarea name="address" id="address" class="form-control @error('address') is-invalid @enderror" rows="3">{{ old('address') }}</textarea>
                            @error('address')
                            <div class="invalid-feedback fw-bold">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="mb-1">
                            <label for="image" class="form-label fw-bold">Foto</label>
                            <input class="form-control @error ('image') is-invalid @enderror" type="file" id="image" name="image" onchange="previewImage()">
                            @error('image')
                            <div class="invalid-feedback fw-bold">
                                {{ $message }}
                            </div>
                            @enderror
                            <label for="image" class="form-label"></label>
                            <img class="img-preview img-fluid mb-2 col-6 mx-auto">
                        </div>
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
                        <div class="mb-3">
                            <button type="submit" class="btn btn-primary form-control fw-bold">Daftar</button>
                        </div>
                        <div class="fs-6">
                            Punya Akun? <a href="/login" class="text-decoration-none fw-bold">Masuk</a>
                        </div>
                    </form>
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

function previewImage() {
    const image = document.querySelector('#image');
    const imgPreview = document.querySelector('.img-preview');

    imgPreview.style.display = 'block';

    const oFReader = new FileReader();
    oFReader.readAsDataURL(image.files[0]);

    oFReader.onload = function (oFREvent) {
        imgPreview.src = oFREvent.target.result;
    }
}
</script>

<script>
    const classInput = document.getElementById('kelasInputDiv'); // Perbarui ID di sini

    // Fungsi untuk mengatur visibilitas input kelas
    function toggleClassInputVisibility() {
        classInput.style.display = (document.getElementById('work_id').value == 3) ? 'block' : 'none';
    }

    // Panggil fungsi saat halaman dimuat dan saat nilai yang dipilih dalam select work_id berubah
    document.addEventListener('DOMContentLoaded', toggleClassInputVisibility);
    document.getElementById('work_id').addEventListener('change', toggleClassInputVisibility);
</script>
@endsection