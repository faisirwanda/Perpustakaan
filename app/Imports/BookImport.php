<?php

namespace App\Imports;

use App\Models\Book;
use App\Models\Rack;
use App\Models\Category;
use App\Models\Cupboard;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\WithMappedCells;

class BookImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $categories = Category::where('name', $row['kategori'])->first();
        $cupboards = Cupboard::where('name', $row['lemari'])->first();
        $racks = Rack::where('name', $row['rak'])->first();

        if ($categories != null && $cupboards != null && $racks != null) {

            return new Book([
                'id'=>$row['kode'],
                'category_id'=>$categories['id'],
                'title'=>$row['judul'],
                'author'=>$row['pengarang'],
                'publisher'=>$row['penerbit'],
                'edition'=>$row['edisi'],
                'cupboard_id'=>$cupboards['id'],
                'rack_id'=>$racks['id'],
                'publication_year'=>$row['tahun'],
                'book_condition'=>$row['kondisi'],
                'status'=>$row['status'],
            ]);
        }
    }  
}
