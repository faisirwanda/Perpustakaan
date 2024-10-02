@extends('layouts.mainlayout')

@section('title', 'Anggota Baru')

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
                @if ($regiteredUsers->isEmpty())
                <tr>
                    <td colspan="11" class="text-center"> Tidak ada data </td>
                </tr>
                @else
                @foreach ($regiteredUsers as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->id }}</td>
                        <td>{{ $item->username }}</td>
                        <td>{{ $item->email }}</td>
                        <td>{{ $item->gender }}</td>
                        <td>{{ $item->work->name }}</td>
                        <td>
                            {{ $item->class ?: '-'}}
                        </td>                        
                        <td>{{ $item->address }}</td>
                        <td>
                            @if ($item->status == 'inactive')
                                Belum Aktif
                            @else
                                {{ $item->status }}
                            @endif
                        </td>                        
                        <td>
                            <a href="/admin/user-detail/{{ $item->slug }}" class="btn btn-sm btn-outline-info me-2"> <i class="bi bi-search"></i> Detail</a>
                            <a href="/admin/user-approve/{{ $item->slug }}" class="btn btn-sm btn-outline-success me-2"><i class="bi bi-check-circle-fill"></i> Terima</a>
                            <a href="{{ route('user-cancel', $item->slug) }}" class="btn btn-sm btn-outline-danger" data-confirm-delete="true"><i class="bi bi-x-circle"></i> Tolak</a>
                        </td>
                    </tr>
                @endforeach
                @endif
            </tbody>
        </table>
    </div>
    @include('sweetalert::alert')
@endsection