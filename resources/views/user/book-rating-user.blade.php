@extends('layouts.mainlayout')

@section('title', 'Penilaian Buku')

@section('content')

        <div class="my-5">
            <div class="row">
                @foreach ($transaction as $item)
                    <div class="col-lg-3 col-md-4 col-sm-6">
                        <div class="card" style="height: 25rem;">
                            <img src="{{ $item->book->cover != null ? asset('storage/cover/'.$item->book->cover) : asset('images/cover blank.png') }}" class="card-img-top mx-auto my-3 d-block" style="width: 150px; height: 200px;" draggable="false">
                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title">{{ $item->book->id }}</h5>
                                <div class="d-flex justify-content-between mb-3">
                                    <p class="card-text ">{{ $item->book->title }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>     
        
            <form action="" method="post">
            @csrf
            <div class="mb-3">
                <label for="rating" name="rating" id="rating-input" class="form-label fw-bold d-flex">Rating Buku</label>
                <span class="bintang">
                    <input type="radio" name="rating" id="rating-1" value="1" class="star-input visually-hidden">
                    <label for="rating-1">
                        <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-star-fill star" viewBox="0 0 16 16">
                            <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L0.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
                        </svg>
                    </label>
    
                    <input type="radio" name="rating" id="rating-2" value="2" class="star-input visually-hidden">
                    <label for="rating-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-star-fill star" viewBox="0 0 16 16">
                            <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L0.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
                        </svg>
                    </label>
    
                    <input type="radio" name="rating" id="rating-3" value="3" class="star-input visually-hidden">
                    <label for="rating-3">
                        <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-star-fill star" viewBox="0 0 16 16">
                            <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L0.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
                        </svg>
                    </label>
    
                    <input type="radio" name="rating" id="rating-4" value="4" class="star-input visually-hidden">
                    <label for="rating-4">
                        <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-star-fill star" viewBox="0 0 16 16">
                            <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L0.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
                        </svg>
                    </label>
    
                    <input type="radio" name="rating" id="rating-5" value="5" class="star-input visually-hidden">
                    <label for="rating-5">
                        <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-star-fill star" viewBox="0 0 16 16">
                            <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L0.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
                        </svg>
                    </label>
                </span>
            </div>
            <div class="mb-3">
                <label for="comment" class="form-label fw-bold">Komentar</label>
                <textarea name="comment" id="comment" class="form-control w-50" rows="3" >{{ old('comment') }}</textarea>
            </div>
            <div class="mb-4">
                <button class="btn btn-primary btn-md me-3" type="submit"><i class="bi bi-send"></i> Kirim</button>
                <a href="/user/book-history-loan-user" class="btn btn-danger"> <i class="bi bi-x-circle-fill"></i> Batal </a>
            </div>
        </form>
        
        @include('sweetalert::alert')
       
        <script>
            const stars = document.querySelectorAll('.bintang svg');
            const ratingInput = document.getElementById('rating-input');
        
            stars.forEach((star, index) => {
                star.addEventListener('click', () => {
                    const ratingValue = index + 1; // Nilai rating adalah indeks bintang + 1
                    ratingInput.value = ratingValue; // Set nilai rating di input tersembunyi
                    // Atur warna untuk bintang yang diklik (misalnya, kuning)
                    star.style.fill = 'gold';
        
                    // Atur warna untuk bintang-bintang sebelumnya
                    for (let i = 0; i < index; i++) {
                        stars[i].style.fill = 'gold';
                    }
        
                    // Atur warna untuk bintang-bintang setelahnya
                    for (let i = index + 1; i < stars.length; i++) {
                        stars[i].style.fill = 'gray'; // Warna lain atau sesuai keinginan Anda
                    }
                });
            });
        </script>

@endsection