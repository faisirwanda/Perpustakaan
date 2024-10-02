@extends('layouts.main')

@section('title', 'Beranda')

@section('content')

    <section class="section-statistic mt-4" data-aos="fade-in" data-aos-anchor-placement="top-bottom">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8 text-center rounded  statistic-item">
                    <form class="input-group" action="" method="GET" >
                        <div class="input-container col-lg-12">
                            <input
                                type="text" id="search-input"
                                name="search" class="form-control form-control-lg"
                                placeholder="Masukkan kata kunci untuk mencari buku..." value="{{ request('search') }}">
                            <i class="bi bi-search search-icon"></i>
                        </div>
                    </form>                                        
                </div>
            </div>
        </div>
    </section>

    
    {{-- Tampilkan hasil pencarian jika ada --}}
@if (!empty(request('search')))
<section id="search-results" class="mt-5">
    <div class="my-5">
        <div class="row">
            <div class="col-12 text-center">
                <h2  class="mb-3">Hasil Pencarian</h2>
            </div>
            @php
                $displayedTitles = [];
            @endphp
            @foreach ($books as $item)
                @if (!in_array($item->title, $displayedTitles))
                    @php
                        $displayedTitles[] = $item->title;
                    @endphp
                <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                    <div class="card" style="height: 20rem;">
                        <img src="{{ $item->cover != null ? asset('storage/cover/'.$item->cover) : asset('images/cover blank.png') }}" class="card-img-top mx-auto my-3 d-block" style="width: 150px; height: 200px;" draggable="false">
                        <div class="card-body d-flex flex-column">
                            <div class="d-flex justify-content-center">
                                <p class="card-text fw-bold"><a href="/book-detail/{{ $item->slug }}" class="text-decoration-none text-dark">{{ $item->title }}</a></p>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
            @endforeach
        </div>
    </div>
    <div class="my-5">
        <div class="row">
            <div class="col-12 text-center">
                <h2 class="mb-3">Buku Terkait</h2>
            </div>
            @php
                $displayedTitles = [];
            @endphp
            @foreach ($relatedBooks as $item)
                @if (!in_array($item->title, $displayedTitles))
                    @php
                        $displayedTitles[] = $item->title;
                    @endphp
                <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                    <div class="card" style="height: 20rem;">
                        <img src="{{ $item->cover != null ? asset('storage/cover/'.$item->cover) : asset('images/cover blank.png') }}" class="card-img-top mx-auto my-3 d-block" style="width: 150px; height: 200px;" draggable="false">
                        <div class="card-body d-flex flex-column">
                            <div class="d-flex justify-content-center">
                                <p class="card-text fw-bold"><a href="/book-detail/{{ $item->slug }}" class="text-decoration-none text-dark">{{ $item->title }}</a></p>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
            @endforeach
        </div>
    </div>
</section>

@else 
{{-- buku rekomendasi --}}
<section id="rekomendasi" class="mt-5">
    <div class="my-5">
        <div class="row">
            <div class="col-12 text-center mb-5">
                <h2  class="mb-3">Buku Rekomendasi</h2>                
            </div>
            @php
                $displayedTitles = [];
            @endphp
            @foreach ($transactions as $item)
                @if (!in_array($item->book->title, $displayedTitles))
                    @php
                        $displayedTitles[] = $item->book->title;
                    @endphp
                    <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                        <div class="card" style="height: 20rem;">
                            <img src="{{ $item->book->cover != null ? asset('storage/cover/'.$item->book->cover) : asset('images/cover blank.png') }}" class="card-img-top mx-auto my-3 d-block" style="width: 150px; height: 200px;" draggable="false">
                            <div class="card-body d-flex flex-column">
                                <div class="d-flex justify-content-center">
                                    <p class="card-text fw-bold"><a href="/book-detail/{{ $item->book->slug }}" class="text-decoration-none text-dark">{{ $item->book->title }}</a></p>    
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
                @if (count($displayedTitles) >= 8)
                    @break
                @endif
            @endforeach
        </div>
    </div>
</section>

{{-- buku terbaru --}}
<section id="terbaru" class="mt-5">
    <div class="my-5">
        <div class="row">
            <div class="col-12 text-center mb-5">
                <h2  class="mb-3">Buku Terbaru</h2>
            </div>
            @php
                $displayedTitles = [];
            @endphp
                @foreach ($latestBooks as $item)
                    @if (!in_array($item->title, $displayedTitles))
                        @php
                            $displayedTitles[] = $item->title;
                        @endphp
                <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                    <div class="card" style="height: 20rem;">
                        <img src="{{ $item->cover != null ? asset('storage/cover/'.$item->cover) : asset('images/cover blank.png') }}" class="card-img-top mx-auto my-3 d-block" style="width: 150px; height: 200px;" draggable="false">
                        <div class="card-body d-flex flex-column">
                            <div class="d-flex justify-content-center">
                                <p class="card-text fw-bold"><a href="/book-detail/{{ $item->slug }}" class="text-decoration-none text-dark">{{ $item->title }}</a></p>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
                @if (count($displayedTitles) >= 8)
                    @break
                @endif
            @endforeach
        </div>
    </div>
</section>

@endif


    @if(!empty(request('search')) && isset($errorMessage))
    <p class="text-center fs-2 text-danger fw-bold">{{ $errorMessage }}</p>
    @endif

    <div class="d-flex justify-content-center">
        {{ $books->appends(['title' => request('title')])->links() }}<br/>
    </div>

    @if ($books->total() > $books->perPage())
        <p class="text-center text-muted" style="font-size: 9pt">
            Menampilkan {{ $books->firstItem() }} hingga {{ $books->lastItem() }} dari {{ $books->total() }} data
        </p>
    @endif

@endsection