@extends('layouts.mainlayout')

@section('title', 'Surat Keterangan')

@section('content')
<a href="/message-print-non" class="btn btn-danger text-white mb-4"><i class="bi bi-file-earmark-pdf"></i> Cetak Non Anggota</a>
<table class="table table-md table-light table-bordered table-hover mt-2">
    <thead>
        <tr>
            <th>No.</th>
            <th>Nomor Induk</th>
            <th>Nama</th>                    
            <th>Kelas</th>
            <th>Buku Belum Dikembalikan</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @if ($user->isEmpty())
        <tr>
            <td colspan="11" class="text-center"> Tidak ada data </td>
        </tr>
    @else
        @foreach ($user as $item)
            <tr>
                <td>{{ ++$i }}</td>
                <td>{{ $item->id }}</td>
                <td>{{ $item->username }}</td>
                <td>
                    {{ $item->class ? $item->class : '-'}}
                </td>
                @php
                    $trans = $item->transactions->where('return_date', null)->all();
                @endphp
                <td>
                    @if (count($trans) > 0)
                        <p>{{ count($trans) }}</p>
                    @else
                        <p> 0 </p>
                    @endif

                </td>
                <td>
                    @if (count($trans) > 0)
                        <a href="/message-print/{{ $item->id }}" class="btn btn-danger text-white disabled"><i class="bi bi-file-earmark-pdf"></i> Cetak</a>
                    @else
                        <a href="/message-print/{{ $item->id }}" class="btn btn-danger text-white"><i class="bi bi-file-earmark-pdf"></i> Cetak</a>
                    @endif
                </td>
            </tr>
        @endforeach    
    @endif
    </tbody>
</table>
@endsection