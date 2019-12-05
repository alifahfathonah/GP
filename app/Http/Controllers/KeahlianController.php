<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\keahlian as keahlian;

class KeahlianController extends Controller
{
    public function __construct()
    {
      $this->middleware('RevalidateBackHistory');
        $this->middleware('auth');
    }
    public function store(Request $request)
    {
       $n_keahlian =  $request->n_keahlian;
       $messages =  [
        'n_keahlian.regex' => 'Nama Keahlian Hanya Huruf', 
        'n_keahlian.min' => 'Minimal 2 karakter', 
        'n_keahlian.max' => 'Maksimal 30 karakter', 
        'n_keahlian.required' => 'Nama Keahlian Masih Kosong',
        'n_keahlian.unique' => 'Nama Keahlian Sudah Ada',

    ];
    $rules = [      
        'n_keahlian' => 'required|max:30|min:2|regex:/^[\pL\s\-]+$/u|unique:keahlians,n_keahlian',    
    ];
    $this->validate($request,$rules,$messages);
    $store = keahlian::create([
        'n_keahlian' => $n_keahlian
    ]);
    $request->session()->flash('success', 'Keahlian Berhasil Ditambahkan');
    return redirect('/dt-keahlian');
    }
    public function update(Request $request,$id_keahlian)
    {
        $cek = keahlian::where('n_keahlian', $request->n_keahlian)->get(['n_keahlian']);
        $cek2 = count($cek);
        if ($cek2 >= 1 ) {
          $request->session()->flash('danger', 'Keahlian Sudah Ada, Silahkan Cek Lagi');
          return redirect('/dt-keahlian');
        }else{
            // dd($id_keahlian);
        $messages =  [
            'nm_keahlian.min' => 'Minimal 2 karakter', 
            'nm_keahlian.max' => 'Maksimal 30 karakter',     
            'nm_keahlian.regex' => 'Nama Keahlian Hanya Boleh Huruf',
            'nm_keahlian.required' => 'Nama Keahlian Masih Kosong',
            'nm_keahlian.unique' => 'Nama Keahlian Sudah Ada',

          ];
        $rules = [
          'nm_keahlian' => 'required|max:30|min:2|regex:/^[\pL\s\-]+$/u|unique:keahlians,n_keahlian',    
        ];
        $this->validate($request,$rules,$messages);
       
          $n_keahlian = $request->nm_keahlian;
          $update = keahlian::find($id_keahlian);        
          $update->fill([
            'n_keahlian' => $n_keahlian,
          ])->save();
          $request->session()->flash('success', 'Keahlian Berhasil Diubah');
          return redirect('/dt-keahlian');
        }
    }
    public function destroy(Request $request,$id_keahlian)
    {
        $del = keahlian::where('id_keahlian',$id_keahlian);
        if ($del->exists()) {
            $delete = keahlian::destroy($id_keahlian);
            $request->session()->flash('success', 'Keahlian Berhasil Dihapus');
            return redirect('/dt-keahlian');
        } else {
            $request->session()->flash('danger', 'Keahlian Tidak Ditemukan');
            return redirect('/dt-keahlian');

        }
        
    }
}
