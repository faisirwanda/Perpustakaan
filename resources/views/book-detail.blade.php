@extends('layouts.main')

@section('title', 'Detail Buku')

@section('content')

<section id="profile" >
  <div class="container mt-5" >
      <div class="row justify-content-start">
          <div class="col-md-10">
              <div class="card mb-4 auto-height">
                <div class="card-header bg-dark text-white text-center fs-3 d-flex align-items-center">
                  {{ __('Detail Buku') }}
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
                                            $roundedRating = round($bookTitleAverageRating * 2) / 2;
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
                                
                                        @if (intval($bookTitleAverageRating) == $bookTitleAverageRating)
                                            ({{ number_format($bookTitleAverageRating) }})
                                        @else
                                            ({{ number_format($bookTitleAverageRating, 1) }})
                                        @endif
                                      </td>
                                </tr>                                  
                                <tr>
                                  <th style="width: 150px;" class="text-start">Total</th>
                                  <td style="width: 12px;" class=" fw-bold">:</td>
                                  <td class="text-start">{{ $bookTitleCounts }} Buku </td>
                                </tr>  
                                <tr>
                                  <th style="width: 150px;" class="text-start">Tersedia</th>
                                  <td style="width: 12px;" class=" fw-bold">:</td>
                                  <td class="text-start">{{ $bookTitleAvailable }} Buku </td>
                                </tr>  
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
        @foreach ($transactions->groupBy('book.title') as $bookTitle => $bookTransactions)
            @foreach ($bookTransactions as $item)
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
        @endforeach
    </div>
  </div>
</section>

@endsection