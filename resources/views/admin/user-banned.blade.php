@extends('layouts.mainlayout')

@section('title', 'Anggota Nonaktif')

@section('content')
    <div class="mt-5">
        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}      
            </div>
        @endif
    </div>

    <div class="my-5"> 
        <table class="table table-sm table-warning table-bordered table-hover">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Nomor Induk</th>
                    <th>Nama</th>                    
                    <th>Email</th>   
                    <th>Jenis Kelamin</th>
                    <th>Pekerjaan</th>
                    <th>Kelas</th>
                    <th>Alamat</th>
                    <th>Status</th>
                    <th>Aksi</th> 
                </tr>
            </thead>
            <tbody>
                @foreach ($bannedUsers as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->id }}</td>
                        <td>{{ $item->username }}</td>
                        <td>{{ $item->email }}</td>
                        <td>{{ $item->gender }}</td>
                        <td>{{ $item->work->name }}</td>
                        <td>{{ $item->class }}</td>
                        <td>{{ $item->address }}</td>
                        <td>
                            @if($item->status == 'nonactive')
                                Nonaktif
                            @else
                            
                            @endif
                        </td>
                        <td>
                            <a href="/admin/user-restore/{{ $item->slug }}" class="btn btn-outline-info me-3"> <i class="bi bi-arrow-counterclockwise"></i> Pulihkan</a>
                            <a href="{{ route('user-destroy', $item->slug) }}" class="btn btn-sm btn-outline-danger" data-confirm-delete="true"><i class="bi bi-trash"></i> Hapus</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @include('sweetalert::alert')
@endsection