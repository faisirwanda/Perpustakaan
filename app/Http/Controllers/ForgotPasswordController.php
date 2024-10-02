<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Password;
use Illuminate\Validation\ValidationException;

class ForgotPasswordController extends Controller
{
    public function index()
    {
        return view('auth.forgot-password');
    }

    public function send(Request $request)
    {
    try {
        $request->validate([
            'email' => 'required|email',
        ], [
            'email.required' => 'Email Harus Diisi',
            'email.email' => 'Silahkan Masukan Email Yang Valid',
        ]);

        // Cek apakah email telah dikirimkan link reset password sebelumnya
        if (DB::table('password_resets')->where('email', $request->email)->first()) {
            return back()->withErrors(['email' => 'Link reset password telah dikirimkan ke email tersebut. Silahkan periksa kotak masuk atau folder spam Anda.']);
        }

        $status = Password::sendResetLink($request->only('email'));

        $customMessages = [
            'passwords.user' => 'Pengguna dengan alamat email tersebut tidak ditemukan.',
            // Tambahkan pesan lainnya sesuai kebutuhan Anda
        ];

        return $status === Password::RESET_LINK_SENT
        // ? back()->with(['status' => __('Silahkan cek email anda untuk reset password.')])
        ? back()->with(['success' => __('Silahkan cek email anda untuk reset password.')])
        : back()->withErrors(['email' => $customMessages['passwords.user']]);
    } catch (ValidationException $e) {
        return back()->withErrors($e->errors());
    }
}

}
