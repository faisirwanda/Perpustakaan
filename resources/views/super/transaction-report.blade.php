@extends('layouts.mainlayout')

@section('title', 'Laporan Histori Peminjaman')

@section('content')
    
<div class="mt-5">
        <style>
            .d-flex.justify-content-end {
                margin-left: auto;
            }
        </style>
                    <form action="" method="GET" class="mb-4" id="filterForm">
                        <div class="d-flex justify-content-start mb-3">
                            <div class="d-flex align-items-center col-md-6 justify-content-end">
                                <div class="d-flex align-items-center me-3">
                                    <label for="work_id" class="form-label me-2 text-muted">Pekerjaan:</label>
                                    <select name="work_id" id="work_id" class="form-select">
                                        <option value="">Semua</option>
                                        @foreach($works as $workId => $workName)
                                            <option value="{{ $workId }}" {{ request('work_id') == $workId ? 'selected' : '' }}>{{ $workName }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="d-flex align-items-center">
                                    <label for="date" class="form-label me-2 text-muted">Tanggal:</label>
                                    <input type="date" name="date" id="date" class="form-control me-2" value="{{ request('date') }}">
                                </div>
                            </div>
                        </div>
                    </form>
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
                    @if ($transaction->isEmpty())
                    <tr>
                        <td colspan="11" class="text-center"> Tidak ada data </td>
                    </tr>
                    @else
                    @foreach ($transaction as $item)
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
            <div class="mt-5 d-flex justify-content-start">
                @if(request('work_id') == '')
                    <a href="transaction-export-super" class="btn btn-md btn-success me-2"><i class="bi bi-filetype-xls"></i> Cetak Semua</a>
                @else
                <a href="{{ route('transaction_super.exportByWorkId', ['work_id' => request('work_id')]) }}" class="btn btn-success">
                    <i class="bi bi-filetype-xls"></i> Cetak {{ $works[request('work_id')] }}
                </a>                
                @endif
            </div>
        </div>
    </div>

    <div class="d-flex justify-content-center">
        {{ $transaction->appends(['work_id' => request('work_id'), 'month' => request('month')])->links() }}<br/>
    </div>
    
    @if ($transaction->total() > $transaction->perPage())
        <p class="text-center text-muted" style="font-size: 9pt">
            Menampilkan {{ $transaction->firstItem() }} hingga {{ $transaction->lastItem() }} dari {{ $transaction->total() }} hasil
        </p>
    @endif

    <script>
        const workSelect = document.getElementById('work_id');
        const dateInput = document.getElementById('date');
        const filterForm = document.getElementById('filterForm');
    
        // Fungsi untuk melakukan auto submit form
        function autoSubmitForm() {
            filterForm.submit();
        }
    
        // Panggil fungsi autoSubmitForm saat nilai yang dipilih dalam select work_id berubah
        workSelect.addEventListener('change', autoSubmitForm);
    
        // Panggil fungsi autoSubmitForm saat nilai tanggal pada input date berubah
        dateInput.addEventListener('change', autoSubmitForm);
    </script>

    <script>
        // Fungsi untuk mengubah format tanggal menjadi "tanggal/bulan/tahun"
        function formatDateToIndonesianFormat(dateString) {
            const date = new Date(dateString);
            const day = String(date.getDate()).padStart(2, '0');
            const month = String(date.getMonth() + 1).padStart(2, '0');
            const year = date.getFullYear();

            return day + "/" + month + "/" + year;
        }

        // Panggil fungsi saat halaman dimuat
        document.addEventListener('DOMContentLoaded', function() {
            // Ambil nilai tanggal dari input date
            const selectedDateValue = document.getElementById('date').value;

            // Format tanggal dan tampilkan pada span dengan ID "formattedDate"
            const formattedDate = formatDateToIndonesianFormat(selectedDateValue);
            document.getElementById('formattedDate').textContent = formattedDate;
        });

        // Panggil fungsi saat nilai tanggal pada input date berubah
        document.getElementById('date').addEventListener('change', function() {
            const selectedDateValue = this.value;
            const formattedDate = formatDateToIndonesianFormat(selectedDateValue);

            // Update the hidden input value and the displayed formatted date
            this.value = selectedDateValue;
            document.getElementById('formattedDate').textContent = formattedDate;
        });
    </script>
    
@endsection