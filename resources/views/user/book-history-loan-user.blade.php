@extends('layouts.mainlayout')

@section('title', 'Riwayat Peminjaman Buku')

@section('content')

        <div class="mt-5">
            <div>
                <table class="table table-md table-light table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nomor Induk</th>
                            <th>Nama</th>
                            <th>Kode Buku</th>
                            <th>Judul Buku</th>
                            <th>Kelas</th>
                            <th>Pekerjaan</th>
                            <th>Tgl Peminjaman</th>
                            <th>Tengat Waktu</th>
                            <th>Tgl Pengembalian</th>
                            <th>Denda</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($transactions->isEmpty())
                        <tr>
                            <td colspan="12" class="text-center"> Tidak ada data </td>
                        </tr>
                        @else
                        @foreach ($transactions as $item)
                            <tr>
                                <td>{{ ++$i }}</td>
                                <td>{{ $item->user->id }}</td>
                                <td>{{ $item->user->username }}</td>
                                <td>
                                    <p class="card-text"><a href="/user/book-detail/{{ $item->book->slug }}" class="text-decoration-none text-dark">{{ $item->book->id }}</a></p>
                                </td>
                                <td>
                                    <p class="card-text"><a href="/user/book-detail/{{ $item->book->slug }}" class="text-decoration-none text-dark">{{ $item->book->title }}</a></p>    
                                </td>
                                <td>{{ $item->user->class }}</td>
                                <td>{{ $item->user->work->name }}</td>
                                <td>{{ $item->loan_date->isoFormat('DD MMMM Y')}}</td>
                                <td>{{ $item->deadline->isoFormat('DD MMMM Y')}}</td>
                                <td class="{{ $item->return_date == null ? 'text-bg-light' : ($item->deadline < $item->return_date ? 'text-bg-danger text-dark' : 'text-bg-success text-dark') }}">
                                {{ $item->return_date ? $item->return_date->isoFormat('DD MMMM Y') : '-' }}
                                </td>
                                <td>
                                    {{ $item->punishment ? $item->punishment : ($item->deadline < $item->return_date ? $item->deadline->diffInDays($item->return_date) * 1000 : 0) }}
                                </td>  
                                <td>
                                    @if ($item->book->status == 'Perpanjangan')
                                        @foreach ($orders as $order)
                                            @if ($order->book_id == $item->book->id && Auth::check() && Auth::user()->id == $order->user_id && (($item->deadline->isToday() || $item->deadline >= now()) && $item->return_date === null))
                                                <a href="/user/book-cancel-extra/{{ $item->book->slug }}" class="btn btn-sm btn-danger" style="font-size: 8pt;"><i class="bi bi-send-x"></i> Batal Perpanjangan</a>
                                            @endif
                                        @endforeach    
                                    @elseif($item->deadline->isToday() && $item->return_date === null)
                                    {{-- @elseif(($item->deadline->isToday() || $item->deadline >= now()) && $item->return_date === null) --}}
                                        <a href="/user/book-loan-extra/{{ $item->book->slug }}" class="btn btn-sm btn-warning" style="font-size: 8pt;"><i class="bi bi-send-plus"></i> Ajukan Perpanjangan</a>
                                    @endif

                                    @if( $item->rating === null && $item->return_date !== null && $item->coment === null )
                                    <a href="/user/book-rating-user/{{ $item->id }}" class="btn btn-sm btn-primary" style="font-size: 8pt;"><i class="bi bi-star"></i> Beri Penilaian</a>
                                    @endif
    
                                </td>                            
                            </tr>
                        @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
        </div>

        {{-- <div class="my-5">
            <div class="row">
                <h2 class="mb-3">Buku Terkait</h2>
                @foreach ($relatedBooks as $item)
                    <div class="card-book col-lg-3 col-md-4 col-sm-6 mb-4">
                        <div class="card" style="height: 26rem;">
                            <img src="{{ $item->cover != null ? asset('storage/cover/'.$item->cover) : asset('images/cover blank.png') }}" class="card-img-top mx-auto my-3 d-block" style="width: 150px; height: 200px;" draggable="false">
                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title"><a href="/user/book-detail/{{ $item->slug }}" class="text-decoration-none text-dark">{{ $item->id }}</a></h5>
                                <div class="d-flex justify-content-between">
                                    <p class="card-text"><a href="/user/book-detail/{{ $item->slug }}" class="text-decoration-none text-dark">{{ $item->title }}</a></p>
                                    <p class="card-text fw-bold {{ $item->status == 'Ada' ? 'text-success' : ($item->status == 'Dipesan' ? 'text-warning' : 'text-danger') }}">
                                        {{ $item->status }}
                                    </p>
                                </div>
                                @if ($item->status == 'Dipesan')
                                    @foreach ($orders as $order)
                                        @if ($order->book_id == $item->id && Auth::check() && Auth::user()->id == $order->user_id)
                                            <a href="/user/book-cancel/{{ $item->slug }}" class="btn btn-danger"><i class="bi bi-send-x"></i> Batal Pengajuan</a>
                                        @endif
                                    @endforeach    
                                @elseif($item->status == 'Ada')
                                    <a href="/user/book-loan/{{ $item->slug }}" class="btn btn-success"><i class="bi bi-send-plus"></i> Ajukan Peminjaman</a> 
                                @else

                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div> --}}

        <div class="my-5">
            <div class="row">
                <h2 class="mb-3">Buku Terkait</h2>
                @if (!$transactions->isEmpty()) {{-- Tampilkan buku terkait hanya jika pengguna pernah melakukan transaksi --}}
                @foreach ($relatedBooks as $item)
                    <div class="card-book col-lg-3 col-md-4 col-sm-6 mb-4">
                        <div class="card" style="height: 26rem;">
                            <img src="{{ $item->cover != null ? asset('storage/cover/'.$item->cover) : asset('images/cover blank.png') }}" class="card-img-top mx-auto my-3 d-block" style="width: 150px; height: 200px;" draggable="false">
                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title"><a href="/user/book-detail/{{ $item->slug }}" class="text-decoration-none text-dark">{{ $item->id }}</a></h5>
                                <div class="d-flex justify-content-between">
                                    <p class="card-text"><a href="/user/book-detail/{{ $item->slug }}" class="text-decoration-none text-dark">{{ $item->title }}</a></p>
                                    <p class="card-text fw-bold {{ $item->status == 'Ada' ? 'text-success' : ($item->status == 'Dipesan' ? 'text-warning' : 'text-danger') }}">
                                        {{ $item->status }}
                                    </p>
                                </div>
                                @if ($item->status == 'Dipesan')
                                    @foreach ($orders as $order)
                                        @if ($order->book_id == $item->id && Auth::check() && Auth::user()->id == $order->user_id)
                                            <a href="/user/book-cancel/{{ $item->slug }}" class="btn btn-danger"><i class="bi bi-send-x"></i> Batal Pengajuan</a>
                                        @endif
                                    @endforeach    
                                @elseif($item->status == 'Ada')
                                    <a href="/user/book-loan/{{ $item->slug }}" class="btn btn-success"><i class="bi bi-send-plus"></i> Ajukan Peminjaman</a> 
                                @else
        
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
                @else
                <div class="col-12">
                    <p class="text-center">Anda belum pernah melakukan peminjaman. Tidak ada buku terkait yang dapat ditampilkan.</p>
                </div>
                @endif
            </div>
        </div>
        
        
        @if(isset($errorMessage))
            <p class="text-center fs-2 text-danger fw-bold">{{ $errorMessage }}</p>
        @endif

        <div class="d-flex justify-content-center mt-5">
            {{ $transactions->appends(['work_id' => request('work_id'), 'month' => request('month')])->links() }}<br/>
        </div>
        
        @if ($transactions->total() > $transactions->perPage())
            <p class="text-center text-muted" style="font-size: 9pt">
                Menampilkan {{ $transactions->firstItem() }} hingga {{ $transactions->lastItem() }} dari {{ $transactions->total() }} hasil
            </p>
        @endif

        @include('sweetalert::alert')
@endsection