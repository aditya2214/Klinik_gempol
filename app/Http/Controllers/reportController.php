<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class reportController extends Controller
{
    public function index(){

        $rms = DB::table(DB::raw("(
            select b.*, a.nik_karyawan, a.nama, departemen from pasien a 
            join rm b 
                on a.id = b.idpasien
        ) x "))->get();

        return view('laporan-kunjungan',compact('rms'));
    }
}
