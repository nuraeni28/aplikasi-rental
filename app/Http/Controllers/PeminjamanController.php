<?php

namespace App\Http\Controllers;

use App\Models\Mobil;
use App\Models\Peminjaman;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Validator, Session, Lang, Auth;

class PeminjamanController extends Controller
{
    public function index()
    {
        $judul = 'Daftar Peminjaman';
       if(Auth::user()->role == 'admin'){
        $datas = Peminjaman::all();
       }else{
        $datas = Peminjaman::where('user_id',Auth::user()->id)->get();
       }
        $mobil = Mobil::all();
        return view('peminjaman.index')->with(compact('judul','datas','mobil'));
    }
    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'mulai' => 'required',
            'selesai' => 'required',
            'mobil' => 'required',
        ]);
    
        if ($validator->fails()) {
            $validator->errors()->add('message', $validator);
            return redirect()->back()->withInput()->withErrors($validator);
        }
        $mobil = Mobil::where('id', $request->mobil)->first();
        $tanggalMulai = Carbon::parse($request->mulai);
        $tanggalSelesai = Carbon::parse($request->selesai);
        
        // Cek apakah ada peminjaman yang bertabrakan
        $conflictingPeminjaman = Peminjaman::where('mobil_id', $request->mobil)
            ->where(function ($query) use ($tanggalMulai, $tanggalSelesai) {
                $query->whereBetween('tanggal_mulai', [$tanggalMulai, $tanggalSelesai])
                    ->orWhereBetween('tanggal_selesai', [$tanggalMulai, $tanggalSelesai])
                    ->orWhere(function ($query) use ($tanggalMulai, $tanggalSelesai) {
                        $query->where('tanggal_mulai', '<=', $tanggalMulai)
                            ->where('tanggal_selesai', '>=', $tanggalSelesai);
                    });
            })
            ->first();
        
        if ($conflictingPeminjaman) {
            return redirect()->back()->withInput()->withErrors(['message' => 'Mobil tidak tersedia pada rentang tanggal yang diminta']);
        }
        
        // Jika tidak ada peminjaman yang bertabrakan, buat peminjaman baru
        $peminjaman = new Peminjaman;
        $peminjaman->tanggal_mulai = $request->mulai;
        $peminjaman->tanggal_selesai = $request->selesai;
        $peminjaman->mobil_id = $request->mobil;
        $peminjaman->user_id = Auth::user()->id;
        
        // Hitung biaya sewa
        $selisihHari = $tanggalMulai->diffInDays($tanggalSelesai);
        $peminjaman->biaya_sewa = ($selisihHari + 1) * $mobil->tarif_sewa;
        
        $peminjaman->status = 0;
        $peminjaman->save();
    
            Session::flash('message', Lang::get('Anda Berhasil Mengajukan Peminjaman'));
            return redirect()->route('peminjaman.index');
        // }
        
    }
    public function delete($id) {
        Peminjaman::find($id)->delete();
        return redirect()->route('peminjaman.index');
    }
}
