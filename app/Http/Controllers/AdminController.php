<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\User as user;
class AdminController extends Controller
{
    public function __construct()
    {
      $this->middleware('RevalidateBackHistory');
        $this->middleware('auth');
    }
    public function store(Request $request)
    {
        $n_adm = $request->nama;
        $e_adm = $request->email;
        $p_adm = $request->password;
        $r_adm = $request->role;
        // Pesan Mulai
        $messages =  [
            'nama.regex' => 'Nama Admin Hanya Boleh Huruf', 
            'nama.min' => 'Nama Minimal 2 karakter', 
            'nama.max' => 'Nama Maksimal 30 karakter', 
            'nama.required' => 'Nama Admin Masih Kosong',
            'email.email' => 'Isi Alamat E-Mail Dengan Benar', 
            'email.max' => 'Maksimal 30 karakter', 
            'email.required' => 'Email Masih Kosong',
            'email.unique' => 'Email Sudah Terdaftar',
            'password.confirmed' => 'Konfirmasi Password Berbeda', 
            'password.min' => 'Password Minimal 6 karakter', 
            'password.required' => 'Password Masih Kosong',
            'role.required' => 'Hak Akses Admin Masih Kosong'

        ];
        $rules = [      
            'nama' => 'required|max:25|regex:/^[\pL\s\-]+$/u',
            'email' => 'required|max:30|email|unique:users',  
            'password' => 'required|min:6|confirmed',  
            'role'=>'required'

        ];
        $this->validate($request,$rules,$messages);
        // Pesan selesai

       $store = user::create([
            'name'      =>  $n_adm,
            'email'     =>  $e_adm,
            'password'  =>  Hash::make($p_adm),
            'id_role'     =>  $r_adm,
       ]);
       if ($store) {
        $request->session()->flash('success', 'Admin Berhasil Ditambahkan');
        return redirect('/dt-admin');
       } else {
        $request->session()->flash('danger', 'Admin Gagal Ditambahkan');
        return redirect('/dt-admin');
       }       
    }

    public function update(Request $request,$id)
    {
        $n_adm = $request->nama;
        $e_adm = $request->email;
        $r_adm = $request->role;
        $update = user::find($id);
        // Pesan Mulai
        $messages =  [
            'nama.regex' => 'Nama Admin Hanya Boleh Huruf', 
            'nama.min' => 'Nama Minimal 2 karakter', 
            'nama.max' => 'Nama Maksimal 30 karakter', 
            'nama.required' => 'Nama Admin Masih Kosong',
            'email.email' => 'Isi Alamat E-Mail Dengan Benar', 
            'email.max' => 'Maksimal 30 karakter', 
            'email.required' => 'Email Masih Kosong',
            'email.unique' => 'Email Sudah Terdaftar',
            'role.required' => 'Hak Akses Admin Masih Kosong'
        ];
        $rules = [      
            'nama' => 'required|max:25|regex:/^[\pL\s\-]+$/u',
            'email' => 'required|max:30|email|unique:users,email,'.$id,  
            'role'=>'required'
        ];
        $this->validate($request,$rules,$messages);
        // Pesan selesai
        
        $ubah = $update->fill([
            'name'      =>  $n_adm,
            'email'     =>  $e_adm,            
            'id_role'     =>  $r_adm,
        ])->save();
        if ($ubah) {
            $request->session()->flash('success', 'Admin Berhasil Diubah');
            return redirect('/dt-admin');  
        } else {
            $request->session()->flash('danger', 'Admin Gagal Diubah');
            return redirect('/dt-admin');
        }        
    }
    public function destroy(Request $request,$id)
    {   
        $cekAdm = user::join('roles', 'roles.id_role','=','users.id_role')
                    ->where('n_role','super admin')
                    ->get();
        if (count($cekAdm) <=1 AND $cekAdm->pluck('n_role') == 'super admin') {
            $request->session()->flash('danger', 'Super Admin Sisa 1');
            return redirect('/dt-admin');
        } else { 
            $delete = user::where('id',$id);
            if ($delete->exists()) {
                $destroy = user::destroy($id);
                $request->session()->flash('success', 'Admin Berhasil Dihapus');
                return redirect('/dt-admin');
            } else {
                $request->session()->flash('danger', 'Admin Gagal Dihapus');
                return redirect('/dt-admin');
            }   // SELESAI IF CARI ID USER
        }     //SELESAI ELSE CEK SUPER ADMIN
    }   //SELESAI FUNCTION
    

}
