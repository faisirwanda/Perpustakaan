<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <div class="mt-5">        
    
        <div>
            <table border="1" style="border-collapse: collapse; margin:auto">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nomor Induk</th>
                        <th>Nama</th>
                        <th>Keperluan</th>
                        <th>Pekerjaan</th>
                        <th>Kelas</th>
                        <th>Waktu</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($guests as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->user->id }}</td>
                            <td>{{ $item->user->username }}</td>
                            <td>{{ $item->necessity}}</td>
                            <td>{{ $item->user->work->name }}</td>
                            <td>
                                {{ $item->user->class ? $item->user->class : '-' }}
                            </td>
                            <td>
                                {{ $item->created_at->isoFormat('D MMMM Y | ') . str_pad($item->created_at->format('H'), 2, '0', STR_PAD_LEFT) . ':' . $item->created_at->format('i') }}
                                @if ($item->created_at->format('H') < 12)
                                    AM
                                @else
                                    PM
                                @endif
                            </td>
                        </tr>
                        @endforeach
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>

