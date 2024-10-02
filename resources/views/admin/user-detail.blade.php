@extends('layouts.mainlayout')

@section('title', 'Detail Anggota')

@section('content')
    <h1></h1>
    <div class="mt-5">
        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}      
            </div>
        @endif
    </div>

<div class="container">
    <div class="row justify-content-start">
        <div class="col-md-7">
            <div class="card">
                <div class="card-header">{{ __('Profil') }}</div>

                <div class="card-body">
                    
                    @if(session('status'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('status') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @endif

                    <div class="row">
                        <div class="col-md-3">
                            @if($user->photo)
                                <img src="{{ asset('storage/photo/'.$user->photo) }}" class="img-thumbnail rounded mx-auto d-block">
                            @else
                                <img src="{{ asset('images/user.png') }}" class="img-thumbnail rounded mx-auto d-block">
                            @endif
                            
                        </div>
                        <div class="col-md-8">
                                <div class="row mb-3">
                                    <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Nomor Induk') }}</label>
                                    <div class="col-md-8">
                                        <input id="id" type="text" class="form-control" name="id" value="{{ $user->id }}" readonly>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Nama') }}</label>
                                    <div class="col-md-8">
                                        <input id="username" type="text" class="form-control" name="username" value="{{ $user->username }}" readonly>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email') }}</label>
                                    <div class="col-md-8">
                                        <input id="email" type="email" class="form-control" name="email" value="{{  $user->email }}" readonly>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="work" class="col-md-4 col-form-label text-md-end">{{ __('Pekerjaan') }}</label>
                                    <div class="col-md-8">
                                        <input id="work" type="work" class="form-control" name="work" value="{{ $user->work->name }}" readonly>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="gender" class="col-md-4 col-form-label text-md-end">{{ __('Jenis Kelamin') }}</label>
                                    <div class="col-md-8">
                                        <input id="gender" type="gender" class="form-control" name="gender" value="{{ $user->gender }}" readonly>
                                    </div>
                                </div>
                                @if($user->class)
                                <div class="row mb-3">
                                    <label for="class" class="col-md-4 col-form-label text-md-end">{{ __('Kelas') }}</label>
                                    <div class="col-md-8">
                                        <input id="class" type="class" class="form-control" name="class" value="{{  $user->class }}" readonly>
                                    </div>
                                </div>
                                @endif
                                <div class="row mb-4">
                                    <label for="address" class="col-md-4 col-form-label text-md-end">{{ __('Alamat') }}</label>
                                    <div class="col-md-8">
                                        <input id="address" type="address" class="form-control" name="address" value="{{ $user->address }}" readonly>
                                    </div>
                                </div>
                                <div class="row mb-0">
                                    <div class="col-md-8 offset-md-4">
                                        @if ($user->status == 'inactive')    
                                            <a href="/admin/user-approve/{{ $user->slug }}" class="btn btn-lg btn-success me-2"><i class="bi bi-check-circle-fill"></i> Terima</a>
                                            <a href="{{ route('user-cancel', $user->slug) }}" class="btn btn-lg btn-danger" data-confirm-delete="true"><i class="bi bi-x-circle"></i> Tolak</a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</div>

        <div class="mt-5 d-flex justify-content-start">
            @if ($user->status == 'active')
            <div class="mt-5">
                <h3 class="mb-3">Log Peminjaman Anggota</h3>
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
                                </tr>
                            </thead>
                            <tbody>
                            @if ($transactions->isEmpty())
                            <tr>
                                <td colspan="11" class="text-center"> Tidak ada data </td>
                            </tr>
                            @else
                            @foreach ($transactions as $item)
                                <tr>
                                    <td>{{ ++$i }}</td>
                                    <td>{{ $item->user->id }}</td>
                                    <td>{{ $item->user->username }}</td>
                                    <td>{{ $item->book->id }}</td>
                                    <td>{{ $item->book->title }}</td>
                                    <td>{{ $item->user->class }}</td>
                                    <td>{{ $item->user->work->name }}</td>
                                    <td>{{ $item->loan_date->isoFormat('DD MMMM Y')}}</td>
                                    <td>{{ $item->deadline->isoFormat('DD MMMM Y')}}</td>
                                    <td class="{{ $item->return_date == null ? 'text-bg-light' : ($item->deadline < $item->return_date ? 'text-bg-danger' : 'text-bg-success') }}">
                                    {{ $item->return_date ? $item->return_date->isoFormat('DD MMMM Y') : '-' }}
                                    </td>
                                    <td>
                                        {{ $item->deadline < $item->return_date ? $item->deadline->diffInDays($item->return_date) *1000 : 0 }}
                                    </td>                              
                                </tr>
                                @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
            </div>
            @endif
        </div>
        <div class="d-flex justify-content-center">
            {{ $transactions->links() }}<br/>
        </div>
        @include('sweetalert::alert')
@endsection