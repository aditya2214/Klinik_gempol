<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB,PDF,Auth;

class pendaftaranController extends Controller
{
    public function formulir(){
        $data['users'] = DB::table(DB::raw("(
            select id,nik_karyawan,nama,departemen,tgl_lhr,email,hp from pasien
            where nik_karyawan = '".Auth::user()->email."'
        ) x"))->first();
        
        return view('formulir')->with($data);
    }

    public function pendaftaran(){
        $data['pendaftaran'] = DB::table(DB::raw("(
                select b.id,b.nik_karyawan,b.nama,b.departemen,b.tgl_lhr,b.email,b.hp,a.keluhan,a.time_selected from pendaftaran a
                    join pasien b
                        on a.nik_karyawan = b.nik_karyawan
            ) x"))->get();

        return view('list-pendaftaran')->with($data);
    }

    public function store_formulir(Request $request){
        $nik = $request->nik_karyawan;
        $time_booking = $request->time_booking;
        $keluhan = $request->keluhan;

        DB::table('pendaftaran')->insert([
            'nik_karyawan' => $request->nik_karyawan,
            'time_selected' => $request->time_booking,
            'keluhan' => $request->keluhan
        ]);

        $data2 = DB::table(DB::raw("(
            select b.id,b.nik_karyawan,b.nama,b.departemen,b.tgl_lhr,b.email,b.hp,a.time_selected from pendaftaran a
                join pasien b
                    on a.nik_karyawan = b.nik_karyawan
            where b.nik_karyawan = '".$request->nik_karyawan."'
        ) x"))->first();

        $no = DB::table('pendaftaran')->WhereDate('time_selected',date('Y-m-d',strtotime($time_booking)))->count();
        $bulan = date('m');
        $tahun = date('Y');
        $invID = str_pad($no + 1, 0, "0", STR_PAD_LEFT );
        $nomor_antrian = $invID;

        $pdf = PDF::loadview('no_antrian',compact('nomor_antrian','data2','time_booking'))->setPaper('a4', 'potrait');
        return $pdf->download();
 
        $pesan = 'Formulir Terkirim';

        return redirect()->back()->with('pesan',$pesan);;
    }
}
