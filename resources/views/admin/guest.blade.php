@extends('layouts.mainlayout')

@section('title', 'Buku Tamu')

@section('content')


    <div class="mt-5">
        
    <style>
        .d-flex.justify-content-end {
            margin-left: auto;
        }
    </style>
        <form action="" method="GET" class="mb-4" id="filterForm">
            <div class="d-flex justify-content-start mb-3">
                {{-- <a href="guest-add" class="btn btn-primary me-3"><i class="bi bi-plus-circle"></i> Tambah</a> --}}
                <div class="d-flex align-items-center col-md-6 justify-content-end">
                    {{-- <div class="d-flex align-items-center me-3">
                        <label for="work_id" class="form-label me-2 text-muted">Pekerjaan:</label>
                        <select name="work_id" id="work_id" class="form-select">
                            <option value="">Semua</option>
                            @foreach($works as $workId => $workName)
                                <option value="{{ $workId }}" {{ request('work_id') == $workId ? 'selected' : '' }}>{{ $workName }}</option>
                            @endforeach
                        </select>
                    </div> --}}
                    <div class="d-flex align-items-center">
                        <label for="date" class="form-label me-2 text-muted">Tanggal:</label>
                        <input type="date" name="date" id="date" class="form-control me-2" value="{{ request('date') }}">
                    </div>
                </div>
            </div>
        </form>        
    
        <div class="my-5">
            <table class="table table-md table-light table-bordered table-hover w-50">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Waktu</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($guests->isEmpty())
                        <tr>
                            <td colspan="7" class="text-center"> Tidak ada data </td>
                        </tr>
                    @else
                    @foreach ($guests as $item)
                        <tr>
                            <td>{{ ++$i }}</td>
                            <td>{{ $item->username }}</td>
                            <td>
                                {{ $item->created_at->isoFormat('D MMMM Y')}}
                            </td>
                        </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>

            <div class="mt-5 d-flex justify-content-start">
                @if(request('work_id') == '')
                    <a href="/export/guest/all" class="btn btn-md btn-success me-2"><i class="bi bi-filetype-xls"></i> Cetak Semua</a>
                @else
                <a href="{{ route('guest.exportByWorkId', ['work_id' => request('work_id')]) }}" class="btn btn-success">
                    <i class="bi bi-filetype-xls"></i> Cetak {{ $works[request('work_id')] }}
                </a>                
                @endif
            </div> 
            
        </div>
    </div>
    <div class="d-flex justify-content-center">
        {{ $guests->appends(['work_id' => request('work_id'), 'month' => request('month')])->links() }}<br/>
    </div>
    @if ($guests->total() > $guests->perPage())
        <p class="text-center text-muted" style="font-size: 9pt">
            Menampilkan {{ $guests->firstItem() }} hingga {{ $guests->lastItem() }} dari {{ $guests->total() }} hasil
        </p>
    @endif
    
    @include('sweetalert::alert')

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