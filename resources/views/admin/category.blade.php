@extends('layouts.mainlayout')

@section('title', 'Kategori Buku')

@section('content')
    
    {{-- <div class="mt-5 d-flex justify-content-start">
        <a href="category-add" class="btn btn-md btn-primary"><i class="bi bi-plus-circle"></i> Tambah</a>
    </div> --}}
    <style>
        .d-flex.justify-content-end {
            margin-left: auto;
        }
    </style>
    <div>
        <form action="" method="GET" class="mb-4" id="filterForm">
            <div class="d-flex justify-content-start mb-3">
                <a href="category-add" class="btn btn-md btn-primary"><i class="bi bi-plus-circle"></i> Tambah</a>
                <div class="d-flex align-items-center col-md-4 justify-content-end">
                    <div class="d-flex align-items-center input-group">
                        <input type="text" name="search" class="form-control" placeholder="Masukkan Kata Kunci" value="{{ request('search') }}">
                        <button class="btn btn-info" type="submit"><i class="bi bi-search"></i></button>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <div class="my-5"> 
        <table class="table table-md table-light table-bordered table-hover">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Kode Kategori</th>
                    <th>Nama</th>
                    <th>Aksi</th>                    
                </tr>
            </thead>
            <tbody>
                @if ($categories->isEmpty())
                <tr>
                    <td colspan="11" class="text-center"> Tidak ada data </td>
                </tr>
                @else
                @foreach ($categories as $item)
                    <tr>
                        <td>{{ ++$i }}</td>
                        <td>{{ $item->id }}</td>
                        <td>{{ $item->name }}</td>
                        <td>
                            <a href="/admin/category-edit/{{ $item->slug }}" class="btn btn-sm btn-outline-warning"> <i class="bi bi-pencil-square"></i> Edit</a>
                        </td>
                    </tr>
                @endforeach
                @endif
            </tbody>
        </table>
    </div>
    @include('sweetalert::alert') 

    <div class="d-flex justify-content-center">
        {{ $categories->appends(['work_id' => request('work_id'), 'month' => request('month')])->links() }} 
   </div>
   @if ($categories->total() > $categories->perPage())
   <p class="text-center text-muted" style="font-size: 9pt">
       Menampilkan {{ $categories->firstItem() }} hingga {{ $categories->lastItem() }} dari {{ $categories->total() }} hasil
   </p>
   @endif
    
@endsection