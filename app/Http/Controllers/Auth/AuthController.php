<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }

    public function postlogin(Request $request)
    {

        $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);

        if (Auth::attempt($request->only('email', 'password'))) {
            return redirect('/dashboard');
        }
        return redirect(route('login'))->with('gagal', 'Username atau Password salah');
    }

    public function logout()
    {
        Auth::logout();

        return redirect(route('login'));
    }

    public function register()
    {
        return view('auth.register');
    }

    public function postregister(Request $request)
    {

        $request->validate([
            'nama' => 'required',
            'email' => 'required',
            'password' => 'required'
        ]);

        if (Auth::attempt($request->only('nama','email', 'password'))) {
            return redirect('/dashboard');
        }
        return redirect(route('login'))->with('gagal', 'Username atau Password salah');
    }
}
