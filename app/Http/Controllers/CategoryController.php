<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $pagination = 20;

        $categories = Category::where(function ($query) use ($search) {
            $query->where('id', 'like', '%' . $search . '%')
                ->orWhere('name', 'like', '%' . $search . '%');
        })
        ->orderBy('created_at', 'desc')
        ->paginate($pagination);
        $categories->appends(['search' => $search]);
        return view('admin/category', ['categories' => $categories])->with('i', ($request->input('page', 1) - 1) * $pagination);
    }

    public function add()
    {
        return view('admin/category-add');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'id' => 'required|unique:categories|numeric|max:1000',
            'name' => 'required|unique:categories|max:100',
        ],[
            'id.required'=>'Nomor Kategori Harus Diisi',
            'id.unique'=>'Nomor Kategori Telah Digunakan',
            'id.numeric'=>'Nomor Kategori hanya Berupa Angka',
            'id.max'=>'Nomor Kategori Maksimal 4 Digit',
            'name.required'=>'Nama Kategori Harus Diisi',
            'name.unique'=>'Nama Kategori Telah Digunakan',
            'id.max'=>'Nama Kategori Maksimal 4 Digit',
        ]);
        $category = Category::create($request->all());
        return redirect('admin/categories')->with('success', 'Kategori Berhasil Ditambahkan');
    }

    public function edit($slug)
    {
        $category = Category::where('slug', $slug)->first();
        return view('admin/category-edit', ['category' => $category]);
    }

    public function update(Request $request, $slug)
    {
        $category = Category::where('slug', $slug)->first();
        $validated = $request->validate([
            'id' => [
                'required',
                Rule::unique('categories')->ignore($category->id),
                'numeric',
                'max:1000',
            ],
            'name' => [
                'required',
                Rule::unique('categories')->ignore($category->id),
                'max:100',
            ],
        ],[
            'id.required' => 'Nomor Kategori Harus Diisi',
            'id.unique' => 'Nomor Kategori Telah Digunakan',
            'id.numeric' => 'Nomor Kategori hanya Berupa Angka',
            'id.max' => 'Nomor Kategori Maksimal 4 Digit',
            'name.required' => 'Nama Kategori Harus Diisi',
            'name.unique' => 'Nama Kategori Telah Digunakan',
        ]);

        // Perbarui nama kategori
        $category->name = $request->name;
        $category->slug = null;
        $category->save();

        $newCategory = null;
        if ($request->id != $category->id) {
            $newCategory = new Category([
                'id' => $request->id,
                'name' => $request->name,
                // Salin data lain yang perlu disalin dari kategori lama
            ]);
            $newCategory->save();
        }

        // Update Buku yang menggunakan kategori tersebut jika ID kategori berubah
        if ($newCategory) {
            Book::where('category_id', $category->id)
                ->update([
                    'category_id' => $newCategory->id,
                ]);
        }

        // Hapus kategori lama jika Anda membuat kategori baru
        if ($newCategory) {
            $category->delete();
        }

        return redirect('admin/categories')->with('success', 'Kategori Berhasil Diperbarui');
    }

}