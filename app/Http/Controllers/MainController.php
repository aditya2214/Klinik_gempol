<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Input;
use Auth;

class MainController extends Controller
{
    public function index() {
        $metadatas = ambil_satudata('metadata',17);
        $jumlah['pasien']=DB::table('pasien')->where('deleted',0)->count();
        $jumlah['kunjungan']=DB::table('rm')->where('deleted',0)->count();
        $jumlah['lab']=DB::table('lab')->where('deleted',0)->count();
        $jumlah['obat']=DB::table('obat')->where('deleted',0)->count();
        $labs= ambil_semuadata('lab');
        $rms = ambil_semuadata('rm');
        $obats= ambil_semuadata('obat');
        $warning=cek_stok_warning (10); 

        $metadatas2 = ambil_satudata('metadata',1);
        $pasiens2 = ambil_semuadata('pasien');

        
        $list_user = DB::table(DB::raw("(
                select a.id, b.departemen from users a 
                    join pasien b 
                        on a.id_pasien = b.id
                where a.id = '".Auth::user()->id."'
            ) x "))->first();
        
            if(Auth::user()->admin == 2){
                $pasiens = DB::table(DB::raw("(
                    select * from pasien where departemen = '".$list_user->departemen."'
                ) x "))->get();
            } else if (Auth::user()->admin == 1){
                $pasiens = ambil_semuadata('pasien');
            } else {
                $pasiens = DB::table(DB::raw("(
                    select id,nik_karyawan,nama,departemen,tgl_lhr,email,hp from pasien
                    where nik_karyawan = '".Auth::user()->email."'
                ) x"))->first();
            }
        
        return view('index',compact('metadatas','jumlah','pasiens','labs','rms','obats','warning'));
    }
}
