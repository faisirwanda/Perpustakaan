@extends('layouts.mainlayout')

@section('title', 'Tambah Buku')

@section('content')

<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    
    <div class="mt-5 w-50">
        <form action="book-add" method="post" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="id" class="form-label fw-bold">Kode Buku</label>
                <input type="text" name="id" id="id" class="form-control @error ('id') is-invalid @enderror" placeholder="Kode Buku"  value="{{ old('id') }}">
                @error('id')
                    <div class="invalid-feedback fw-bold">
                        {{ $message }}
                     </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="title" class="form-label fw-bold">Judul Buku</label>
                <input type="text" name="title" id="title" class="form-control @error ('title') is-invalid @enderror" placeholder="Judul Buku" value="{{ old('title') }}">               
                @error('title')
                    <div class="invalid-feedback fw-bold">
                        {{ $message }}
                     </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="category_id" class="form-label fw-bold">Kategori</label>
                    <select class="form-select @error ('category_id') is-invalid @enderror" name="category_id">
                        <option value="" disabled selected>-Pilih Kategori-</option>
                        @foreach ($categories as $item)
                            <option value="{{$item->id}}" {{ old('category_id') == $item->id ? 'selected' : null }} >{{$item->name}}</option>
                        @endforeach
                    </select>          
                @error('category_id')
                    <div class="invalid-feedback fw-bold">
                        {{ $message }}
                     </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="author" class="form-label fw-bold">Pengarang</label>
                <input type="text" name="author" id="author" class="form-control @error ('author') is-invalid @enderror" placeholder="Pengarang"  value="{{ old('author') }}">
                @error('author')
                    <div class="invalid-feedback fw-bold">
                        {{ $message }}
                     </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="publisher" class="form-label fw-bold ">Penerbit</label>
                <input type="text" name="publisher" id="publisher" class="form-control @error ('publisher') is-invalid @enderror" placeholder="Penerbit" value="{{ old('publisher') }}">  
                @error('publisher')
                    <div class="invalid-feedback fw-bold">
                        {{ $message }}
                     </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="edition" class="form-label fw-bold ">Edisi</label>
                <input type="text" name="edition" id="edition" class="form-control @error ('edition') is-invalid @enderror" placeholder="Edisi" value="{{ old('edition') }}">  
                @error('edition')
                    <div class="invalid-feedback fw-bold">
                        {{ $message }}
                     </div>
                @enderror
            </div>              
            <div class="mb-3">
                <label for="publication_year" class="form-label fw-bold">Tahun Terbit</label>
                <input type="text" name="publication_year" id="publication_year" class="form-control @error ('publication_year') is-invalid @enderror" placeholder="Tahun Terbit" value="{{ old('publication_year') }}">
                @error('publication_year')
                    <div class="invalid-feedback fw-bold">
                        {{ $message }}
                     </div>
                @enderror
            </div>
            <div class="selectbox mb-3">
                <label for="cupboard" class="form-label fw-bold">Lokasi Buku</label>
                <div class="d-flex">
                <select class="form-select w-50 me-5 @error ('cupboard_id') is-invalid @enderror" name="cupboard_id">
                    <option value="" disabled selected> -Pilih Lemari- </option>
                    @foreach ($cupboards as $item)
                        <option value="{{$item->id}}" {{ old('cupboard_id') == $item->id ? 'selected' : null }} >{{$item->name}}</option>
                    @endforeach
                </select>          
                    @error('cupboard_id')
                        <div class="invalid-feedback fw-bold">
                            {{ $message }}
                        </div>
                    @enderror
                <select class="form-select w-50 @error ('rack_id') is-invalid @enderror" name="rack_id">
                    <option value="" disabled selected> -Pilih Rak- </option>
                    @foreach ($racks as $item)
                        <option value="{{$item->id}}" {{ old('rack_id') == $item->id ? 'selected' : null }} >{{$item->name}}</option>
                    @endforeach
                </select>          
                    @error('rack_id')
                        <div class="invalid-feedback fw-bold">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>
            <div class="selectbox mb-3">
                    <label for="book_condition" class="form-label fw-bold">Kondisi</label>
                    <select class="form-select @error('book_condition') is-invalid @enderror" name="book_condition" id="book_condition">
                        <option value="" disabled selected>- Pilih Kondisi -</option>
                        @foreach($conditions as $condition)
                            <option value="{{ $condition }}" {{ (isset($book) && $book->book_condition == $condition) || old('book_condition') == $condition ? 'selected' : null }}>
                                {{ $condition }}
                            </option>
                        @endforeach
                    </select>
                    @error('book_condition')
                        <div class="invalid-feedback fw-bold">
                            {{ $message }}
                        </div>
                    @enderror
            </div>                
            <div class="mb-3">
                <label for="image" class="form-label fw-bold">Sampul Buku</label>
                <input class="form-control @error ('image') is-invalid @enderror" type="file" id="image" name="image" onchange="previewImage()">
                @error('image')
                <div class="invalid-feedback fw-bold">
                    {{ $message }}
                 </div>
            @enderror
                <label for="image" class="form-label"></label>
                <img class="img-preview img-fluid mb-3 col-sm-5">
            </div>
            <div class="mb-4">
                <button class="btn btn-success btn-md me-3" type="submit"><i class="bi bi-file-earmark"></i> Simpan</button>
                <a href="/admin/books" class="btn btn-danger"> <i class="bi bi-x-circle-fill"></i> Batal </a>
            </div>
        </form>
    </div>

<script src="https://code.jquery.com/jquery-3.6.3.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
    $(document).ready(function() {
        $('.select-multiple').select2();
    });
</script>

<script>
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

</script>
@include('sweetalert::alert') 
@endsection