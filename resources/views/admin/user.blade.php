@extends('layouts.mainlayout')

@section('title', 'Anggota Perpustakaan')

@section('content')
    
    {{-- <div class="mt-5 d-flex justify-content-start">
        <a href="/admin/user-banned" class="btn btn-md btn-danger me-3"> <i class="bi bi-person-fill-x"></i> Anggota Nonaktif</a>
        <a href="/admin/registered-users" class="btn btn-md btn-primary position-relative">
            <i class="bi bi-person-add"></i></i>
            Anggota Baru
            @if ($newUserCount > 0)
            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                {{ $newUserCount }}
                <span class="visually-hidden">unread messages</span>
              </span>
            @endif
        </a>
    </div> --}}
    <style>
        .d-flex.justify-content-end {
            margin-left: auto;
        }
    </style>
    <div>
        <form action="" method="GET" class="mb-4" id="filterForm">
            <div class="d-flex justify-content-start mb-3">
                <a href="/admin/user-banned" class="btn btn-md btn-danger me-3"> <i class="bi bi-person-fill-x"></i> Anggota Nonaktif</a>
                <a href="/admin/registered-users" class="btn btn-md btn-primary position-relative">
                    <i class="bi bi-person-add"></i></i>
                    Anggota Baru
                    @if ($newUserCount > 0)
                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                        {{ $newUserCount }}
                        <span class="visually-hidden">unread messages</span>
                    </span>
                    @endif
                </a>
                <div class="d-flex align-items-center col-md-4 justify-content-end">
                    <div class="d-flex align-items-center input-group">
                        <input type="text" name="search" class="form-control" placeholder="Masukkan Kata Kunci" value="{{ request('search') }}">
                        <button class="btn btn-info" type="submit"><i class="bi bi-search"></i></button>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <div class="mt-5">
        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}      
            </div>
        @endif
    </div>

    <div class="my-5"> 
        <table class="table table-md table-light table-bordered table-hover">
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
                @if ($users->isEmpty())
                <tr>
                    <td colspan="11" class="text-center"> Tidak ada data </td>
                </tr>
                @else
                @foreach ($users as $item)
                    <tr>
                        <td>{{ ++$i }}</td>
                        <td>{{ $item->id }}</td>
                        <td>{{ $item->username }}</td>
                        <td>{{ $item->email }}</td>
                        <td>{{ $item->gender }}</td>
                        <td>{{ $item->work->name }}</td>
                        <td>
                            {{ $item->class ? $item->class : '-'}}
                        </td>
                        <td>{{ $item->address }}</td>
                        <td>
                            @if($item->status == 'active')
                                Aktif
                            @elseif($item->status == 'inactive')
                                Nonaktif
                            @else
                            
                            @endif
                        </td>
                        
                        <td>
                            <a href="user-detail/{{ $item->slug }}" class="btn btn-sm btn-outline-info me-2"> <i class="bi bi-search"></i> Detail</a>
                            <a href="{{ route('user-soft-delete', $item->slug) }}" class="btn btn-sm btn-outline-danger" data-confirm-delete="true"><i class="bi bi-person-fill-slash"></i> Nonaktifkan</a>  
                        </td>
                    </tr>
                @endforeach
                @endif
            </tbody>
        </table>
    </div>

    <div class="d-flex justify-content-center">
        {{ $users->appends(['work_id' => request('work_id'), 'month' => request('month')])->links() }} 
   </div>
   @if ($users->total() > $users->perPage())
   <p class="text-center text-muted" style="font-size: 9pt">
       Menampilkan {{ $users->firstItem() }} hingga {{ $users->lastItem() }} dari {{ $users->total() }} hasil
   </p>
   @endif

    @include('sweetalert::alert') 
@endsection