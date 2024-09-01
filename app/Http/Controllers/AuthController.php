<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function viewLogin() {
        return view('auth.login');
    }

    public function viewRegister() {
        return view('auth.register');
    }

    public function viewChangePassword() {
        return view('auth.ganti-password');
    }

    public function changePassword(Request $request) {
        $request->validate([
            'current_password' => 'required',
            'password' => 'required',
        ], [
            'current_password.required' => "Password Lama harus diisi",
            'password.required'         => "Password Baru harus diisi",
        ]);

        $currentUser = User::where('id', Auth::user()->id)->first();
        $currentPassword = $currentUser->password;
        $currentPasswordIsSame = Hash::check($request->current_password, $currentPassword);

        if ($currentPasswordIsSame) {
            $update = $currentUser->update([
                "name" => Auth::user()->name,
                "role" => Auth::user()->role,
                "email" => Auth::user()->email,

                // Yang di update hanya password
                "password" => Hash::make($request->password),
            ]);

            if ($update) {
                return redirect('/ganti-password')->with('success', 'Berhasil mengubah password');
            }
        }

        return redirect('/ganti-password')->with('danger', 'Gagal mengubah password');

    }
}
