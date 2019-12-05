<?php

namespace App\Http\Controllers;

use Auth;
use DB;
use Illuminate\Http\Request;
use App\keahlian as keahlian;
use App\user as user;
use App\role as role;
use App\client as client;
use App\pengajar as pengajar;
use App\jadwal as jadwal;
use App\ClientPengajar as booking;
use App\transaction as transaksi;
use App\pertemuan as pertemuan;
class PertemuanController extends Controller
{
    public function __construct()
    {
      $this->middleware('RevalidateBackHistory');
        $this->middleware('auth');
    }

    public function update_pertemuan(Request $request,$id_pertemuan)
    {
        $k_trans = $request->k_trans;
        $ke = $request->ke;
        $keterangan = $request->keterangan;
        $bukti = $request->file('bukti_temu');

        // validasi start
        $messages =  [
            'bukti_temu.mimes' => 'Hanya dapat mengunggah file Image (jpeg, png, bmp, gif, atau jpg)',
            'bukti_temu.required' => 'Bukti Pertemuan Masih Kosong',
            'keterangan.required' => 'Keterangan Pertemuan Masih Kosong',
            'keterangan.max' => 'Keterangan Maksimal 50 Karakter',
        ];
        $rules = [      
            'keterangan' => 'required|max:50',
            'bukti_temu' => 'required|mimes:jpg,jpeg,png,gif|max:2048',  
        ];
        $this->validate($request,$rules,$messages);
        // validasi end

        // update tabel pertemuan start
        $cPertemuan = pertemuan::where('id_pertemuan',$id_pertemuan)
                        ->first();
        $upload_bukti = $bukti->store('pertemuan','public');  
        $update = $cPertemuan->fill([
            'ket_temu'      =>     $keterangan,
            'bukti_temu'    =>      $upload_bukti,
        ])->save();       
        // update tabel pertemuan end
        // update tabel transaksi start
        $cTrans = transaksi::where('id_trans',$k_trans)
                    ->first();
        $updateTrans = $cTrans->fill([
            'status'    =>  'Pertemuan Ke '.$ke,
        ])->save();
        // update tabel transaksi end
        if ($updateTrans) {
            $request->session()->flash('success', 'Berhasil Input Pertemuan');
            return redirect()->back();         
        } else {
            $request->session()->flash('danger', 'Gagal Input Pertemuan');
            return redirect()->back();         
        }      
    }

    public function update_pertemuan_admin(Request $request,$id_pertemuan)
    {
        $konfirmasi = $request->konfirm_admin;
        $upah = $request->file('bukti_upah');
        $cPertemuan = pertemuan::where('id_pertemuan',$id_pertemuan)
                        ->first();
        if ($konfirmasi == "Transaksi Selesai") {
            $fTransaksi = transaksi::where('id_trans',$cPertemuan->id_trans)
                                ->first();
            $upTrans = $fTransaksi->fill([
                'status'    =>  $konfirmasi
            ])->save();
            
            $update = $cPertemuan->fill([
                'kon_admin' =>  $konfirmasi,                
                'updated_at'    =>  $cPertemuan->updated_at
            ])->save();

                if ($upTrans && $update ) {
                    $request->session()->flash('success', 'Berhasil Konfirmasi Pertemuan');
                    return redirect()->back();    
                } else {
                    $request->session()->flash('danger', 'Gagal Konfirmasi Pertemuan');
                    return redirect()->back();         
                }    
        } else {
             // validasi start
        $messages =  [
            'bukti_upah.mimes' => 'Hanya dapat mengunggah file Image (jpeg, png, bmp, gif, atau jpg)',
            'bukti_upah.required' => 'Bukti Upah Masih Kosong',
            'bukti_upah.max' => 'Maksimal Ukuran Gambar 5MB',

        ];
        $rules = [      
            'bukti_upah' => 'required|mimes:jpg,jpeg,png,gif|max:5120',  
        ];
        $this->validate($request,$rules,$messages);
        // validasi end
            $upload_upah = $upah->store('upah','public'); 
            $update = $cPertemuan->fill([
                'kon_admin' =>  $konfirmasi,
                'bukti_upah'    =>  $upload_upah,
                'updated_at'    =>  $cPertemuan->updated_at
            ])->save();
                if ($update) {
                    $request->session()->flash('success', 'Berhasil Konfirmasi Pertemuan');
                    return redirect()->back();    
                } else {
                    $request->session()->flash('danger', 'Gagal Konfirmasi Pertemuan');
                    return redirect()->back();         
                }    
        }
        
            
    }

    public function update_pertemuan_client(Request $request,$id_pertemuan)
    {
        $konfirmasi = $request->konfirm_client;
        $cPertemuan = pertemuan::where('id_pertemuan',$id_pertemuan)
                        ->first();
        $update = $cPertemuan->fill([
            'kon_client' =>  $konfirmasi,
            'updated_at'    =>  $cPertemuan->updated_at
        ])->save();

            if ($update) {
                
              
                $request->session()->flash('success', 'Berhasil Konfirmasi Pertemuan');
                return redirect()->back();    
            } else {
                $request->session()->flash('danger', 'Gagal Konfirmasi Pertemuan');
                return redirect()->back();         
            }    
    }

    

}
