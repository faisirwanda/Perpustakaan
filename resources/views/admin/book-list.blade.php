@extends('layouts.mainlayout')

@section('title', 'List Buku')

@section('content')

    <form action="" method="GET" class="d-flex align-items-center">
        <div class="d-flex align-items-center col-md-12">
            <div class="input-group">        
            <input type="text" name="search" class="form-control" placeholder="Masukkan kata kunci untuk mencari buku..." value="{{ request('search') }}">
            <button class="btn btn-info" type="submit"><i class="bi bi-search"></i></button>
            </div>
        </div>
    </form>
    <div class="my-5">
        <div class="row">
            @foreach ($books as $item)
                <div class="card-book col-lg-3 col-md-4 col-sm-6 mb-4">
                    <div class="card" style="height: 25rem;">
                        <img src="{{ $item->cover != null ? asset('storage/cover/'.$item->cover) : asset('images/cover blank.png') }}" class="card-img-top mx-auto my-3 d-block" style="width: 150px; height: 200px;" draggable="false">
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title"><a href="/admin/book-detail/{{ $item->slug }}" class="text-decoration-none text-dark">{{ $item->id }}</a></h5>
                            <div class="d-flex justify-content-between">
                                {{-- <p class="card-text ">{{ $item->title }}</p> --}}
                                <p class="card-text"><a href="/admin/book-detail/{{ $item->slug }}" class="text-decoration-none text-dark">{{ $item->title }}</a></p>
                                <p class="card-text fw-bold">{{ $item->book_condition }}</p>
                            </div>
                            <p class="card-text text-end fw-bold {{ $item->status == 'Ada' ? 'text-success' : ($item->status == 'Dipesan' ? 'text-warning' : 'text-danger') }}">
                                {{ $item->status }}
                            </p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    
    @if (!empty(request('search')))
    <div class="my-5">
        <div class="row">
            <h2 class="mb-3">Buku Terkait</h2>
            @foreach ($relatedBooks as $item)
            @if (!in_array($item->id, $bookIds) && !in_array($item->slug, $bookSlugs))
                <div class="card-book col-lg-3 col-md-4 col-sm-6 mb-4">
                    <div class="card" style="height: 25rem;">
                        <img src="{{ $item->cover != null ? asset('storage/cover/'.$item->cover) : asset('images/cover blank.png') }}" class="card-img-top mx-auto my-3 d-block" style="width: 150px; height: 200px;" draggable="false">
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title"><a href="/admin/book-detail/{{ $item->slug }}" class="text-decoration-none text-dark">{{ $item->id }}</a></h5>
                            <div class="d-flex justify-content-between">
                                {{-- <p class="card-text ">{{ $item->title }}</p> --}}
                                <p class="card-text"><a href="/admin/book-detail/{{ $item->slug }}" class="text-decoration-none text-dark">{{ $item->title }}</a></p>
                                <p class="card-text fw-bold">{{ $item->book_condition }}</p>
                            </div>
                            <p class="card-text text-end fw-bold {{ $item->status == 'Ada' ? 'text-success' : ($item->status == 'Dipesan' ? 'text-warning' : 'text-danger') }}">
                                {{ $item->status }}
                            </p>
                        </div>
                    </div>
                </div>
                @endif
            @endforeach
        </div>
    </div>
    @endif

    @if(isset($errorMessage))
    <p class="text-center fs-2 text-danger fw-bold">{{ $errorMessage }}</p>
    @endif

    <div class="d-flex justify-content-center">
        {{ $books->appends(['category' => request('category'), 'title' => request('title')])->links() }}<br/>
    </div>
    
    @if ($books->total() > $books->perPage())
        <p class="text-center text-muted" style="font-size: 9pt">
            Menampilkan {{ $books->firstItem() }} hingga {{ $books->lastItem() }} dari {{ $books->total() }} hasil
        </p>
    @endif

@endsection

