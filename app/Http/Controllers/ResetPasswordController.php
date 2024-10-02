<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Events\PasswordReset;

class ResetPasswordController extends Controller
{
    public function index(Request $request)
    {
        $token = $request->token;
        return view('auth.reset-password', ['token' => $token]);
    }
    
    public function update(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8|same:password_confirm|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/',
            'password_confirm' => 'required|min:8|same:password'
        ], [
            'token.required' => 'Token harus diisi',
            'email.required' => 'Email harus diisi',
            'email.email' => 'Email harus valid',
            'password.required' => 'Password harus diisi',
            'password.min' => 'Password minimal harus terdiri dari 8 karakter',
            'password.same' => 'Password tidak cocok',
            'password.regex'=>'Password minimal memiliki huruf kapital, huruf kecil, dan angka.',
            'password_confirm.required' => 'Konfirmasi password harus diisi',
            'password_confirm.min' => 'Password minimal harus terdiri dari 8 karakter',
            'password_confirm.same' => 'Konfirmasi password tidak cocok',
        ]);
        
        
        $message = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->forceFill([
                    'password' => Hash::make($password)
                ])->setRememberToken(Str::random(60));
        
                $user->save();
        
                event(new PasswordReset($user));
            }
        );

        $customMessages = [
            'passwords.token' => 'Token kadaluwarsa karena pernah digunakan.',
            // Tambahkan pesan lainnya sesuai kebutuhan Anda
        ];
        
        return $message === Password::PASSWORD_RESET
                ? redirect()->route('login')->with('success', 'Reset password berhasil. Silahkan masuk dengan password baru Anda')
                // ? redirect()->route('/')->with('status', 'success')->with('message', 'Reset password berhasil. Silakan masuk dengan password baru Anda.')
                // : back()->withErrors(['email' => [$message]]);
                : back()->withErrors(['email' => $customMessages['passwords.token']]);
    }
}
