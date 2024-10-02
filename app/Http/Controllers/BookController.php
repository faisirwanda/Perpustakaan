<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Book;
use App\Models\Rack;
use App\Models\User;
use App\Models\Category;
use App\Models\Cupboard;
use App\Imports\BookImport;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Validators\ValidationException;


class BookController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $pagination = 20;

        $books = Book::where(function ($query) use ($search) {
            $query->where('title', 'like', '%' . $search . '%')
                ->orWhere('author', 'like', '%' . $search . '%')
                ->orWhere('publisher', 'like', '%' . $search . '%')
                ->orWhere('edition', 'like', '%' . $search . '%')
                ->orWhere('publication_year', 'like', '%' . $search . '%')
                ->orWhere('book_condition', 'like', '%' . $search . '%')
                ->orWhereHas('categories', function ($categoryQuery) use ($search) {
                    $categoryQuery->where('name', 'like', '%' . $search . '%');
                })
                ->orWhereHas('rack', function ($rackQuery) use ($search) {
                    $rackQuery->where('name', 'like', '%' . $search . '%');
                })
                ->orWhereHas('cupboard', function ($cupboardQuery) use ($search) {
                    $cupboardQuery->where('name', 'like', '%' . $search . '%');
                })
                ->orWhere('status', 'like', '%' . $search . '%');
        })
        ->with(['categories', 'cupboard', 'rack'])
        ->orderBy('created_at', 'desc')
        ->paginate($pagination);

        $books->appends(['search' => $search]); // Menambahkan parameter ke URL pagination

        return view('admin/book', ['books' => $books])
            ->with('i', ($request->input('page', 1) - 1) * $pagination);
    }
    
    public function add()
    {
        $catgeories = Category::all();
        $cupboards = Cupboard::all();
        $racks = Rack::all();
        $conditions = ['Baik', 'Rusak', 'Hilang'];
        return view('admin/book-add',['categories' => $catgeories, 'cupboards' => $cupboards, 'racks' => $racks, 'conditions' => $conditions]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'id' => 'required|unique:books|max:100',
            'title' => 'required|max:100',
            'category_id' => 'required|max:10',
            'author' => 'required|max:40',
            'publisher' => 'required|max:40',
            'edition' => 'required|max:40',
            'cupboard_id' => 'required|max:40',
            'rack_id' => 'required|max:40',
            'publication_year' => 'required|numeric',
            'book_condition' => 'required|max:40',
            'image' => 'required|mimes:jpg,jpeg,png',
        ],[
            'id.required'=>'Kode Buku Harus Diisi',
            'id.unique'=>'Kode Buku Sudah Ada',
            'title.required'=>'Judul Buku Harus Diisi',
            'category_id.required'=>'Kategori Buku Harus Diisi',
            'author.required'=>'Pengarang Buku Harus Diisi',
            'publisher.required'=>'Penerbit Buku Harus Diisi',
            'edition.required'=>'Edisi Buku Harus Diisi',
            'cupboard_id.required'=>'Lemari Buku Harus Diisi',
            'rack_id.required'=>'Rak Buku Harus Diisi',
            'publication_year.required'=>'Tahun Terbit Buku Harus Diisi',
            'publication_year.numeric'=>'Tahun Terbit Buku Hanya Berupa Angka',
            'book_condition.required'=>'Kondisi Buku Harus Diisi',
            'image.required'=>'Sampul Buku Harus Diisi',
            'image.mimes' => 'Sampul hanya diperbolehkan berkestensi JPG, JPEG, dan PNG',
        ]
        );

        $newName = '';
        if ($request->file('image')){
            $extension = $request->file('image')->getClientOriginalExtension();
            $newName = $request->title.'-'.now()->timestamp.'.'.$extension;
            $request->file('image')->storeAs('cover', $newName);
        }
    
        $request['cover'] = $newName;
        $book = Book::create($request->all());
        //$book->categories()->sync($request->categories);
        return redirect('admin/books')->with('success', 'Buku Berhasil Ditambahkan');
    
    }

    public function edit($slug)
    {
        $book = Book::where('slug', $slug)->first();
        $catgeories = Category::all();
        $cupboards = Cupboard::all();
        $racks = Rack::all();
        $conditions = ['Baik', 'Rusak', 'Hilang'];
        return view('admin/book-edit', ['categories' => $catgeories, 'book' => $book, 'cupboards' => $cupboards, 'racks' => $racks, 'conditions' => $conditions]);
    }

    public function update(Request $request, $slug)
    {
        $book = Book::where('slug', $slug)->first();
        $validated = $request->validate([
            'id' => [
                'required',
                Rule::unique('books')->ignore($book->id),
                'max:100',
            ],
            'title' => 'required|max:255',
            'category_id' => 'required|max:255',
            'author' => 'required|max:255',
            'publisher' => 'required|max:255',
            'edition' => 'required|max:255',
            'cupboard_id' => 'required|max:255',
            'rack_id' => 'required|max:255',
            'publication_year' => 'required|max:255',
            'book_condition' => 'required|max:255',
            'image' => 'mimes:jpg,jpeg,png',
        ],[
            'id.required'=>'Kode Buku Harus Diisi',
            'id.unique'=>'Kode Buku Sudah Ada',
            'id.max'=>'Kode Buku Maksimal 100 Karakter',
            'title.required'=>'Judul Buku Harus Diisi',
            'category_id.required'=>'Kategori Buku Harus Diisi',
            'author.required'=>'Pengarang Buku Harus Diisi',
            'publisher.required'=>'Penerbit Buku Harus Diisi',
            'edition.required'=>'Edisi Buku Harus Diisi',
            'cupboard.required'=>'Lemari Buku Harus Diisi',
            'rack.required'=>'Rak Buku Harus Diisi',
            'publication_year.required'=>'Tahun Terbit Buku Harus Diisi',
            'book_condition.required'=>'Kondisi Buku Harus Diisi',
            'image.mimes' => 'Sampul Buku Hanya Diperbolehkan Berkestensi JPG, JPEG, dan PNG',
        ]
        );

        if ($request->file('image')) {
            // Menghapus gambar lama jika ada
            if ($book->cover) {
                Storage::delete('cover/' . $book->cover);
            }

            $extension = $request->file('image')->getClientOriginalExtension();
            $newName = $request->title.'-'.now()->timestamp.'.'.$extension;
            $request->file('image')->storeAs('cover', $newName);
            $request['cover'] = $newName;
        }
        
        $book->slug = null;
        if ($request->id != $book->id) {
            Transaction::where('book_id', $book->id)->Delete();
            $book->status = 'Ada';
        }        
        $book->update($request->all());    
        return redirect('admin/books')->with('success', 'Buku Berhasil Diperbarui');        
    }

    public function import(Request $request)
    {
        // Memeriksa apakah file yang diunggah adalah file Excel
        $validator = Validator::make($request->all(), [
            'file' => 'required|mimes:xls,xlsx',
        ], [
            'file.required' => 'Anda harus memilih file untuk diunggah.',
            'file.mimes' => 'Format file yang diunggah harus dalam format Excel (xls, xlsx).',
        ]);

        if ($validator->fails()) {
            return redirect('admin/books')->withErrors($validator)->withInput();
        }

        try {
            // Memeriksa keberadaan header yang diperlukan
            $requiredHeaders = [
                'kategori',
                'kode',
                'judul',
                'pengarang',
                'penerbit',
                'tahun',
                'rak',
                'edisi',
                'kondisi',
                'status',
            ];

            $path = $request->file('file')->getPathname();
            Excel::import(new BookImport, $path);

            return redirect('admin/books')->with('success', 'Berhasil Mengimpor Data!');
        } catch (Exception $e) {
            $customErrorMessage = "Terjadi kesalahan saat mengimpor data: " . $e->getMessage();
            return redirect('admin/books')->with('error', $customErrorMessage);
            // return dd($e);
        }
    }

}
