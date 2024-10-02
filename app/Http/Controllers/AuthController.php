<?php

namespace App\Http\Controllers;

use App\Models\ChoiceClass;
use App\Models\User;
use App\Models\Work;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;


class AuthController extends Controller
{
    public function login()
    {
        return view('login');
    }
    public function register()
    {
        $work = Work::where('id', '!=', 1)->get();
        return view('register',['work' => $work]);
    }

    public function authenticating(Request $request)
    {
        $credentials = $request->validate([
            'username' => ['required'],
            'password' => ['required'],
        ],[
            'username.required' => 'Nama Pengguna harus diisi',
            'password.required' => 'Password harus diisi',
        ]);       

        //cek validitas
        if (Auth::attempt($credentials)) {
            //cek status user

            if(Auth::user()->status == 'inactive'){
                Auth::logout();
                $request->session()->invalidate();
                $request->session()->regenerateToken();

               Session()->flash('status', 'failed');
               Session()->flash('message', 'Akun Anda Belum Aktif. Silahkan Menghubungi Admin!!');
               return redirect('login');
            }
            elseif(Auth::user()->status == 'nonactive'){
                Auth::logout();
                $request->session()->invalidate();
                $request->session()->regenerateToken();

               Session()->flash('status', 'failed');
               Session()->flash('message', 'Akun Anda dinonaktifkan. Silahkan Menghubungi Admin!!');
               return redirect('login');
            }

            $request->session()->regenerate();
            if(Auth::user()->role_id == 1){
                return redirect('admin/dashboard')->with('success', 'Berhasil Masuk Selamat Datang, '. Auth::User()->username );
            }
            if(Auth::user()->role_id == 2){
                return redirect('user/dashboard-user')->with('success', 'Berhasil Masuk Selamat Datang, '. Auth::User()->username );
            }
            if(Auth::user()->role_id == 3){
                return redirect('super/dashboard-super')->with('success', 'Berhasil Masuk Selamat Datang, '. Auth::User()->username );
            }
            //return redirect();
        }           
        Session()->flash('status', 'failed');
        Session()->flash('message', 'Nama Pengguna atau Password Salah!!');
        return redirect('login')->withInput();
    }


    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('login')->with('success', 'Berhasil Keluar');
    }

    public function registerProcess(Request $request)
    {
        $validated = $request->validate([
            'id' => 'required|unique:users|numeric',
            'username' => 'required',
            'email' => 'required|email|unique:users',
            'work_id' => 'required',
            'gender' => 'required',
            'class' => 'required_if:work_id,3', 
            'password' => 'required|min:8|same:password_confirm|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/',
            'password_confirm' => "required|min:8|same:password",
            'image' => 'required|mimes:jpg,jpeg,png',
        ],[
            'id.required'=>'Nomor Induk Harus Diisi',
            'id.unique'=>'Nomor Induk Telah Digunakan',
            'id.numeric'=>'Nomor Induk hanya Berupa Angka',
            'username.required'=>'Nama Pengguna Harus Diisi',
            'email.required'=>'Email Harus Diisi',
            'email.email'=>'Silahkan Masukan Email Yang Valid',
            'email.unique'=>'Email Sudah Pernah Digunakan Silahkan Pilih Email Yang Lain',
            'work_id.required'=>'Pekerjaan Harus Diisi',
            'gender.required'=>'Jenis Kelamin Harus Diisi',
            'class.required_if' => 'Kelas Harus Diisi',
            'address.required'=>'Alamat Harus Diisi',
            'password.required'=>'Password Harus Diisi',
            'password.min'=>'Password Minimum 8 Karakter',
            'password.same'=>'Password Tidak Cocok',
            'password.regex'=>'Password minimal memiliki huruf kapital, huruf kecil, dan angka.',
            'password_confirm.required'=>'Konfirmasi Password Harus Diisi',
            'password_confirm.min'=>'Konfirmasi Password Minimum 8 Karakter',
            'password_confirm.same'=>'Konfirmasi Password Tidak Cocok',
            'image.required'=>'Foto Harus Diisi',
            'image.mimes' => 'Foto hanya diperbolehkan berkestensi JPG, JPEG, dan PNG',
        ]);
        $request['password'] = Hash::make($request->password);

        // Cek jika work_id adalah 3, maka simpan 'class' ke dalam request
        if ($request->input('work_id') == 3) {
            $request['class'] = $request->input('class');
        } else {
            // Hapus 'class' dari request agar nilainya menjadi null saat disimpan
            $request->request->remove('class');
        }

        $newName = '';
            if ($request->file('image')){
                $extension = $request->file('image')->getClientOriginalExtension();
                $newName = $request->username.'-'.now()->timestamp.'.'.$extension;
                $request->file('image')->storeAs('photo', $newName);
            }

        $request['photo'] = $newName;

        $user = User::create($request->all());
        
        Session()->flash('status', 'success');
        return redirect('login')->with('message', 'Daftar Sukses Tunggu Admin Mengaktivasi Akun Anda!!');
    }
}
