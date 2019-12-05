<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;
use PDF;
use App\keahlian as keahlian;
use App\user as user;
use App\role as role;
use App\client as client;
use App\pengajar as pengajar;
use App\jadwal as jadwal;
use App\ClientPengajar as booking;
use App\transaction as transaksi;
use App\pertemuan as pertemuan;
class TransactionController extends Controller
{
    public function __construct()
    {
      $this->middleware('RevalidateBackHistory');
        $this->middleware('auth');
    }

    public function booking(Request $request,$id_pengajar)
    {
      $messages =  [
        'note.required' => 'Catatan Pemesanan Perlu Diisi.',
        'note.max' => 'Maksimal 60 Karakter',
      ];
      $this->validate($request,[
        'note' =>'required|max:60',
      ],$messages);
      $jTemu = intval($request->temu);
      $total  = intval($request->total);
      $note = $request->note;
      $pemesan = client::where('email',Auth::user()->email)
                  ->first();
      // dd($request->all(), $id_pengajar, $pemesan->id_client);
      if ($pemesan->kota == "") {
        $request->session()->flash('danger', 'Kota Tinggal Masih koson, Silahkan perbarui profil');
        return redirect('/profil');      

      } else {
       
      
      $book = booking::create([
        'id_client' =>  $pemesan->id_client,
        'id_pengajar' =>  $id_pengajar,
        'jml_temu'  =>  $jTemu,
        'total_biaya' =>  $total,
        'note'      =>  $note
      ]);

      if ($book) {
        $request->session()->flash('success', 'Berhasil memesan pengajar');
        return redirect('/transaksi/pending');        
      } else{
        $request->session()->flash('danger', 'Gagal memesan pengajar');
        return redirect('/');        
      }
       
    }
  }

    public function konfirmasi(Request $request,$id_client,$id_booking)
    {
      $btn = $request->konfirmasi;
      if ($btn == "accept") {
        // generate kode transaksi
       $last = transaksi::where('id_client',$id_client)
                  ->latest()
                  ->first();
        if ( ! $last )
           $number = 0;
        else
           $number = substr($last->id_trans, 2);
           $kTrans= 'T'.$id_client . sprintf('%02d', intval($number) + 1);
        // end generate
        // $kTrans = 'T'.Auth::id().$id_booking.$id_client;

        $grand = intval($request->grand);
        $harga = intval($request->harga);
        $jTemu = intval($request->j_temu);
        $note = $request->note;
        $temu = array();
        $id_teach = pengajar::where('email',Auth::user()->email)
                    ->first();
        // dd($kTrans);
        // masukan ke table transaksi start
        $accept = transaksi::create([
            'id_trans'    =>    $kTrans,
            'id_client'   =>    $id_client,
            'id_pengajar' =>    $id_teach->id_pengajar,
            'jml_temu'    =>    $jTemu,
            'hrg_temu'    =>    $harga,
            'grand_biaya' =>    $grand,
            'status'      =>    'Menunggu Pembayaran Client',
            'note'        =>    $note,
            'bukti_trans' =>    ""
          ]);
          // masukan ke tabel transaksi end
          
          // hapus data pada tabel booking start
        $hps = booking::where('id',$id_booking);
        $hps->forceDelete();
        $hps2 = booking::destroy($id_booking);
        // hapus data pada tabel book end
          if ($accept) {
            $request->session()->flash('success', 'Berhasil Menerima Pesanan Client, Transaksi akan dilanjutkan setelah client memberikan bukti pembayaran kepada kami.');
            return redirect('/history');
          } else {
            $request->session()->flash('danger', 'Gagal menerima pesanan client');
            return redirect('/history');
          }         
      } else {
        $hps = booking::find($id_booking);
        $hapus = $hps->Delete();
          if ($hapus) {
            $request->session()->flash('success', 'Pesanan Ditolak.');
            return redirect('/history');
          } else {
            $request->session()->flash('danger', 'Gagal Menolak Pesanan');
            return redirect('/dt-booking');
          }
      }
      
    }

    public function upload(Request $request,$id_trans)
    {
      if ($request->hasFile('bukti')) {
        // validasi image start
          $messages =  [
            'bukti.max' => 'Maksimal Ukuran gambar 5MB',
            'bukti.mimes' => 'Hanya dapat mengunggah file Image (jpeg, png, bmp, gif, atau jpg)',

          ];
          $this->validate($request,[
            'bukti' =>'mimes:jpg,jpeg,png,gif|max:5120',
          ],$messages);
        // validasi image end
          $cTrans = transaksi::where('id_trans',$id_trans)->first();
          $buktiUp = $request->file('bukti')->store('bukti','public');
          $upload = $cTrans->fill([
              'bukti_trans'  =>  $buktiUp,
              'status'  => 'Menunggu Konfirmasi Admin'
          ])->save();
            if ($upload) {
              // jika berhasil upload start
                $request->session()->flash('success', 'Bukti Pembayaran '. $id_trans .' Berhasil Diunggah. Menunggu Konfirmasi Admin');
                return redirect()->back();  
              // jika berhasil upload end
            } else {
              // Jika Gagal Upload Start
                $request->session()->flash('danger', 'Bukti Pembayaran Gagal Diunggah.');
                return redirect()->back();  
              // jika Gagal Upload End
            }
            
      } else {
        $request->session()->flash('danger', 'Bukti Gagal di Unggah');
        return redirect()->back();
      }
    }

    public function destroyHistory(Request $request,$id)
    {
      $cek = booking::onlyTrashed()
              ->where('id',$id);
      // dd($cek);
      if ($cek->exists()) {
        $destroy = $cek->forceDelete();
        $request->session()->flash('success', 'Berhasil menghapus data pesanan dengan kode pesanan '.$id);
        return redirect()->back();
      } else {
        $request->session()->flash('danger', 'Gagal Menghapus Data Pesanan');
        return redirect()->back();
      }      
    }
    

    public function update_stat(Request $request,$id_trans)
    {
      $status = $request->status;
      $id_client = $request->id_client;
      $cTrans = transaksi::where('id_trans',$id_trans)->first();
        if ($status == "Pembelajaran Dapat Dimulai") {
          $jTemu = $request->j_temu;
          $update = $cTrans->fill([
            'status'  =>  $status,
          ])->save();
          // buat data pada tabel pertemuan start
          for ($i=0; $i < intval($jTemu); $i++) { 
            $temu = pertemuan::create([
              'id_trans'  =>  $cTrans->id_trans,
              'ket_temu'  =>  "",
              'bukti_temu'  =>  "",
              'kon_client'  =>  "0", 
              'kon_admin'   =>  "0",
              'bukti_upah'  =>  ""         
            ]);
          }
        // buat data pada tabel pertemuan end
            if ($update) {
              $request->session()->flash('success', 'Berhasil Merubah Status Pesanan '.$id_trans);
              return redirect()->back();
            } else {
              $request->session()->flash('danger', 'Gagal Merubah Status Pesanan '.$id_trans);
              return redirect()->back();
            }
        } else {
          $update = $cTrans->fill([
            'status'  =>  $status,
          ])->save();
            if ($update) {
              $request->session()->flash('success', 'Berhasil Merubah Status Pesanan '.$id_trans);
              return redirect()->back();
            } else {
              $request->session()->flash('danger', 'Gagal Merubah Status Pesanan '.$id_trans);
              return redirect()->back();
            }
        }
        
        
    }

    public function laporan_search(Request $request)
    {
      $tgawal = $request->tgl_awal;
      $tgakhir = $request->tgl_akhir;
      $filter = transaksi::join('clients','clients.id_client','=','transactions.id_client')
                    ->join('pengajars','pengajars.id_pengajar','=','transactions.id_pengajar')
                    ->select('transactions.*','clients.name as n_client','clients.kota','pengajars.name as n_pengajar')
                    ->where('status','Pembelajaran Dapat Dimulai')
                    ->orWhere('status', 'LIKE', '%Pertemuan%')
                    ->whereBetween('transactions.created_at',[$tgawal, $tgakhir]) 
    
                    ->paginate(10);
        return view('laporan-trans',['filter'=>$filter,'tgawal'=>$tgawal,'tgakhir'=>$tgakhir]);
    }
    public function PDFTrans(Request $request)
    {
      $filawal = $request->filawal;
      $filakhir = $request->filakhir;
      $filter = transaksi::join('clients','clients.id_client','=','transactions.id_client')
                  ->join('pengajars','pengajars.id_pengajar','=','transactions.id_pengajar')
                  ->select('transactions.*','clients.name as n_client','clients.kota','pengajars.name as n_pengajar')
                  ->where('status','Pembelajaran Dapat Dimulai')
                  ->orWhere('status', 'LIKE', '%Pertemuan%')
                  ->whereBetween('transactions.created_at',[$filawal, $filakhir]) 
                  ->get();    
      $pdfTrans = PDF::loadView('report',['filter'=>$filter,'filawal'=>$filawal,'filakhir'=>$filakhir])->setPaper('a4','potrait');
      $filename = 'Transaksi'.$filawal.'-'.$filakhir;
      return $pdfTrans->stream($filename.'.pdf', array("Attachment" => false));
 
      // dd($request->all());
    }
    
}
