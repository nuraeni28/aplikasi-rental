<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Auth, Session, Validator, Lang;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    //
    public function gate()
    {
        $check = Auth::check();
        // dd(Auth::user()->operasional_id);
        if($check)
            return redirect()->route('dashboard');
        else
            return redirect()->route('login');
    }
    public function index(Request $request)
    {

       $check = Auth::check();

        if($check)
            return redirect()->route('dashboard');
        else
            $judul = 'Login';
            // $datas = User::all();
            return view('login.index')->with(compact('judul'));

    }
    public function register(Request $request){
        $judul = 'Register';
        // $datas = User::all();
        return view('register.index')->with(compact('judul'));
    }
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'no_sim' => 'required',
            'password' => 'required|min:8',
        ]);
    
        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator);
        }
        $credentials = $request->only('no_sim', 'password');

        if (Auth::attempt($credentials)) {
            // Authenticated successfully
            return redirect()->intended('dashboard');
        } else {
            // Failed authentication
            
            return redirect()->back()->withInput()->withErrors(['message' => 'No SIM atau Password Salah']);
        }
    }
    public function registerStore(Request $request)
{
    // Validasi input
    $validator = Validator::make($request->all(), [
        'nama' => 'required',
        'no_sim' => 'required|unique:users,no_sim',
        'no_hp' => 'required',
        'alamat' => 'required',
        'password' => 'required|min:8',
    ]);

    // Cek kegagalan validasi
    if ($validator->fails()) {
        return redirect()->back()->withInput()->withErrors($validator);
    }

    // Cek apakah email atau username sudah ada
    $check = User::where('no_sim', $request->email)->first();
    if ($check) {
        return redirect()->back()->withInput()->withErrors('Account sudah Ada');
    }

    // Membuat pengguna baru
    $user = new User;
    $user->nama = $request->nama;
    $user->no_sim = $request->no_sim;
    $user->no_hp = $request->no_hp;
    $user->alamat = $request->alamat;
    $user->role = 'costumer';
    $user->password = Hash::make($request->password);
    $user->save();

    Session::flash('message', Lang::get('Registrasi Berhasil'));
    return redirect()->route('login')->with('success', 'Registrasi Berhasil');
}
     public function logout()
    {
        Auth::logout();
        Session::flush();
        return redirect()->route('login');
    }
}
