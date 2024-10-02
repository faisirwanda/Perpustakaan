@extends('layouts.mainlayout')

@section('title', 'Edit Lemari')

@section('content')
<div class="container">
    <div class="row">
      <div class="col-md-6">
        <div class="mt-3">
            <form action="/admin/cupboard-edit/{{ $cupboard->id }}" method="post">
                @csrf
                @method('PUT')
                <div class="mb-4">
                    <label for="name" class="form-label fw-bold @error ('name') is-invalid @enderror">Nama
                        Lemari</label>
                    <input type="text" name="name" id="name" class="form-control" placeholder="Nama Lemari"
                        value="{{ old('name', $cupboard->name) }}">
                    @error('name')
                    <div class="invalid-feedback fw-semibold">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <button class="btn btn-success me-2" type="submit"><i class="bi bi-file-earmark"></i>
                        Simpan</button>
                    <a href="/admin/categories" class="btn btn-danger"> <i class="bi bi-x-circle-fill"></i>
                        Batal </a>
                </div>
            </form>
        </div>
      </div>
    </div>
</div>
@include('sweetalert::alert') 
@endsection
