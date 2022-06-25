<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;

class PasienController extends Controller
{
    //Halaman Utama Pasien
    public function index()
    {
        $metadatas = ambil_satudata('metadata',1);
        $pasiens = ambil_semuadata('pasien');
        return view('pasien',['pasiens'=> $pasiens],['metadatas'=>$metadatas]);
    }

    //Halaman tambah pasien baru
    public function tambah_pasien()
    {
        $metadatas = ambil_satudata('metadata',2);
        $role = DB::table(DB::raw("(
                select * from role
            ) x "))->get();

        return view('tambah-pasien',['metadatas'=>$metadatas],['role' => $role]);
    }
    
    //Hallaman Edit Pasien
        public function edit_pasien($id)
    {
        $metadatas = ambil_satudata('metadata',3);
        $datas= ambil_satudata('pasien',$id);
        if ($datas->count() <= 0) {
            return abort(404, 'Halaman Tidak Ditemukan.');
        }
        return view('edit-pasien',['metadatas'=>$metadatas],['datas'=>$datas]);
    }
    
    
    //Proses menyimpan pasien baru
    public function simpan_pasien(Request $request)
    { 
        $this->validate($request, [
            'nik_karyawan' => 'required',
            'Nama_Lengkap' => 'required|min:5|max:35',
            'Tanggal_Lahir' => 'required|before:today',
            'Alamat' => 'required',
            'departemen' => 'required',
            'no_handphone' => 'required|numeric',
            'email' => 'required',
            'Jenis_Kelamin' => 'required',
            'no_bpjs' => 'nullable|numeric|digits_between:1,15'
        ]);
        $save1 = DB::table('pasien')->insert([
            'nik_karyawan' => $request->nik_karyawan,
            'nama' => $request->Nama_Lengkap,
            'tgl_lhr' => $request->Tanggal_Lahir,
            'alamat' => $request->Alamat,
            'pekerjaan' => $request->role,
            'departemen' => $request->departemen,
            'hp' => $request->no_handphone,
            'email' => $request->email,
            'jk' => $request->Jenis_Kelamin,
            'pendidikan' => $request->Pendidikan_terakhir,
            'no_bpjs' => $request->no_bpjs,
            'alergi' => $request ->alergi,
            'created_time' => Carbon::now(),
            'updated_time' => Carbon::now(),
        ]);
        
        $cek_data_pasin = DB::table('pasien')->where('nik_karyawan',$request->nik_karyawan)->first();

        DB::table('users')->insert([
            'id_pasien' => $cek_data_pasin->id,
            'username' =>  $request->nik_karyawan,
            'name' => $request->Nama_Lengkap,
            'email' => $request->nik_karyawan,
            'password' => Hash::make(str_replace("-","",$request->Tanggal_Lahir)),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'admin' => $request->role,
            'deleted' => 0,
        ]);

           $ids= DB::table('pasien')->latest('created_time')->first();         
            switch($request->simpan) {
                case 'simpan': 
                    $buka=route('pasien');
                    $pesan='Data pasien berhasil disimpan!';
                break;
                case 'simpan_rm': 
                    $buka=route('rm.list',$ids->id);
                    $pesan='Data pasien berhasil disimpan!';
                break;              
                case 'simpan_baru': 
                    $buka=route('pasien.tambah');
                    $pesan='Data pasien berhasil disimpan!';
                break;
            }
        return redirect($buka)->with('pesan',$pesan);
    }
    
        //Proses Update Pasien
        public function update_pasien(Request $request)
    {
            $this->validate($request, [
                'nik_karyawan' => 'required',
                'Nama_Lengkap' => 'required|min:5|max:35',
                'Tanggal_Lahir' => 'required|before:today',
                'Alamat' => 'required',
                'departemen' => 'required',
                'no_handphone' => 'required|numeric',
                'email' => 'required',
                'Jenis_Kelamin' => 'required',
                'no_bpjs' => 'nullable|numeric|digits_between:1,15'
            ]);
            
            DB::table('pasien')->where('id',$request->id)->update([
                'nik_karyawan' => $request->nik_karyawan,
                'nama' => $request->Nama_Lengkap,
                'tgl_lhr' => $request->Tanggal_Lahir,
                'alamat' => $request->Alamat,
                'pekerjaan' => 'XXX',
                'departemen' => $request->departemen,
                'hp' => $request->no_handphone,
                'email' => $request->email,
                'jk' => $request->Jenis_Kelamin,
                'pendidikan' => $request->Pendidikan_terakhir,
                'no_bpjs' => $request->no_bpjs,
                'alergi' => $request ->alergi,
                'updated_time' => Carbon::now(),
            ]);
     
            switch($request->simpan) {
                 case 'simpan': 
                    $buka=route('pasien.edit', $request->id);
                    $pesan='Data pasien berhasil disimpan!';
                break;
                case 'simpan_rm': 
                    $buka=route('rm.list',$request->id);
                    $pesan='Data pasien berhasil disimpan!';
                break;              
                case 'simpan_baru': 
                    $buka=route('pasien.tambah');
                    $pesan='Data pasien berhasil disimpan!';
                break;
            }
        return redirect($buka)->with('pesan',$pesan);
    }
    
        public function hapus_pasien($id)
    {
        DB::table('pasien')->where('id',$id)->update([
            'deleted' => 1,
        ]);
        $pesan="Data pasien berhasil dihapus!";
        return redirect(route("pasien"))->with('pesan',$pesan);
    }
    
}