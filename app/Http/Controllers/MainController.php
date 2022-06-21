<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Input;

class MainController extends Controller
{
    public function index() {
        $metadatas = ambil_satudata('metadata',17);
        $jumlah['pasien']=DB::table('pasien')->where('deleted',0)->count();
        $jumlah['kunjungan']=DB::table('rm')->where('deleted',0)->count();
        $jumlah['lab']=DB::table('lab')->where('deleted',0)->count();
        $jumlah['obat']=DB::table('obat')->where('deleted',0)->count();
        $pasiens = ambil_semuadata('pasien');
        $labs= ambil_semuadata('lab');
        $rms = ambil_semuadata('rm');
        $obats= ambil_semuadata('obat');
        $warning=cek_stok_warning (10); 

        return view('index',compact('metadatas','jumlah','pasiens','labs','rms','obats','warning'));
    }
}
