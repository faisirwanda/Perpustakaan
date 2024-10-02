@extends('layouts.mainlayout')

@section('title', 'Kelola Buku')

@section('content')
    
    <div class="container">
        <div class="row">
            <div class="col-md-7">
                <form action="book-import" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mt-4 d-flex align-items-center">
                        <a href="book-add" class="btn btn-primary col-3 me-4"><i class="bi bi-plus-circle"></i> Tambah</a>
                        <div class="input-group flex-grow-1">
                            <label for="file" class="form-label text-muted mt-2 me-2">Import Data</label>
                            <input type="file" name="file" id="file" class="form-control">
                            <button class="btn btn-success" type="submit"><i class="bi bi-upload"></i> Unggah</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-md-5">
                <form action="" method="get" class="d-flex">
                    <div class="mt-4 me-4 flex-fill">
                        <div class="input-group mb-3">
                            <input type="text" name="search" class="form-control" placeholder="Masukkan Kata Kunci" value="{{ request('search') }}">
                            <button class="btn btn-info" type="submit"><i class="bi bi-search"></i></button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    

    <div class="my-5">
        <table class="table table-md table-light table-bordered table-hover">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Kode Buku</th>
                    <th>Judul Buku</th>
                    <th>Kategori</th>
                    <th>Pengarang</th>
                    <th>Penerbit</th>
                    <th>Edisi</th>
                    <th>Tahun Terbit</th>
                    <th>Lokasi</th>
                    <th>Kondisi Buku</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @if ($books->isEmpty())
                        <tr>
                            <td colspan="12" class="text-center"> Tidak ada data </td>
                        </tr>
                    @else
                @foreach ($books as $item)
                <tr>
                    <td>{{ ++$i }}</td>
                    <td>{{ $item->id }}</p></td>
                    <td>{{ $item->title }}</p></td>
                    <td>{{ $item->categories->name }}</td>
                    <td>{{ $item->author }}</td>
                    <td>{{ $item->publisher }}</td>
                    <td>{{ $item->edition }}</td>
                    <td>{{ $item->publication_year }}</td>
                    <td>{{ $item->cupboard->name. ', ' .$item->rack->name  }}</td>
                    <td>{{ $item->book_condition }}</td>
                    <td>{{ $item->status }}</td>
                    <td>
                        <div class="d-flex ">
                            <a href="/admin/book-detail/{{ $item->slug }}" class="btn btn-sm btn-outline-info me-2"> <i class="bi bi-search"></i> Detail</a>
                            <a href="/admin/book-edit/{{ $item->slug }}" class="btn btn-sm btn-outline-warning"> <i class="bi bi-pencil-square"></i> Edit</a><br>
                            {{-- <a href="/book-delete/{{ $item->slug }}" class="btn btn-outline-danger"> <i class="bi bi-trash-fill"></i></a> --}}
                        </div>
                    </td>
                </tr>
                @endforeach
                @endif
            </tbody>
        </table>
    </div>
    <div class="d-flex justify-content-center">
         {{ $books->appends(['work_id' => request('work_id'), 'month' => request('month')])->links() }} 
    </div>
    @if ($books->total() > $books->perPage())
    <p class="text-center text-muted" style="font-size: 9pt">
        Menampilkan {{ $books->firstItem() }} hingga {{ $books->lastItem() }} dari {{ $books->total() }} hasil
    </p>
    @endif
    
    @include('sweetalert::alert')
@endsection