@extends('layouts.mainlayout')

@section('title', 'Form Peminjaman Buku')

@section('content')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet"/>

    <div class="col-12 col-md-8 col-lg-6">
        <form action="book-rent-add" method="post">
            @csrf
            <div class="mb-3">
                <label for="user" class="form-label fw-bold">Nama Lengkap</label>
                <select name="user_id" id="user" class="form-control inputbox @error ('user_id') is-invalid @enderror">
                    <option value="" disabled selected>-Pilih Nama-</option>
                        @foreach ($users as $item)
                            <option value="{{ $item->id }}" {{ old('user_id') == $item->id ? 'selected' : null }}>{{ $item->username }} </option>
                        @endforeach
                </select>
                @error('user_id')
                    <div class="invalid-feedback fw-bold">
                        {{ $message }}
                     </div>
                @enderror
            </div>
            <div class="mb-4">
                <label for="book" class="form-label fw-bold">Buku</label>
                <select name="book_id" id="book" class="form-control inputbox @error ('book_id') is-invalid @enderror">
                    <option value="" disabled selected>-Pilih Buku-</option>
                        @foreach ($books as $item)
                            <option value="{{$item->id}}" {{ old('book_id') == $item->id ? 'selected' : null }} >{{ $item->id }} - {{$item->title}}</option>    
                        @endforeach
                </select>
                @error('book_id')
                <div class="invalid-feedback fw-bold">
                    {{ $message }}
                 </div>
                @enderror
            </div>
            <div>
                <button class="btn btn-success btn-md me-3" type="submit"><i class="bi bi-file-earmark"></i> Simpan</button>
                <a href="/admin/book-rent" class="btn btn-danger"> <i class="bi bi-x-circle-fill"></i> Batal </a>
            </div>
        </form>
    </div>
<script src="https://code.jquery.com/jquery-3.6.3.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
        $('.inputbox').select2();
    });
</script>

@include('sweetalert::alert')
@endsection
