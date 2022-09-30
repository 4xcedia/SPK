<?php

namespace App\Http\Controllers;

use App\Models\Kas;
use App\Http\Controllers\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Telegram\Bot\Laravel\Facades\Telegram as Telegram;

class KasController extends Controller
{
    public function index(){
        $data['kas'] = Kas::join('users','users.id','=','kas.user_id')->select('kas.*','users.name')->where('delete','!=','1')->get();
        $data['saldo'] = Kas::where('status','0')->get(['nilai'])->sum('nilai') - Kas::where('status','1')->get(['nilai'])->sum('nilai');
        // dd($data['kas']);
        return view('home',$data);
    }
    public function tambah_data(Request $request){
        $kas = new Kas;
        $request->validate([
            'deskripsi' => 'required',
            'nilai' => 'required|numeric|gt:0',
            'status' => 'required',
        ]);
        // dd('berhasil');
        $kas->deskripsi = $request->deskripsi;
        $kas->nilai = $request->nilai;
        $kas->status = $request->status;
        $kas->created_at = now();
        $kas->updated_at = now();
        $kas->user_id = Auth::user()->id;
        $kas->delete = 0;
        $kas->save();
        return back()->with('sukses','Data Berhasil Di Input');
        // dd($request->all());
    }
    public function hapus_kas($id){
        $kas = Kas::where('id',$id)->delete();
        return back()->with('sukses','Data Berhasil Terhapus');
    }
}
