<?php

namespace App\Http\Controllers;

use App\Models\Mobil;
use Illuminate\Http\Request;

class LandingController extends Controller
{
    public function index(){
        $mobil = Mobil::where('status','tersedia')->get();
        return view('landing.index',compact('mobil'));
    }
}
