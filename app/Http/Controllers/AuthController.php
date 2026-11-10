<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showLogin() {
        return view('logreg.login');
    }

    public function login(Request $request) {
        $validatedData = $request->validate([
            'username' => 'required|min:3|max:20',
            'password' => 'required',
        ]);

        $user = session('user');
        if ($user && $validatedData['username'] == $user['username'] && Hash::check($validatedData['password'], $user['password'])) {
            session(['logged_in' => true]);
            return redirect()->route('dashboard', ['username' => $validatedData['username']]);
        }

        return back()->withErrors(['login' => 'Username atau password salah.'])->withInput();
    }

    public function showRegister() {
        return view('logreg.register');
    }

    public function register(Request $request) {
        $validatedData = $request->validate([
            'username' => 'required|min:3|max:20',
            'password' => 'required',
            'email' => 'required|email',
        ]);

        session([
            'user' => [
                'username' => $validatedData['username'],
                'email' => $validatedData['email'],
                'password' => Hash::make($validatedData['password']),
                'created_at' => now()->toDateTimeString(), 
            ],
            'logged_in' => true,
        ]);
        return redirect()->route('dashboard', ['username' => $validatedData['username']]);
    }

    public function logout(Request $request) {
        $request->session()->forget('logged_in');
        return redirect('/login')->with('success', 'Berhasil logout!');
    }
}
