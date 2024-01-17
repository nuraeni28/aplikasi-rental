<?php

namespace App\Http\Controllers;

use App\Models\Informasi;
use App\Models\JadwalKegiatan;
use App\Models\Mobil;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Validator, Session, Lang, Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $judul = 'Dashboard';
        $mobil = Mobil::all()->count();
        $pengguna = User::where('role', '!=', 'admin')->count();
        return view('dashboard.index')->with(compact('judul', 'mobil', 'pengguna'));
    }
    public function user()
    {
        $judul = 'Account';
        $pengguna = User::where('id', Auth::user()->id)->first();
        return view('pengguna.index')->with(compact('judul', 'pengguna'));
    }
 
}
