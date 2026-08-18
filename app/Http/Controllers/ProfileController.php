<?php

namespace App\Http\Controllers;

use App\Models\Pelanggan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function index(){
        $pelanggan = Pelanggan::where('user_id', Auth::id())->firstorFail();
        return view('profile.index', compact('pelanggan'));
    }
    public function history(){
        $pelanggan = Pelanggan::where('user_id', Auth::id())->firstorFail();
        $booking = $pelanggan->penyewaans()
        ->with('mobil')->latest()->get();
        return view('profile.history', compact('booking'));
    }
}
