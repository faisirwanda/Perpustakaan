@extends('layouts.mainlayout')

@section('title', 'Edit Kategori')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6">
            <div class="mt-3">
                <form action="/admin/category-edit/{{ $category->slug }}" method="post">
                    @csrf
                    @method('put')
                    <div class="mb-3">
                        <label for="id" class="form-label fw-bold">Kode Kategori</label>
                        <input type="text" name="id" id="id" class="form-control @error('id') is-invalid @enderror" placeholder="Kode Kategori" value="{{ old('id', $category->id)}}">
                        @error('id')
                            <div class="invalid-feedback fw-bold">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label for="name" class="form-label fw-bold">Nama Kategori</label>
                        <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" placeholder="Nama Kategori" value="{{ old('name', $category->name)}}">
                        @error('name')
                            <div class="invalid-feedback fw-bold">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mt-3">
                        <button class="btn btn-success me-3" type="submit"><i class="bi bi-file-earmark"></i> Simpan</button>
                        <a href="/admin/categories" class="btn btn-danger"> <i class="bi bi-x-circle"></i> Batal </a>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-md-6">
            <div class="mt-3">
                <table class="table table-md table-light table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>Kode Kategori</th>
                            <th>Nama Kategori</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>000 - 099</td>
                            <td>Karya Umum</td>
                        </tr>
                        <tr>
                          <td>100 - 199</td>
                          <td>Filsafat dan Psikologi</td>
                        </tr>
                        <tr>
                          <td>200 - 299</td>
                          <td>Agama</td>
                        </tr>
                        <tr>
                          <td>300 - 399</td>
                          <td>Ilmu Sosial</td>
                        </tr>
                        <tr>
                          <td>400 - 499</td>
                          <td>Bahasa</td>
                        </tr>
                        <tr>
                          <td>500 - 599</td>
                          <td>Ilmu Murni</td>
                        </tr>
                        <tr>
                          <td>600 - 699</td>
                          <td>Teknologi</td>
                        </tr>
                        <tr>
                          <td>700 - 799</td>
                          <td>Kesenian, Hiburan & Olahraga</td>
                        </tr>
                        <tr>
                          <td>800 - 899</td>
                          <td>Kesusastraan</td>
                        </tr>
                        <tr>
                          <td>900 - 999</td>
                          <td>Geografi & Sejarah</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
    @include('sweetalert::alert')
@endsection