<?php

namespace App\Http\Controllers;

use App\Models\Mobil;
use Illuminate\Http\Request;
use Validator, Session, Lang;

class MobilController extends Controller
{
    public function index()
    {
        $judul = 'Daftar Mobil';
        $datas = Mobil::all();
        return view('mobil.index')->with(compact('judul','datas'));
    }
    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'merek' => 'required',
            'model' => 'required',
            'no_plat' => 'required',
            'tarif' => 'required',
        ]);
    
        if ($validator->fails()) {
            $validator->errors()->add('message', $validator);
            return redirect()->back()->withInput()->withErrors($validator);
        }
        $check = Mobil::where('nomor_plat', $request->no_plat)->first();
        if($check){
            return redirect()->back()->withInput()->withErrors(['message'=>'Mobil sudah Ada']);
        }else{
            // Membuat pengguna baru
            $mobil = new Mobil;
            $mobil->merek = $request->merek;
            $mobil->model = $request->model;
            $mobil->nomor_plat = $request->no_plat;
            $mobil->tarif_sewa = $request->tarif;
            // $mobil->ketersediaan = false;
            $mobil->save();
    
            Session::flash('message', Lang::get('Data Berhasil Masuk'));
            return redirect()->route('mobil.index');
        }
        
    }
    public function edit(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'merek' => 'required',
            'model' => 'required',
            'no_plat' => 'required',
            'tarif' => 'required',
        ]);
    
        if ($validator->fails()) {
            $validator->errors()->add('message', $validator);
            return redirect()->back()->withInput()->withErrors($validator);
        }
        $mobil = Mobil::where('id', $id)->first();
        $mobil->merek = $request->merek;
        $mobil->model = $request->model;
        $mobil->nomor_plat = $request->no_plat;
        $mobil->tarif_sewa = $request->tarif;
        // $mobil->ketersediaan = false;
        $mobil->save();
        // dd($user);
        // dd(Mail::to($user->email)->send(new sendRegister()));
            // Mengirim email
    
        Session::flash('message', Lang::get('Data Berhasil Diedit'));
        return redirect()->route('mobil.index');
    }
    public function delete($id) {
        Mobil::find($id)->delete();
        return redirect()->route('mobil.index');
    }
}
