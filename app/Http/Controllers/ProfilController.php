<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Auth;
use DB;
use App\user as user;
use App\role as role;
use App\client as client;
use App\pengajar as pengajar;
use App\jadwal as jadwal;
class ProfilController extends Controller
{
    public function __construct()
    {
      $this->middleware('RevalidateBackHistory');
        $this->middleware('auth');
    }

    public function update(Request $request,$email)
    {
        // dd($request->all());
        $nm = $request->nama;
        $np = $request->nope;
        $kota = $request->kota;
        $alamat = $request->alamat;
        $norek = $request->norek;
        $keahlian = $request->keahlian;
        $keterangan = $request->keterangan;
     
        $cek = user::join('roles','roles.id_role','=','users.id_role')
                    ->where('id',Auth::id())
                    ->first();
        if ($cek->n_role == 'client') {
            // UPDATE CLIENT START
            
            // validasi start
            $messages =  [
                'nama.regex' => 'Nama Hanya Mengandung Huruf',
                'kota.regex' => 'Kota Hanya Mengandung Huruf',
                'alamat.string' => 'Alamat Hanya Mengandung Huruf,Angka, dan simbol',
                'nope.numeric' => 'Nomor Telepon Hanya Mengandung Angka',
                'nope.digits_between' => 'Nomor Telepon Maksimal 13 Angka',
                'nama.required' => 'Nama Tidak Boleh Kosong',
                'kota.required' => 'Kota Tidak Boleh Kosong',
                'nope.required'  => 'Nomor Telepon Masih kosong',
                'alamat.required'  => 'Alamat Masih kosong',
                
            ];
            $this->validate($request,[
              'nama' => 'required|regex:/^[\pL\s\-]+$/u|max:25|min:3',
              'kota' => 'required|regex:/^[\pL\s\-,.]+$/u|max:50',
              'alamat' => 'required|string',
              'nope' =>'required|numeric|digits_between:1,13',
            ],$messages);
            // Validasi end
            $upUser = user::where('email',$email)->first();
            $upClient = client::where('email',$email)->first();
            $ubahUser = $upUser->fill([
                'name'  =>  $nm
            ])->save();
            $ubahClient = $upClient->fill([
                'name' => $nm,
                'nope' => $np,
                'alamat' => $alamat,
                'kota' => $kota,
            ])->save();
                if ($ubahUser AND $ubahClient) {
                    // JIKA BERHASIL UPDATE
                    $request->session()->flash('success', 'Profil Telah Diperbaharui');
                    return redirect('/profil');            
                } else {
                    // JIKA GAGAL UPDATE
                    $request->session()->flash('danger', 'Gagal Memperbarui Profil');
                    return redirect('/profil');            
                }                
            // UPDATE CLIENT END
        } elseif ($cek->n_role == 'pengajar') {
            // UPDATE PENGAJAR START
            // validasi start
            $messages =  [
                'nama.regex' => 'Nama Hanya Mengandung Huruf',
                'kota.regex' => 'Kota Hanya Mengandung Huruf',               
                'norek.numeric' => 'Nomor Rekening Hanya Mengandung Angka',
                'norek.digits_between' => 'Nomor Rekening Maksimal 16 Digit',
                'nama.required' => 'Nama Tidak Boleh Kosong',
                'kota.required' => 'Kota Tidak Boleh Kosong',
                'norek.required'  => 'Nomor Rekening Masih kosong',
                'keterangan.required'  => 'Keterangan Masih kosong',
                'keterangan.max'  => 'Maksimal 60 karakter',
            ];
            $this->validate($request,[
              'nama' => 'required|regex:/^[\pL\s\-]+$/u|max:25|min:3',
              'kota' => 'required|regex:/^[\pL\s\-,.]+$/u|max:50',
              'norek' =>'required|numeric|digits_between:1,16',
              'keterangan' =>'required|max:60',
            ],$messages);
            // Validasi end
            $cUser = user::where('email',$email)->first();
            $cPengajar = pengajar::where('email',$email)->first();
            $upUser = $cUser->fill([
                'name'  =>  $nm
            ])->save();
            $upPengajar = $cPengajar->fill([
                'name' => $nm,
                'norek' => $norek,
                'keterangan' => $keterangan,
                'area' => $kota,
                'id_keahlian' => $keahlian,
            ])->save();
                if ($upUser AND $upPengajar) {
                    // JIKA BERHASIL UPDATE
                    $request->session()->flash('success', 'Profil Telah Diperbaharui');
                    return redirect('/profil');            
                } else {
                    // JIKA GAGAL UPDATE
                    $request->session()->flash('danger', 'Gagal Memperbarui Profil');
                    return redirect('/profil');            
                }                

            // UPDATE PENGAJAR END
        }      
    }

    public function avatar(Request $request,$email)
    {
        if ($request->hasFile('avatar')) {
            $messages =  [
                'avatar.image' => 'Hanya dapat mengunggah file Image (jpeg, png, bmp, gif, atau jpg)',
            ];
            $this->validate($request,[
              'avatar' =>'image|mimes:jpg,jpeg,png,gif|max:2048',
            ],$messages);
            $cPengajar = pengajar::where('email',$email)->first();
            $avatar = $request->file('avatar')->store('profil','public');
            $upload = $cPengajar->fill([
                'foto'  =>  $avatar
            ])->save();
            $request->session()->flash('success', 'Foto Berhasil di Unggah');
            return redirect('/profil');
        } else {
            $request->session()->flash('danger', 'Foto Gagal di Unggah');
            return redirect('/profil');
        }
    }

    public function PassChange(Request $request,$email)
    {
        $new = $request->new_pass;
        $old = $request->old_pass;
        $cUser = user::find(Auth::id());

    // START ERROR MESSAGE
      $messages =  [
        'old_pass.alpha_num' => 'Karakter Hanya Huruf dan Angka',
        'new_pass.alpha_num' => 'Karakter Hanya Huruf dan Angka',
        'old_pass.min' => 'Password Lama Minimal 6 Digit Karakter',
        'new_pass.min' => 'Password Baru Minimal 6 Digit Karakter',
        'old_pass.required' => 'Password Lama Tidak Boleh Kosong',
        'new_pass.required'  => 'Password Baru Masih kosong',
        ];
    $this->validate($request,[
      'old_pass' => 'required|alpha_num|min:6|',
      'new_pass' => 'required|alpha_num|min:6|'
    ],$messages);
    // END ERROR MESSAGE

    // cek password
    if (Hash::check($old, $cUser->password)) {
        //jika password lama sama dengan password di database
        $update_pass = $cUser->fill([
            'password'  =>  Hash::make($new)
        ])->save();
        if ($update_pass) {
            //jika berhasil update password
            $request->session()->flash('success', 'Password Berhasil Diubah, Silahkan Login Kembali Dengan Password Baru.');
            return redirect()->back();
        } else {
            //jika gagal update password
            $request->session()->flash('danger', 'Gagal Merubah Password.');
            return redirect('/profil');
        }        
    }else{
        //jika password lama tidak sama dengan password di database
        $request->session()->flash('danger', 'Password Berbeda, Silahkan Cek Kembali.');
        return redirect('/profil');
    }
}

    public function statusAjar(Request $request,$email)
    {
        $Status = $request->status;
        if ($Status == "1") {
            $upStatus = pengajar::where('email',$email)
                            ->first();
            $update = $upStatus->fill([
                'st_aktif'  =>  $Status
            ])->save();
            if ($update) {
                $request->session()->flash('success', 'Anda Aktif Sebagai Pengajar');
                return redirect('/profil');        
            } else {
                $request->session()->flash('danger', 'Gagal Merubah Status Aktif');
                return redirect('/profil');        
            }           

        } elseif($Status == "0") {
            $upStatus = pengajar::where('email',$email)
                        ->first();
            $update = $upStatus->fill([
                        'st_aktif'  =>  $Status
            ])->save();
            if ($update) {
                $request->session()->flash('success', 'Anda Aktif Sebagai Pengajar');
                return redirect('/profil');        
            } else {
                $request->session()->flash('danger', 'Gagal Merubah Status Aktif');
                return redirect('/profil');        
            }
        }
        
        
    }

    public function ChangeJadwal(Request $request,$id)
    {
        $hari = json_encode($request->hari);
        $cekJadwal = jadwal::where('id_pengajar',intval($id))->first();
       
        // dd(pengajar::where('email',Auth::user()->email)->first()->id_pengajar);
       if ($cekJadwal == NULL) {
          $insert = jadwal::Create([
              'id_pengajar' =>  $id,
              'hari'    =>  $hari
          ]);
          if ($insert) {
            $request->session()->flash('success', 'Jadwal Berhasil Ditambahkan');
            return redirect('/profil');   
          } else {
            $request->session()->flash('danger', 'Gagal Menambahkan Jadwal');
            return redirect('/profil');        
          }
          
       } else {
        //    dd('tidak bisa');
           $upJadwal = $cekJadwal->fill([
               'id_pengajar'    => $id,
               'hari'   =>  $hari
           ])->save();

           if ($upJadwal) {
            $request->session()->flash('success', 'Jadwal Berhasil Diubah');
            return redirect('/profil');  
           } else {
            $request->session()->flash('danger', 'Jadwal Gagal Diubah');
            return redirect('/profil');  
           }    
       }
        
    }



}
