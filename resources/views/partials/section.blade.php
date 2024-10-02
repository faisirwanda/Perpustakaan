{{-- <style>
  /* #barChart {
    width: 5px;
    height: 10px;
  } */
  .chart-container {
    position: relative;
    margin-top: 20rem;
    width: 100%;
    max-width: 800px; /* Atur lebar maksimum sesuai kebutuhan Anda */
    height: auto;
  }
  .chart-container canvas {
    position: absolute;
    left: 0;
    top: 0;
  }
</style> --}}

{{-- section category --}}
{{-- <section id="category">
    <div class="container">
      <div class="row">
        <div class="col-12 text-center">
            <h2>Kategoru Buku</h2>
          </div>
      </div>
      <div class="row mt-5">
        <div class="col-lg-3 col-md-6 mb-4 text-center">
          <div class="card-category">
            <div class="circle-icon position-relative mx-auto">
              <img src="{{ asset('storage/category/sastra_logo.png') }}" alt="" style="width: 80px;" class="position-absolute top-50 start-50 translate-middle">
            </div>
            <h3 class="mt-4">Sastra</h3>
          </div>
        </div>
        <div class="col-lg-3 col-md-6 mb-4 text-center">
          <div class="card-category">
            <div class="circle-icon position-relative mx-auto">
              <img src="{{ asset('storage/category/ilmu_murni.png') }}" alt="" style="width: 50px;" class="position-absolute top-50 start-50 translate-middle">
            </div>
            <h3 class="mt-4">Ilmu Murni</h3>
          </div>
        </div>
        <div class="col-lg-3 col-md-6 mb-4 text-center">
          <div class="card-category">
            <div class="circle-icon position-relative mx-auto">
              <img src="{{ asset('storage/category/karya_umum.png') }}" alt="" style="width: 70px;" class="position-absolute top-50 start-50 translate-middle">
            </div>
            <h3 class="mt-4">Karya Umum</h3>
          </div>
        </div>
        <div class="col-lg-3 col-md-6 mb-4 text-center" data-bs-toggle="modal" data-bs-target="#exampleModal">
          <div class="card-category">
            <div class="circle-icon position-relative mx-auto">
              <img src="{{ asset('storage/category/dots.png') }}" alt="" style="width: 70px;" class="position-absolute top-50 start-50 translate-middle">
            </div>
            <h3 class="mt-4">Lainnya</h3>
          </div>
        </div>
      </div>
    </div>
</section> --}}

<!-- Modal -->
{{-- <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4>Kategoru Buku</h4>        
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="container">
          <div class="row mt-5">
            <div class="col-lg-3 col-md-6 mb-4 text-center">
              <div class="card-category">
                <div class="circle-icon position-relative mx-auto">
                  <img src="{{ asset('storage/category/karya_umum.png') }}" alt="" style="width: 70px;" class="position-absolute top-50 start-50 translate-middle">
                </div>
                <h6 class="mt-4">Karya Umum</h6>
              </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-4 text-center">
              <div class="card-category">
                <div class="circle-icon position-relative mx-auto">
                  <img src="{{ asset('storage/category/filsafat.png') }}" alt="" style="width: 70px;" class="position-absolute top-50 start-50 translate-middle">
                </div>
                <h6 class="mt-4">Filsafat</h6>
              </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-4 text-center">
              <div class="card-category">
                <div class="circle-icon position-relative mx-auto">
                  <img src="{{ asset('storage/category/masjid.png') }}" alt="" style="width: 80px;" class="position-absolute top-50 start-50 translate-middle">
                </div>
                <h6 class="mt-4">Agama</h6>
              </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-4 text-center">
              <div class="card-category">
                <div class="circle-icon position-relative mx-auto">
                  <img src="{{ asset('storage/category/sastra_logo.png') }}" alt="" style="width: 80px;" class="position-absolute top-50 start-50 translate-middle">
                </div>
                <h6 class="mt-4">Sastra</h6>
              </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-4 text-center">
              <div class="card-category">
                <div class="circle-icon position-relative mx-auto">
                  <img src="{{ asset('storage/category/murni.png') }}" alt="" style="width: 70px;" class="position-absolute top-50 start-50 translate-middle">
                </div>
                <h6 class="mt-4">Ilmu Murni</h6>
              </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-4 text-center">
              <div class="card-category">
                <div class="circle-icon position-relative mx-auto">
                  <img src="{{ asset('storage/category/it.png') }}" alt="" style="width: 45px;" class="position-absolute top-50 start-50 translate-middle">
                </div>
                <h6 class="mt-4">Teknologi</h6>
              </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-4 text-center">
              <div class="card-category">
                <div class="circle-icon position-relative mx-auto">
                  <img src="{{ asset('storage/category/sejarah.png') }}" alt="" style="width: 45px;" class="position-absolute top-50 start-50 translate-middle">
                </div>
                <h6 class="mt-4">Sejarah</h6>
              </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-4 text-center">
              <div class="card-category">
                <div class="circle-icon position-relative mx-auto">
                  <img src="{{ asset('storage/category/seni.png') }}" alt="" style="width: 65px;" class="position-absolute top-50 start-50 translate-middle">
                </div>
                <h6 class="mt-4">Seni</h6>
              </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-4 text-center">
              <div class="card-category">
                <div class="circle-icon position-relative mx-auto">
                  <img src="{{ asset('storage/category/bhs.png') }}" alt="" style="width: 55px;" class="position-absolute top-50 start-50 translate-middle">
                </div>
                <h6 class="mt-4">Bahasa</h6>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div> --}}

{{-- Cari --}}
{{-- <section class="section-statistic mt-3" data-aos="fade-in" data-aos-anchor-placement="top-bottom">
  <div class="container">
      <div class="row justify-content-center">
          <div class="col-lg-8 text-center rounded  statistic-item">
              <form class="input-group" action="{{ route('index') }}" method="get" >
                  <div class="input-container col-lg-12">
                      <input
                          type="text" id="search-input"
                          name="title" class="form-control form-control-lg"
                          placeholder="Masukkan kata kunci untuk mencari buku..." value="{{ request('title') }}"/>
                      <i class="bi bi-search search-icon"></i>
                  </div>
              </form>                                        
          </div>
      </div>
  </div>
</section> --}}

{{-- rekomendasi setion --}}
{{-- <section id="rekomendasi" class="mt-5">
  <div class="container">
    <div class="row mb-4">
      <div class="col-12 text-center">
        <h2>Buku Rekomendasi</h2>
      </div>
    </div>
    <div class="row">
      @foreach ($recommendedBooks as $item)
      <div class="col-lg-3 col-md-4 mb-4 d-flex justify-content-center align-items-center">
        <div class="card p-2" style="width: 15rem; height: 20rem;">
          <img src="{{ $item->book->cover != null ? asset('storage/cover/'.$item->book->cover) : asset('images/cover blank.png') }}" class="card-img-top mx-auto my-1 d-block" style="width: 100px; height: 140px;" draggable="false">
            <div class="card-body">
                <h4>{{ $item->book->title }}</h4>
                <p class="mb-4 lh-sm">{{ $item->book->id }}</p>
                <p>{{ $item->count }}</p>
            </div>
            <div class="card-fasilitas d-flex justify-content-center px-2">
                <span>
                    <a href="#" class="btn btn-primary"><i class="bi bi-send-plus"></i> Ajukan Peminjaman</a>
                </span>
            </div>
        </div>
      </div>
      @endforeach
    </div>
  </div>
</section> --}}

{{-- <section id="rekomendasi" class="mt-5">
  <div class="container">
    <div class="row mb-4">
      <div class="col-12 text-center">
        <h2>Buku Rekomendasi</h2>
      </div>
    </div>
    <div class="row">
      @php
      $groupedBooks = $recommendedBooks->groupBy('book.title');
      @endphp
      
      @foreach ($groupedBooks as $title => $books)
      @php
      $firstBook = $books->first();
      @endphp
      <div class="col-lg-3 col-md-4 mb-4 d-flex justify-content-center align-items-center">
        <div class="card p-2" style="width: 15rem; height: 20rem;">
          <img src="{{ $firstBook->book->cover != null ? asset('storage/cover/'.$firstBook->book->cover) : asset('images/cover blank.png') }}" class="card-img-top mx-auto my-1 d-block" style="width: 150px; height: 200px;" draggable="false">
          <div class="card-body d-flex justify-content-center">
            <p class="card-text fw-bold">{{ $title }}</p>
          </div>
          <div class="card-fasilitas d-flex justify-content-center px-2">
          </div>
        </div>
      </div>
      @endforeach
    </div>
  </div>
</section> --}}



{{-- terbaru setion --}}
{{-- <section id="terbaru" class="mt-5">
  <div class="container mt-5">
    <div class="row mb-4">
      <div class="col-12 text-center">
        <h2>Buku Terbaru</h2>
      </div>
    </div>
    <div class="row">
      @foreach ($latestBooks as $item)
          <div class="col-lg-3 col-md-4 mb-4 d-flex justify-content-center align-items-center">
              <div class="card p-2" style="width: 15rem; height: 20rem;">
                  <img src="{{ $item->cover != null ? asset('storage/cover/'.$item->cover) : asset('images/cover blank.png') }}" class="card-img-top mx-auto my-1 d-block" style="width: 150px; height: 200px;" draggable="false">
                  <div class="card-body d-flex justify-content-center">
                      <p class="lh-sm fw-bold">{{ $item->title }}</p>
                  </div>
              </div>
          </div>
      @endforeach
  </div>
  </div>
</section> --}}

{{-- <section class="container-fluid col-lg-8 justify-content-center mb-5" style="margin-top: 10rem; margin-bottom: 3rem;">
  <div class="d-flex justify-content-center align-items-center mb-5">
    <h2>Statistik Peminjaman Buku</h2>
  </div>
  {!! $chart->container() !!}
  
<script src="{{ $chart->cdn() }}"></script>
{{ $chart->script() }}

</section> --}}


{{-- jika ingin nilai dari pencarian ada pada inputan --}}
{{-- <section class="section-statistic mt-3" data-aos="fade-in" data-aos-anchor-placement="top-bottom">
  <div class="container">
      <div class="row justify-content-center">
          <div class="col-lg-8 text-center rounded  statistic-item">
              <form class="input-group" action="" method="GET" >
                  <div class="input-container col-lg-12">
                      <input
                          type="text" id="search-input"
                          name="title" class="form-control form-control-lg"
                          placeholder="Masukkan kata kunci untuk mencari buku..." value="{{ request('title') }}">
                      <i class="bi bi-search search-icon"></i>
                  </div>
              </form>                                        
          </div>
      </div>
  </div>
</section> --}}

<section class="section-statistic mt-3" data-aos="fade-in" data-aos-anchor-placement="top-bottom">
  <div class="container">
      <div class="row justify-content-center">
          <div class="col-lg-8 text-center rounded  statistic-item">
              <form class="input-group" action="" method="GET" >
                  <div class="input-container col-lg-12">
                      <input
                          type="text" id="search-input"
                          name="title" class="form-control form-control-lg"
                          placeholder="Masukkan kata kunci untuk mencari buku...">
                      <i class="bi bi-search search-icon"></i>
                  </div>
              </form>                                        
          </div>
      </div>
  </div>
</section>

{{-- hasil pencarian --}}
{{-- <section id="rekomendasi" class="mt-5">
  <div class="my-5">
      <div class="row">
          <div class="col-12 text-center">
              <h4 class="mb-5">Hasil Pencarian : {{ request('title') }}</h4>
          </div>
          @foreach ($latestBooks as $item)
                  <div class="col-lg-3 col-md-4 col-sm-6 mb-4 d-flex justify-content-center align-items-center">
                      <div class="card" style="height: 20rem; width: 15rem;">
                          <img src="{{ $item->cover != null ? asset('storage/cover/'.$item->cover) : asset('images/cover blank.png') }}" class="card-img-top mx-auto my-3 d-block" style="width: 150px; height: 200px;" draggable="false">
                          <div class="card-body d-flex flex-column">
                              <div class="d-flex justify-content-center">
                                  <p class="card-text fw-bold">{{ $item->title }}</p>
                              </div>
                          </div>
                      </div>
                  </div>
          @endforeach
      </div>
  </div>
</section> --}}

@if (!empty(request('title')))
<section id="rekomendasi" class="mt-5">
  <div class="container my-5">
      <div class="row">
          <div class="col-12 text-center">
              <h2 class="mb-4">Hasil Pencarian : {{ request('title') }}</h2>
          </div>
          @php
              $displayedTitles = [];
          @endphp
          @foreach ($books as $item)
              @if (!in_array($item->book->title, $displayedTitles))
                  @php
                      $displayedTitles[] = $item->book->title;
                  @endphp
                  <div class="col-lg-3 col-md-4 col-sm-6 mb-4 d-flex justify-content-center">
                      <div class="card" style="height: 20rem; width: 15rem;">
                          <img src="{{ $item->book->cover != null ? asset('storage/cover/'.$item->book->cover) : asset('images/cover blank.png') }}" class="card-img-top mx-auto my-3 d-block" style="width: 150px; height: 200px;" draggable="false">
                          <div class="card-body d-flex flex-column">
                              <div class="d-flex justify-content-center">
                                  <p class="card-text fw-bold"><a href="/book-detail/{{ $item->book->slug }}" class="text-decoration-none text-dark">{{ $item->book->title }}</a></p>    
                              </div>
                          </div>
                      </div>
                  </div>
              @endif
              @if (count($displayedTitles) >= 4)
                  @break
              @endif
          @endforeach
      </div>
  </div>
</section>

@else

{{-- buku rekomendasi --}}
<section id="rekomendasi" class="mt-5">
  <div class="container my-5">
      <div class="row">
          <div class="col-12 text-center">
              <h2>Buku Rekomendasi</h2>
          </div>
          @php
              $displayedTitles = [];
          @endphp
          @foreach ($books as $item)
              @if (!in_array($item->book->title, $displayedTitles))
                  @php
                      $displayedTitles[] = $item->book->title;
                  @endphp
                  <div class="col-lg-3 col-md-4 col-sm-6 mb-4 d-flex justify-content-center">
                      <div class="card" style="height: 20rem; width: 15rem;">
                          <img src="{{ $item->book->cover != null ? asset('storage/cover/'.$item->book->cover) : asset('images/cover blank.png') }}" class="card-img-top mx-auto my-3 d-block" style="width: 150px; height: 200px;" draggable="false">
                          <div class="card-body d-flex flex-column">
                              <div class="d-flex justify-content-center">
                                  <p class="card-text fw-bold"><a href="/book-detail/{{ $item->book->slug }}" class="text-decoration-none text-dark">{{ $item->book->title }}</a></p>    
                              </div>
                          </div>
                      </div>
                  </div>
              @endif
              @if (count($displayedTitles) >= 4)
                  @break
              @endif
          @endforeach
      </div>
  </div>
</section>

{{-- buku terbaru --}}
<section id="terbaru" class="mt-5">
  <div class="container my-5">
      <div class="row mb-4">
          <div class="col-12 text-center">
              <h2>Buku Terbaru</h2>
          </div>
          @php
              $displayedTitles = [];
          @endphp
              @foreach ($latestBooks as $item)
                  @if (!in_array($item->title, $displayedTitles))
                      @php
                          $displayedTitles[] = $item->title;
                      @endphp
              <div class="col-lg-3 col-md-4 col-sm-6 mb-4 d-flex justify-content-center align-items-center">
                  <div class="card" style="height: 20rem; width: 15rem;">
                      <img src="{{ $item->cover != null ? asset('storage/cover/'.$item->cover) : asset('images/cover blank.png') }}" class="card-img-top mx-auto my-3 d-block" style="width: 150px; height: 200px;" draggable="false">
                      <div class="card-body d-flex flex-column">
                          <div class="d-flex justify-content-center">
                              <p class="card-text fw-bold"><a href="/book-detail/{{ $item->slug }}" class="text-decoration-none text-dark">{{ $item->title }}</a></p>
                          </div>
                      </div>
                  </div>
              </div>
              @endif
              @if (count($displayedTitles) >= 4)
                  @break
              @endif
          @endforeach
      </div>
  </div>
</section>


{{-- diagram --}}
<section class="container-fluid col-lg-8 justify-content-center mb-lg-5" style="margin-top: 10rem; margin-bottom: 3rem;">
  <div class="d-flex justify-content-center align-items-center mb-lg-5">
    <h2>Statistik Peminjaman Buku</h2>
  </div>
  {!! $chart->container() !!}
  
<script src="{{ $chart->cdn() }}"></script>
{{ $chart->script() }}
</section>
@endif


@if(isset($errorMessage))
  <p class="text-center fs-2 text-danger fw-bold">{{ $errorMessage }}</p>
@endif

<div class="d-flex justify-content-center">
  {{ $books->appends(['category' => request('category'), 'title' => request('title')])->links() }}<br/>
</div>

@if ($books->total() > $books->perPage())
  <p class="text-center text-muted" style="font-size: 9pt">
      Menampilkan {{ $books->firstItem() }} hingga {{ $books->lastItem() }} dari {{ $books->total() }} data
  </p>
@endif



