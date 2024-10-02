<?php

namespace App\Exports;

use App\Models\Transaction;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\FromQuery;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;

// cara 1
// class TransactionExport implements FromCollection
// {
//     use Exportable;
//     /**
//     * @return \Illuminate\Support\Collection
//     */
//     public function collection()
//     {
//         return Transaction::all();
//     }
// }

//cara dengan Query
 class TransactionExport implements FromCollection, WithMapping, WithHeadings, WithColumnFormatting
{
    use Exportable;
    protected $workIds;
    private $index = 0;
    public function __construct(...$workIds)
    {
        $this->workIds = $workIds;
    }
    public function collection()
    {
        return Transaction::with(['user', 'book'])
            ->when(count($this->workIds) > 0, function ($query) {
                $query->whereHas('user.work', function ($subQuery) {
                    $subQuery->whereIn('id', $this->workIds);
                });
            })
            ->orderBy('created_at', 'desc')
            ->get();
    }
    public function map($transaction): array
    {
        $diffInDays = 0;
            if ($transaction->return_date && $transaction->deadline && $transaction->return_date < $transaction->deadline) {
                $diffInDays = $transaction->return_date->diffInDays($transaction->deadline) * 1000;
            }
        $diffInDaysFormatted = $diffInDays > 0 ? $diffInDays : '0';

        return [
            ++$this->index,
            $transaction->user->id,
            $transaction->user->username,
            $transaction->book->id,
            $transaction->book->title,
            $transaction->user->class ? $transaction->user->class : '-',
            $transaction->user->work->name,
            $transaction->loan_date ? $transaction->loan_date->isoFormat('DD MMMM Y') : null,
            $transaction->deadline ? $transaction->deadline->isoFormat('DD MMMM Y') : null,
            $transaction->return_date ? $transaction->return_date->isoFormat('DD MMMM Y') : '-',
            $transaction->book_condition ? $transaction->book_condition : '-', 
            $transaction->punishment ? $transaction->punishment : '0', 
            $transaction->description ? $transaction->description : '-', 
            // $diffInDaysFormatted, // Gunakan variabel yang telah diubah
            
        ];
    }
    public function columnFormats(): array
    {
        return [
            'J' => NumberFormat::FORMAT_NUMBER,
        ];
    }

    public function headings(): array
    {
        return [
            'No',
            'Nomor Induk',
            'Nama',
            'Kode Buku',
            'Judul Buku',
            'Kelas',
            'Pekerjaan',
            'Tanggal Peminjaman',
            'Tengat Waktu',
            'Tanggal Pengembalian',
            'Kondisi Buku',
            'Denda',
            'Keterangan',
        ];
    }
}
