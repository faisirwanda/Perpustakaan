<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Book;
use App\Models\User;
use App\Models\Work;
use App\Models\Guest;
use Barryvdh\DomPDF\PDF;
use App\Models\BookOrder;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;

class UserController extends Controller
{
    //User
    // public function dashboard(Request $request)
    // {   
    //     $pagination = 20;
    //     $orders = BookOrder::with(['user', 'book'])->get();
    //     $transaction = Transaction::with(['user', 'book'])->where('user_id', Auth::user()->id)->orderBy('created_at', 'desc')->paginate($pagination);
    //     return view('user/dashboard-user', ['transaction' => $transaction, 'orders' => $orders])->with('i', ($request->input('page', 1) - 1) * $pagination); 
    // }

    public function dashboard(Request $request)
    {
        $search = $request->input('search');
        $pagination = 20;
        $errorMessage = '';
        $orders = BookOrder::all();
        $transactions = Transaction::all();
        $relatedBooks = [];
        $books = []; 

        $books = Book::where(function ($query) use ($search) {
            $query->where('title', 'like', '%' . $search . '%')
                ->orWhere('author', 'like', '%' . $search . '%')
                ->orWhere('id', 'like', '%' . $search . '%')
                ->orWhereHas('categories', function ($categoryQuery) use ($search) {
                    $categoryQuery->where('name', 'like', '%' . $search . '%');
                })
                
                ->orWhereHas('rack', function ($rackQuery) use ($search) {
                    $rackQuery->where('name', 'like', '%' . $search . '%');
                })
                ->orWhereHas('cupboard', function ($cupboardQuery) use ($search) {
                    $cupboardQuery->where('name', 'like', '%' . $search . '%');
                })
                ->orWhere('publisher', 'like', '%' . $search . '%')
                ->orWhere('edition', 'like', '%' . $search . '%')
                ->orWhere('publication_year', 'like', '%' . $search . '%')
                ->orWhere('book_condition', 'like', '%' . $search . '%')
                ->orWhere('status', 'like', '%' . $search . '%');
        })
        ->where('book_condition', 'Baik')
        ->with(['categories', 'transactions', 'rack', 'cupboard'])
        ->orderBy('title')
        ->paginate($pagination);

        $books->appends(['search' => $search]); // Menambahkan parameter ke URL pagination
        
        if ($books->isEmpty()) {
            $errorMessage = 'Buku Tidak Tersedia';
        } else {
            // Ambil beberapa buku terkait berdasarkan kategori atau penulis
            $relatedBooks = Book::where(function ($query) use ($search, $books) {
                // Kondisi untuk memfilter buku terkait
                $query->where('category_id', $books[0]->category_id) // Contoh: Ambil buku dengan kategori yang sama
                    ->orWhere('author', $books[0]->author); // Contoh: Ambil buku oleh penulis yang sama
            })
            ->where('id', '<>', $books[0]->id) // Hindari menampilkan buku yang sama
            ->limit(8) // Ambil 5 buku terkait
            ->get();
        }
        $bookIds = $books->pluck('id')->toArray();
        $bookSlugs = $books->pluck('slug')->toArray();
        return view('user/dashboard-user', ['books' => $books, 'relatedBooks' => $relatedBooks, 'errorMessage' => $errorMessage, 'orders' => $orders, 'bookIds' => $bookIds,
        'bookSlugs' => $bookSlugs, 'transactions'=>$transactions])
            ->with('i', ($request->input('page', 1) - 1) * $pagination);
    }

    public function profile_user()
    {
        $user = User::with([ 'work'])->findOrFail(Auth::id());
        return view('user/profile-user', ['user' => $user]);
    }

    public function profile_user_edit()
    {
        $user = User::with(['work'])->findOrFail(Auth::id());
        $works = Work::where('id', '!=', 1)->get();
        return view('user/profile-user-edit', ['user' => $user, 'works' => $works]);
    }


    public function profile_user_update(Request $request)
    {
        $user = User::with(['work'])->findOrFail(Auth::id()); 
        $transaction = Transaction::with(['user', 'book'])->where('user_id', $user->id)->first();  
        $validated = $request->validate([
            'id' => [
                'required',
                Rule::unique('users')->ignore($user->id),
                'max:255',
            ],
            'username' => 'required',
            'email' => [
                'required',
                'email',
                Rule::unique('users')->ignore(auth()->id()),
            ],
            'work_id' => 'required',
            'gender' => 'required',
            'class' => 'required',
            'address' => 'required',
            'password' => 'nullable|min:6|same:password_confirm',
            'password_confirm' => "nullable|min:6|same:password",
            'image' => 'mimes:jpg,jpeg,png',
        ],[
            'id.required'=>'Nomor Induk Harus Diisi',
            'id.unique'=>'Nomor Induk Sudah Ada',
            'id.max'=>'Kode Buku Maksimal 20 Karakter',
            'username.required'=>'Nama Pengguna Harus Diisi',
            'email.required'=>'Email Harus Diisi',
            'email.email'=>'Silahkan Masukan Email Yang Valid',
            'email.unique'=>'Email Sudah Pernah Digunakan Silahkan Pilih Email Yang Lain',
            'work_id.required'=>'Pekerjaan Harus Diisi',
            'gender.required'=>'Jenis Kelamin Harus Diisi',
            'class.required'=>'Kelas Harus Diisi',
            'address.required'=>'Alamat Harus Diisi',
            'password.min'=>'Password Minimum 6 Karakter',
            'password.same'=>'Password Tidak Valid',
            'password_confirm.min'=>'Konfirmasi Password Minimum 6 Karakter',
            'password_confirm.same'=>'Konfirmasi Password Tidak Valid',
            'image.mimes' => 'Foto hanya diperbolehkan berkestensi JPG, JPEG, dan PNG',
        ]);
        
        if ($request->file('image')) {
            // Menghapus gambar lama jika ada
            if ($user->photo) {
                Storage::delete('photo/' . $user->photo);
            }

            $extension = $request->file('image')->getClientOriginalExtension();
            $newName = $request->username . '-' . now()->timestamp . '.' . $extension;
            $request->file('image')->storeAs('photo', $newName);
            $request['photo'] = $newName;
        }

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->slug = null;

        if ($request->id != $user->id) {
            // Memperbarui status buku menjadi "Ada"
            if ($transaction) {
                $book = $transaction->book;
                $book->status = 'Ada';
                $book->save();
            }
        }

        // Menghapus transaksi
        if ($transaction) {
            $transaction->forceDelete();
        }

        $user->update($request->except('password')); // Kecuali field password pada pembaruan
        return redirect('user/profile-user')->with('success', 'Profil Berhasil Diperbarui');
    }

    public function card()
    {
        $user = User::with([ 'work'])->findOrFail(Auth::id());
        return view('user/card-user', ['user' => $user]);
    }

    public function print()
    { 
        $user = User::with('work')->findOrFail(Auth::id());
        $pdf = app()->make('dompdf.wrapper');
        $pdf->loadView('user.card-user-print', ['user' => $user]);
        return $pdf->download('kartu-'.Carbon::now()->timestamp.'.pdf');
    }

    //Admin 
    public function index(Request $request)
    {   
        $search = $request->input('search');
        $pagination = 20;

        $users = User::where(function ($query) use ($search) {
            $query->where('id', 'like', '%' . $search . '%')
                ->orWhere('username', 'like', '%' . $search . '%')
                ->orWhere('email', 'like', '%' . $search . '%')
                ->orWhere('gender', 'like', '%' . $search . '%')
                ->orWhere('address', 'like', '%' . $search . '%')
                ->orWhere('class', 'like', '%' . $search . '%');
        })
        ->with(['work'])
        ->where('role_id', 2)
        ->where('status', 'active')
        ->orderBy('created_at', 'desc')
        ->paginate($pagination);
        $users->appends(['search' => $search]);

        $newUserCount = User::where('role_id', 2)
        ->where('status', 'inactive')
        ->count();

        $title = 'Hapus Data!';
        $text = "Anda Yakin Ingin Menonaktifkan Anggota Ini?";
        confirmDelete($title, $text);

        return view('admin/user', ['users' => $users, 'newUserCount' => $newUserCount])
        ->with('i', ($request->input('page', 1) - 1) * $pagination);
    }

    public function profile_admin()
    {
        $user = User::where('id', Auth::user())->get();
        $user = User::with(['work'])->findOrFail(Auth::id());
        return view('admin/profile-admin', ['user' => $user]);

    }

    public function profile_admin_edit()
    {
        $user = User::where('id', Auth::user())->get();
        $user = User::with(['work'])->findOrFail(Auth::id());

        $works = Work::where('id', '!=', 1)->get();
        return view('admin/profile-admin-edit', ['user' => $user, 'works'=>$works]);

    }

    public function profile_admin_update(Request $request)
    {
        $validated = $request->validate([
            'id' => [
                'required',
                Rule::unique('users')->ignore(auth()->id()),
            ],
            'username' => 'required',
            'email' => [
                'required',
                'email',
                Rule::unique('users')->ignore(auth()->id()),
            ],
            'work_id' => 'required',
            'gender' => 'required', 
            'address' => 'required',
            'password' => 'nullable|min:6|same:password_confirm',
            'password_confirm' => "nullable|min:6|same:password",
            'image' => 'mimes:jpg,jpeg,png',
        ],[
            'id.required'=>'Nomor Induk Harus Diisi',
            'id.unique'=>'Nomor Induk Sudah Ada',
            'username.required'=>'Nama Pengguna Harus Diisi',
            'email.required'=>'Email Harus Diisi',
            'email.email'=>'Silahkan Masukan Email Yang Valid',
            'email.unique'=>'Email Sudah Pernah Digunakan Silahkan Pilih Email Yang Lain',
            'work_id.required'=>'Pekerjaan Harus Diisi',
            'gender.required'=>'Jenis Kelamin Harus Diisi',
            'address.required'=>'Alamat Harus Diisi',
            'password.min'=>'Password Minimum 6 Karakter',
            'password.same'=>'Password Tidak Valid',
            'password_confirm.min'=>'Konfirmasi Password Minimum 6 Karakter',
            'password_confirm.same'=>'Konfirmasi Password Tidak Valid',
            'image.mimes' => 'Foto hanya diperbolehkan berkestensi JPG, JPEG, dan PNG',
        ]);
        // $user=User::all();
        $user = auth()->user();
        
        if ($request->file('image')) {
            // Menghapus gambar lama jika ada
            if ($user->photo) {
                Storage::delete('photo/' . $user->photo);
            }
    
            $extension = $request->file('image')->getClientOriginalExtension();
            $newName = $request->username . '-' . now()->timestamp . '.' . $extension;
            $request->file('image')->storeAs('photo', $newName);
            $request['photo'] = $newName;
        }

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }
        $user->slug = null;
        $user->update($request->except('password')); // Kecuali field password pada pembaruan

        // $user->update($request->all());
        return redirect('admin/profile-admin')->with('success', 'Profil Berhasil Diperbarui');
    }

    public function registeredUser()
    {
        $title = 'Hapus Data!';
        $text = "Anda Yakin Ingin Menolak Calon Anggota Ini?";
        confirmDelete($title, $text);
        $registeredUsers = User::with(['work'])->where('status', 'inactive')->where('role_id', 2)->get();
        return view('admin/registered-user', ['regiteredUsers' => $registeredUsers]);
    }

    public function show($slug, Request $request)
    {
        $user = User::with(['work'])->where('slug', $slug)->first();
        //$user = User::where('slug', $slug)->first();
        $pagination = 10;
        $transactions = Transaction::with(['user', 'book'])->orderBy('created_at', 'desc')->where('user_id', $user->id)->paginate($pagination);
        
        return view('admin/user-detail', ['user' => $user, 'transactions' => $transactions])->with('i', ($request->input('page', 1) - 1) * $pagination);
    }

    public function approve($slug)
    {
        $user = User::where('slug', $slug)->first();
        $user->status = 'active';
        $user->save();
        return redirect('admin/registered-users')->with('success', 'Anggota Telah Diterima');
    }

    public function softdelete($slug)
    {
        $user = User::where('slug', $slug)->first(); 
        $user->status = 'nonactive'; // Tetapkan status menjadi nonactive
        $user->save();
        return redirect('admin/users')->with('success', 'Anggota Berhasil Dinonaktifkan');
    }
    

    public function bannedUser()
    {
        $title = 'Hapus Data!';
        $text = "Anda Yakin Ingin Menghapus Anggota Ini Secara Permanen?";
        confirmDelete($title, $text);

        $bannedUsers = User::where('status', 'nonactive')->get();
        return view('admin/user-banned', ['bannedUsers' => $bannedUsers] );
    }

    public function restore($slug){
        $user = User::where('slug', $slug)->first(); 
        $user->status = 'active'; // Tetapkan status menjadi nonactive
        $user->save();
        return redirect()->back()->with('success', 'Anggota Kembali Diaktifkan.');
    }
    
    public function destroy($slug)
    {
        $user = User::where('status', 'nonactive')->first();
        $user->Delete();
        return redirect()->back()->with('success', 'Anggota Berhasil Dihapus.');
    }

    public function cancel($slug)
    {
        $user = User::where('status', 'inactive')->first();
        $user->Delete();
        return redirect()->back()->with('success', 'Data berhasil dihapus.');
    }
    
    //Super
    public function admin(Request $request)
    {
        $pagination = 20;

        $admin = User::with(['work', 'role'])
        ->whereIn('work_id', [2,4])
        ->where('status', 'active')
        ->orderBy('created_at', 'desc')
        ->paginate($pagination);

        $title = 'Delete User!';
        $text = "Are you sure you want to delete?";
        confirmDelete($title, $text);

        return view('super/admin', ['admin' => $admin])
        ->with('i', ($request->input('page', 1) - 1) * $pagination);
    }

    public function admin_show($slug)
    {
        $admin = User::with(['work', 'role'])->where('slug', $slug)->first();
        return view('/super/admin-detail', ['admin' => $admin]);
    }

    public function admin_approve($slug)
    {
        $admin = User::where('slug', $slug)->first();
        $admin->role_id = '1';
        $admin->save();
        return redirect('super/admin')->with('success', 'Berhasil Menambah Admin');
    }

    public function admin_delete($slug)
    {
        $admin = User::where('slug', $slug)->first();
        $admin->role_id = '2';
        $admin->save();
        return redirect('super/admin')->with('success', 'Berhasil Mengahapus Admin');
    }

    public function profile_super()
    {
        $user = User::where('id', Auth::user())->get();
        $user = User::with([ 'work'])->findOrFail(Auth::id());
        return view('super/profile-super', ['user' => $user]);
    }

    public function profile_super_edit()
    {
        $user = User::where('id', Auth::user())->get();
        $user = User::with([ 'work'])->findOrFail(Auth::id());

        $works = Work::where('id', '!=', 3)->get();
        return view('super/profile-super-edit', ['user' => $user, 'works'=>$works]);
    }

    public function profile_super_update(Request $request)
    {
        $validated = $request->validate([
            'username' => 'required',
            'email' => [
                'required',
                'email',
                Rule::unique('users')->ignore(auth()->id()),
            ],
            'work_id' => 'required',
            'gender' => 'required',
            'address' => 'required',
            'password' => 'nullable|min:6|same:password_confirm',
            'password_confirm' => "nullable|min:6|same:password",
            'image' => 'mimes:jpg,jpeg,png',
        ],[
            'username.required'=>'Nama Pengguna Harus Diisi',
            'email.required'=>'Email Harus Diisi',
            'email.email'=>'Silahkan Masukan Email Yang Valid',
            'email.unique'=>'Email Sudah Pernah Digunakan Silahkan Pilih Email Yang Lain',
            'work_id.required'=>'Pekerjaan Harus Diisi',
            'gender.required'=>'Jenis Kelamin Harus Diisi',
            'address.required'=>'Alamat Harus Diisi',
            'password.min'=>'Password Minimum 6 Karakter',
            'password.same'=>'Password Tidak Valid',
            'password_confirm.min'=>'Konfirmasi Password Minimum 6 Karakter',
            'password_confirm.same'=>'Konfirmasi Password Tidak Valid',
            'image.mimes' => 'Foto hanya diperbolehkan berkestensi JPG, JPEG, dan PNG',
        ]);
        $user = auth()->user();
        
        if ($request->file('image')) {
            // Menghapus gambar lama jika ada
            if ($user->photo) {
                Storage::delete('photo/' . $user->photo);
            }
    
            $extension = $request->file('image')->getClientOriginalExtension();
            $newName = $request->username . '-' . now()->timestamp . '.' . $extension;
            $request->file('image')->storeAs('photo', $newName);
            $request['photo'] = $newName;
        }

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }
        $user->slug = null;
        $user->update($request->except('password')); // Kecuali field password pada pembaruan
        //$user->update($request->all()); //update semua
        return redirect('super/profile-super')->with('success', 'Profil Berhasil Diperbarui');
    }
}
