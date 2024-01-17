<?php

namespace App\Http\Controllers;

use App\Models\Mobil;
use App\Models\Peminjaman;
use App\Models\Pengembalian;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Validator, Session, Lang, Auth;

class PengembalianController extends Controller
{
    public function index()
    {
        $judul = 'Daftar Pengembalian';
        if(Auth::user()->role == 'admin'){
            $datas = Pengembalian::where('status',1)->get();
           }else{
            $datas = Pengembalian::where('status',1)->where('user_id',Auth::user()->id)->get();
           }
        $mobil = Mobil::all();
        return view('pengembalian.index')->with(compact('judul','datas','mobil'));
    }
    public function create(Request $request)
    {
        $nomorPol = $request->nopol;
        $peminjaman = Peminjaman::where('user_id', Auth::user()->id)->where('status',0)
    ->whereHas('mobil', function ($query) use ($nomorPol) {
        $query->where('nomor_plat', 'like', '%' . $nomorPol . '%');
    })
    ->first();
    if($peminjaman){
        $peminjaman->status=1;
        $peminjaman->save();
        $pengembalian = new Pengembalian();
        $pengembalian->tanggal_mulai = $peminjaman->tanggal_mulai;
            $pengembalian->tanggal_selesai = $peminjaman->tanggal_selesai;
            $pengembalian->mobil_id = $peminjaman->mobil_id;
            $pengembalian->user_id = $peminjaman->user_id;
            $pengembalian->status = 1;
            $pengembalian->biaya_sewa = $peminjaman->biaya_sewa;
            $pengembalian->save();
    
            Session::flash('message', Lang::get('Mobil Telah Dikembalikan'));
            return redirect()->route('pengembalian.index');

    }else{
        return redirect()->back()->withInput()->withErrors(['message' => 'Nomor Polisi Tidak DItemukan']);
    }
    // dd($peminjaman);
  
        
    
        
    }
    public function delete($id) {
        Pengembalian::find($id)->delete();
        return redirect()->route('pengembalian.index');
    }
}
