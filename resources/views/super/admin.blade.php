@extends('layouts.mainlayout')

@section('title', 'Kelola Admin')

@section('content')
    
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
                    <th>Alamat</th>
                    <th>Peran</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($admin as $item)
                    <tr>
                        <td>{{ ++$i }}</td>
                        <td>{{ $item->id }}</td>
                        <td>{{ $item->username }}</td>
                        <td>{{ $item->email }}</td>
                        <td>{{ $item->gender }}</td>
                        <td>{{ $item->work->name }}</td>
                        <td>{{ $item->address }}</td>
                        <td>{{ $item->role->name }}</td>
                        <td>
                            <a href="/super/admin-detail/{{ $item->slug }}" class="btn btn-sm btn-outline-info me-2"> <i class="bi bi-search"></i> Detail</a>
                            @if ($item->role->name === 'Anggota')
                            <a href="/super/admin-approve/{{$item->slug}}" class="btn btn-sm btn-outline-success"> <i class="bi bi-person-fill-add"></i> Jadikan Admin</a>
                            @else    
                            <form action="/super/admin-delete/{{$item->slug}}" method="get" class="d-inline">
                                @method('admin_delete')
                                @csrf
                                <button class="btn btn-sm btn-outline-danger"><i class="bi bi-person-fill-slash"></i> Hapus</button>
                            </form>
                            @endif
                            
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="d-flex justify-content-center">
        {{ $admin->appends(['work_id' => request('work_id'), 'month' => request('month')])->links() }}<br/>
    </div>
    @if ($admin->total() > $admin->perPage())
        <p class="text-center text-muted" style="font-size: 9pt">
            Menampilkan {{ $admin->firstItem() }} hingga {{ $admin->lastItem() }} dari {{ $admin->total() }} hasil
        </p>
    @endif
    @include('sweetalert::alert') 
@endsection