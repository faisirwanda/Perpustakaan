@extends('layouts.mainlayout')

@section('title', 'Form Pengembalian Buku')

@section('content')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<div class="col-12 col-md-8 col-lg-6">

    <form action="book-return" method="post">
        @csrf
        <div class="mb-3">
            <label for="user" class="form-label fw-bold">Nama Lengkap</label>
            <select name="user_id" id="user" class="form-control inputbox @error ('user_id') is-invalid @enderror">
                <option value="" disabled selected>-Pilih Nama-</option>
                    @foreach ($users as $item)
                        <option value="{{ $item->id }}" {{ old('user_id') == $item->id ? 'selected' : null }}>{{ $item->username }}</option>
                    @endforeach
            </select>
            @error('user_id')
                    <div class="invalid-feedback fw-bold">
                        {{ $message }}
                     </div>
                @enderror
        </div>
        <div class="mb-3">
            <label for="book" class="form-label fw-bold">Buku</label>
            <select name="book_id" id="book" class="form-control inputbox @error ('book_id') is-invalid @enderror"> 
                <option value="" disabled selected>-Pilih Buku-</option>
                    @foreach ($books as $item)
                        <option value="{{ $item->id }}" {{ old('book_id') == $item->id ? 'selected' : null }}>{{ $item->id }} {{ $item->title }}</option>
                    @endforeach
            </select>
            @error('book_id')
            <div class="invalid-feedback fw-bold">
                {{ $message }}
             </div>
            @enderror
        </div>
        <div class="selectbox mb-3">
            <label for="book_condition" class="form-label fw-bold">Kondisi</label>
            <select class="form-select @error('book_condition') is-invalid @enderror" name="book_condition" id="book_condition">
                <option value="" disabled selected>- Pilih Kondisi -</option>
                <option value="Baik" {{ old('book_condition') == 'Baik' ? 'selected' : null }}>Baik</option>
                <option value="Rusak" {{ old('book_condition') == 'Rusak' ? 'selected' : null }}>Rusak</option>
                <option value="Hilang" {{ old('book_condition') == 'Hilang' ? 'selected' : null }}>Hilang</option>
            </select>
            @error('book_condition')
                <div class="invalid-feedback fw-bold">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="mb-3" id="punishmentDiv" style="display: none;">
            <label for="punishment" class="form-label fw-bold">Denda</label>
            <input type="number" name="punishment" id="punishment" class="form-control @error ('punishment') is-invalid @enderror" placeholder="Denda" value="{{ old('punishment') }}">
            @error('punishment')
                <div class="invalid-feedback fw-bold">
                    {{ $message }}
                 </div>
            @enderror
        </div>
        <div class="mb-3" id="descriptionDiv" style="display: none;">
            <label for="description" class="form-label fw-bold">Keterangan</label>
            <input type="text" name="description" id="description" class="form-control @error ('description') is-invalid @enderror" placeholder="Keterangan" value="{{ old('description') }}">
            @error('description')
                <div class="invalid-feedback fw-bold">
                    {{ $message }}
                 </div>
            @enderror
        </div>
        <div class="mb-3">
            <button class="btn btn-success btn-md me-3" type="submit"><i class="bi bi-file-earmark"></i> Simpan</button>
            <a href="/admin/book-return" class="btn btn-danger"> <i class="bi bi-x-circle-fill"></i> Batal </a>
        </div>
    </form>
</div>
<script src="https://code.jquery.com/jquery-3.6.3.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
$(document).ready(function() {
    $('.inputbox').select2();
    $('#book_condition').change(function () {
        var value = $(this).val();
        if (value === 'Rusak' || value === 'Hilang') {
            $('#punishmentDiv').show();
            $('#descriptionDiv').show();
        } else {
            $('#punishmentDiv').hide();
            $('#descriptionDiv').hide();
        }
    });
});
</script>

@include('sweetalert::alert')
@endsection