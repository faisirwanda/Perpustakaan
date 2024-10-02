@extends('layouts.mainlayout')

@section('title', 'Book List')

@section('content')


    <form action="" method="get">
        <div class="row justify-content-end">
            <div class="col-12 col-sm-6">
                <select name="category" id="category" class="form-control">
                    <option value="">- Kategori Buku -</option>
                    @foreach ($categories as $item)
                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-12 col-sm-6">
                <div class="input-group mb-3">
                    <input type="text" name="title" class="form-control" placeholder="Judul Buku" >
                    <button class="btn btn-info" type="submit"><i class="bi bi-search"></i> Cari</button>
                  </div>
            </div>
        </div>
    </form>

    <div class="my-5">
        <div class="row">
            @foreach ($books as $item)    
                <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                    <div class="card" style="height: 24rem;">
                        <img src="{{ $item->cover != null ? asset('storage/cover/'.$item->cover) : asset('images/cover blank.png') }}" class="card-img-top mx-auto my-4  d-block" style="width: 150px; height: 200px;" draggable="false">
                        <div class="card-body">
                        <h5 class="card-title">{{ $item->id }}</h5>
                        <p class="card-text">{{ $item->title }}</p>
                        <p class="card-text text-end fw-bold {{ $item->status == 'Ada' ? 'text-success' : 'text-danger' }}">
                            {{ $item->status }}
                        </p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    @if(isset($errorMessage))
    <p class="text-center fs-1 text-danger fw-bold">{{ $errorMessage }}</p>
    @endif
    <div class="d-flex justify-content-center">
        {{ $books->links() }}<br/>
    </div>
@endsection