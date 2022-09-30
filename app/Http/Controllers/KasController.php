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
        $data['saldo'] = Kas::where('delete','!=','1')->where('status','0')->get(['nilai'])->sum('nilai') - Kas::where('delete','!=','1')->where('status','1')->get(['nilai'])->sum('nilai');
        $data['aktif'] = 'Dashboard';
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
        $kas->delete_by = null;
        $kas->deleted_at = null;
        $kas->save();
        return back()->with('sukses','Data Berhasil Di Input');
        // dd($request->all());
    }
    public function hapus_kas($id){
        $kas = Kas::where('id',$id)->update([
            'delete' => 1,
            'delete_by' =>Auth::user()->id,
            'deleted_at' => now()
        ]);
        return back()->with('sukses','Data Berhasil Terhapus');
    }
    public function log_hapus(){
        $data['kas'] = Kas::join('users','users.id','=','kas.user_id')->select('kas.*','users.name')->where('delete','!=','0')->get();
        $data['aktif'] = 'log_hapus';
        return view('log_hapus',$data);
    }
    public function undo_kas($id){
        $kas = Kas::where('id',$id)->update([
            'delete' => 0,
            'delete_by' =>null,
            'deleted_at' => null
        ]);
        return back()->with('sukses','Data Berhasil Dipulihkan');
    }
}
