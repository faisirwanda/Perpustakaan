@extends('layouts.mainlayout')

@section('title', 'Tempat Buku')

@section('content')
    <div class="d-flex justify-content-between">
        <a href="cupboard-add" class="btn btn-md btn-primary"><i class="bi bi-plus-circle"></i> Tambah Lemari</a>
        <a href="rack-add" class="btn btn-md btn-info"><i class="bi bi-plus-circle"></i> Tambah Rak</a>
    </div>

    <div class="row my-4">
        <div class="col-md-6"> 
            <table class="table table-md table-light table-bordered table-hover w-100 me-5">
                <thead>
                    <tr>
                        <th style="width: 10px;">No. </th>
                        <th>Nama</th>
                        <th>Aksi</th>                    
                    </tr>
                </thead>
                <tbody>
                    @if ($cupboards->isEmpty())
                    <tr>
                        <td colspan="2" class="text-center"> Tidak ada data </td>
                    </tr>
                    @else
                    @foreach ($cupboards as $item)
                        <tr>
                            <td>{{ ++$i }}</td>
                            <td>{{ $item->name }}</td>
                            <td>
                                <a href="/admin/cupboard-edit/{{ $item->id }}" class="btn btn-sm btn-outline-warning"> <i class="bi bi-pencil-square"></i> Edit</a>
                            </td>
                        </tr>
                    @endforeach
                    @endif
                </tbody>
            </table>   
        </div> 
        <div class="col-md-6">
            <table class="table table-md table-light table-bordered table-hover w-100 ml-5" name="rack" >
                <thead>
                    <tr>
                        <th style="width: 10px;">No. </th>
                        <th>Nama</th>
                        <th>Aksi</th>                    
                    </tr>
                </thead>
                <tbody>
                    @if ($racks->isEmpty())
                    <tr>
                        <td colspan="2" class="text-center"> Tidak ada data </td>
                    </tr>
                    @else
                    @foreach ($racks as $item)
                        <tr>
                            <td>{{ ++$j }}</td>
                            <td>{{ $item->name }}</td>
                            <td>
                                <a href="/admin/rack-edit/{{ $item->id }}" class="btn btn-sm btn-outline-warning"> <i class="bi bi-pencil-square"></i> Edit</a>
                            </td>
                        </tr>
                    @endforeach
                    @endif
                </tbody>
            </table>
        </div>
    </div>

    @include('sweetalert::alert') 

    <div class="d-flex justify-content-center">
        {{ $racks->appends(['work_id' => request('work_id'), 'month' => request('month')])->links() }} 
   </div>
   @if ($racks->total() > $racks->perPage())
   <p class="text-center text-muted" style="font-size: 9pt">
       Menampilkan {{ $racks->firstItem() }} hingga {{ $racks->lastItem() }} dari {{ $racks->total() }} hasil
   </p>
   @endif
@endsection