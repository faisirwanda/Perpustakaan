<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kartu Anggota</title>

    <style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f7f7f7;
        margin: 0;
        padding: 0;
    }

    .container {
        padding: 20px;
    }

    .card {
        border: 1px solid #dee2e6;
        border-radius: 5px;
        background-color: #fff;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .card-header {
        background-color: #007bff;
        color: #fff;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
        padding: 15px;
        border-top-left-radius: 5px;
        border-top-right-radius: 5px;
    }

    .card-body {
        padding: 1px; /* Reduksi padding menjadi 10px */
    }

    .img-thumbnail {
        border: none;
        border-radius: 0;
    }

    .table {
        width: 100%;
        margin-bottom: 0;
        color: #212529;
    }

    .table th {
        width: 100px; /* Reduksi lebar kolom menjadi 100px */
    }

    .table td {
        padding: 0;
        font-weight: bold;
    }

    .btn {
        display: inline-block;
        font-weight: 400;
        text-align: center;
        white-space: nowrap;
        vertical-align: middle;
        user-select: none;
        border: 1px solid transparent;
        padding: 0.375rem 0.75rem;
        font-size: 1rem;
        line-height: 1.5;
        border-radius: 0.25rem;
        transition: color 0.15s ease-in-out, background-color 0.15s ease-in-out, border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
    }

    .btn-danger {
        background-color: #dc3565;
        border-color: #dc3545;
        color: #fff;
    }

    .btn-danger:hover {
        background-color: #c82333;
        border-color: #bd2130;
    }

    </style>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="card" style="width: 450px; height: 225px;">
                    <div class="card-header">
                        <img src="images/sma.png" style="width: 45px; height: 45px; vertical-align: top;" >
                        Kartu Anggota Perpustakaan
                        <img src="images/lambang.png" style="width: 45px; height: 45px; vertical-align: top;" >
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-8">
                                <table style="margin-top: 10px;">
                                    <tr>
                                        <td rowspan="5" style="width: 60px; vertical-align: top;">
                                            <img src="{{ $user->photo ? ('storage/photo/'.$user->photo) : ('images/user.png' )}}" class="img-thumbnail rounded mx-auto d-block" style="width: 45px; height: 45px;">
                                        </td>
                                        
                                        <th style="text-align: left; width: 120px;">Nama</th>
                                        <td class="px-0 fw-bold">:</td>
                                        <td class="fw-bold">{{ $user->username }}</td>
                                    </tr>
                                    <tr>
                                        <th style="text-align: left; width: 120px;">Pekerjaan</th>
                                        <td class="px-0 fw-bold">:</td>
                                        <td class="fw-bold">{{ $user->work->name }}</td>
                                    </tr>
                                    <tr>
                                        <th style="text-align: left; width: 120px;">Jenis Kelamin</th>
                                        <td class="px-0 fw-bold">:</td>
                                        <td class="fw-bold">{{ $user->gender }}</td>
                                    </tr>
                                    <tr>
                                        <th style="text-align: left; width: 120px;">Kelas</th>
                                        <td class="px-0 fw-bold">:</td>
                                        <td class="fw-bold">{{ $user->class }}</td>
                                    </tr>
                                    <tr>
                                        <th style="text-align: left; width: 120px;">Alamat</th>
                                        <td class="px-0 fw-bold">:</td>
                                        <td class="fw-bold">{{ $user->address }}</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="script.js"></script>
</body>

</html>
