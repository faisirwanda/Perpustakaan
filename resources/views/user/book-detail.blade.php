@extends('layouts.mainlayout')

@section('title', 'Detail Buku')

@section('content')

{{-- <section id="profile">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
            <h2>Detail Buku</h2>
        </div>
      </div>
      <div class="row mt-3">
        <div class="col-lg-12 col-md-6 mb-4">
          <div class="card-profile">
            <div class="row">
                <div class="col-12">
                    
                    <table class="table table-bordered">
                      <thead>
                        <tr>
                          <th style="width: 150px;">
                            @if($book->cover)
                            <img src="{{ asset('storage/cover/'.$book->cover) }}" class="" style="width: 150px;">
                            @else
                            <img src="{{ asset('images/cover blank.png') }}" class="" style="width: 150px;" draggable="false">
                            @endif
                          </th>
                          <th></th>
                          <th></th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td ></td>
                          <td class="fw-bold">Judul</td>
                          <td>{{ $book->title }}</td>
                        </tr>
                        <tr>
                          <td ></td>
                          <td class="fw-bold">Kategori</td>
                          <td>{{ $book->author }}</td>
                        </tr>
                        <tr>
                          <td ></td>
                          <td class="fw-bold">Pengarang</td>
                          <td>{{ $book->author }}</td>
                        </tr>
                        <tr>
                          <td ></td>
                          <td class="fw-bold">Penerbit</td>
                          <td>{{ $book->publisher }}</td>
                        </tr>
                        <tr>
                        <tr>
                          <td ></td>
                          <td class="fw-bold">Edisi</td>
                          <td>{{ $book->edition }}</td>
                        </tr>
                          <td></td>
                          <td class="fw-bold">Tahun Terbit</td>
                          <td>{{ $book->publication_year }}</td>
                        </tr>
                        </tr>
                          <td></td>
                          <td class="fw-bold">Rak</td>
                          <td>{{ $book->rack }}</td>
                        </tr>
                      </tbody>
                    </table>

                  
                </div>
            </div>
          </div>
        </div>
      </div>
    </div>
</section> --}}

<head>
  <!-- ... Kode lainnya ... -->
  <style>
      .card-header {
          background-color: #007bff;
      }

      .card-body {
          padding: 20px;
      }

      .card-body .form-control {
          border: none;
          border-radius: 0;
          background-color: #f7f7f7;
      }

      .card-body .row {
          margin-bottom: 10px;
      }

      .btn-danger {
          background-color: #dc3565;
          border-color: #dc3545;
      }

      .btn-danger:hover {
          background-color: #c82333;
          border-color: #bd2130;
      }

      .text-white {
          color: #fff;
      }
  </style>
</head>

  <div class="container">
      <div class="row justify-content-start">
          <div class="col-md-10">
              <div class="card mb-4">
                <div class="card-header bg-dark text-white text-center fs-3 d-flex align-items-center">
                  {{-- {{ __('Detail Buku') }} --}}
                </div>
                  <div class="card-body">
                      <div class="row">
                          <div class="col-md-3">
                              @if($book->cover)
                                  <img src="{{ asset('storage/cover/'.$book->cover) }}" class="img-thumbnail rounded mx-auto d-block" style="border : none">
                              @else
                                  <img src="{{ asset('images/cover blank.png') }}" class="img-thumbnail rounded mx-auto d-block" style="border : none">
                              @endif    
                          </div>
                          <div class="col-md-8">
                              <table class="table table-borderless fs-6 mb-0">
                                  <tr>
                                      <th style="width: 150px;" class="text-start">Kode </th>
                                      <td style="width: 12px;" class=" fw-bold">:</td>
                                      <td class="text-start">{{ $book->id }}</td>
                                  </tr>
                                  <tr>
                                      <th style="width: 150px;" class="text-start">Judul </th>
                                      <td style="width: 12px;" class=" fw-bold">:</td>
                                      <td class="text-start">{{ $book->title }}</td>
                                  </tr>
                                  <tr>
                                      <th style="width: 150px;" class="text-start">Kategori</th>
                                      <td style="width: 12px;" class=" fw-bold">:</td>
                                      <td class="text-start">{{ $book->categories->name }}</td>
                                  </tr>
                                  <tr>
                                      <th style="width: 150px;" class="text-start">pengarang</th>
                                      <td style="width: 12px;" class=" fw-bold">:</td>
                                      <td class="text-start">{{ $book->author }}</td>
                                  </tr>
                                  <tr>
                                      <th style="width: 150px;" class="text-start">Penerbit</th>
                                      <td style="width: 12px;" class=" fw-bold">:</td>
                                      <td class="text-start">{{ $book->publisher }}</td>
                                  </tr>
                                  <tr>
                                      <th style="width: 150px;" class="text-start">Edisi</th>
                                      <td style="width: 12px;" class=" fw-bold">:</td>
                                      <td class="text-start">{{ $book->edition }}</td>
                                  </tr>
                                  <tr>
                                      <th style="width: 150px;" class="text-start">Tahun Terbit</th>
                                      <td style="width: 12px;" class=" fw-bold">:</td>
                                      <td class="text-start">{{ $book->publication_year }}</td>
                                  </tr>                                
                                  <tr>
                                      <th style="width: 150px;" class="text-start">Lokasi</th>
                                      <td style="width: 12px;" class=" fw-bold">:</td>
                                      <td class="text-start">{{ $book->cupboard->name . ", " . $book->rack->name }}</td>
                                  </tr>
                                  <tr>
                                    <th style="width: 150px;" class="text-start">Rating</th>
                                    <td style="width: 12px;" class=" fw-bold">:</td>
                                    <td class="text-start">
                                        @php
                                            $roundedRating = round($averageRating * 2) / 2; // Bulatkan nilai rata-rata rating dengan setengah bintang
                                        @endphp
                                
                                        @for ($i = 1; $i <= 5; $i++)
                                            @if ($i <= $roundedRating)
                                                <i class="bi bi-star-fill text-warning"></i>
                                            @elseif ($i - 0.5 == $roundedRating)
                                                <i class="bi bi-star-half text-warning"></i>
                                            @else
                                                <i class="bi bi-star text-warning"></i>
                                            @endif
                                        @endfor
                                
                                        @if (intval($averageRating) == $averageRating)
                                            ({{ number_format($averageRating) }})
                                        @else
                                            ({{ number_format($averageRating, 1) }})
                                        @endif
                                    </td>
                                  </tr>                                                                
                                  <tr>
                                    <th style="width: 150px;" class="text-start">Status</th>
                                    <td style="width: 12px;" class=" fw-bold">:</td>
                                    <td class="text-start {{ $book->status == 'Ada' ? 'text-success' : ($book->status == 'Dipesan' ? 'text-warning' : 'text-danger') }}
                                      "> {{ $book->status }}
                                    </td>
                                </tr>    
                                <tr>
                                  <th style="width: 150px;" class="text-start">Total</th>
                                  <td style="width: 12px;" class=" fw-bold">:</td>
                                  <td class="text-start">
                                      {{ $bookTitleCounts }} Buku
                                  </td>
                                </tr>  
                                <tr>
                                  <th style="width: 150px;" class="text-start">Tersedia</th>
                                  <td style="width: 12px;" class=" fw-bold">:</td>
                                  <td class="text-start">
                                      {{ $bookTitleAvailable }} Buku
                                  </td>
                                </tr>
                                {{-- <tr>
                                  <th style="width: 120px;" class="text-start"></th>
                                  <td class="text-start"><a href="https://ths.li/Ql5H4hW" target="_blank" class="text-decoration-none "><i class="bi bi-search"></i> Lihat Lokasi Buku</a>
                                  </td>
                              </tr>                          --}}
                              </table>                            
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </div>

  <div class="container mt-5">
    <h3>Komentar</h3>
    <div class="comment-box overflow-auto" style="max-height: 300px;">
            @foreach ($transactions as $item)
                <div class="media comment-box d-flex align-content-center" style="background-color: white; ">
                    @if ($item->user->photo)
                        <img src="{{ asset('storage/photo/'.$item->user->photo) }}" class="rounded-circle" style="border: 2px solid #000; width: 50px; height: 50px;">
                    @else
                        <img src="{{ asset('images/user.png') }}" class="mr-3 comment-avatar rounded-circle" style="border: 2px solid #000; width: 50px; height: 50px;">
                    @endif
                    <div class="ml-3">
                      <div class="d-flex">
                          <p class="fw-bold ms-1">{{ $item->user->username }}</p>
                          <p class="ms-3">{{ $item->updated_at->diffForHumans() }}</p>
                      </div>
                      <p class="ms-1" style="margin-top: -10px;">{{ $item->comment }}</p>
                  </div>
                </div>
            @endforeach
    </div>
  </div>

@endsection