<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Pelanggan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showRegister()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'nama_pelanggan' => 'required',
            'email' => 'required|email|unique:users,email',
            'nik' => 'required|unique:pelanggans,nik',
            'nomor_hp' => 'required',
            'alamat' => 'required',
            'password' => 'required|min:8|confirmed',
        ]);

        $user = User::create([
            'name' => $request->nama_pelanggan,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'user',
        ]);

        Pelanggan::create([
            'user_id' => $user->id,
            'nama_pelanggan' => $request->nama_pelanggan,
            'nik' => $request->nik,
            'nomor_hp' => $request->nomor_hp,
            'alamat' => $request->alamat,
        ]);
        Auth::login($user);
        $request->session()->regenerate();
        return redirect()->route('landing');
    }
        public function showLogin(){
            return view('auth.login');
        }
        public function login(Request $request)
        {
            $credentials = $request->validate([
                'email' => 'required|email',
                'password' => 'required',
            ]);

            if (Auth::attempt($credentials, $request->remember)) {
                $request->session()->regenerate();
                if(Auth::user()->role === 'admin'){
                    return redirect()->route('dashboard');
                }
                return redirect()->route('landing');
            }

            return back()->withErrors([
                'email' => 'Email atau password salah.',
            ])->onlyInput('email');
        }
        public function logout(Request $request){
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
            return redirect('/login');
        }
}