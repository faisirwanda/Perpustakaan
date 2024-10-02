<?php

namespace App\Exports;

use App\Models\Guest;
use App\Models\Transaction;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class GuestExport implements FromCollection, WithMapping, WithHeadings
{
    use Exportable;
    private $index = 0;
    protected $workIds;

    public function __construct(...$workIds)
    {
        $this->workIds = $workIds;
    }

    public function collection()
    {
        return Guest::all();
    }

    public function map($guest): array
    {
        return [
            ++$this->index,
            $guest->username,
            $guest->created_at ? $guest->created_at->isoFormat('DD MMMM Y') : null,
        ];
    }
    public function headings(): array
    {
        return [
            'No',
            'Nama',
            'Waktu',
        ];
    }
}
