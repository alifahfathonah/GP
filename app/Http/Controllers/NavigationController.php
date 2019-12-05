<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;
use App\keahlian as keahlian;
use App\user as user;
use App\role as role;
use App\client as client;
use App\pengajar as pengajar;
use App\jadwal as jadwal;
use App\ClientPengajar as booking;
use App\transaction as transaksi;
use App\pertemuan as pertemuan;
class NavigationController extends Controller
{
    public function __construct()
    {
      $this->middleware('RevalidateBackHistory');
        $this->middleware('auth');
    }
    
    public function side()
    {
        $pengajar = user::join('pengajars','pengajars.email','=','users.email')                        
                            ->where('pengajars.email',Auth::user()->email)
                            ->join('keahlians','keahlians.id_keahlian','=','pengajars.id_keahlian')
                            ->get();
    
        return view('layouts.side',['pengajar'=>$pengajar,'tes'=>$tes]);
    }
    public function dashboard()
    {
        $pengajar = user::join('pengajars','pengajars.email','=','users.email')                        
                            ->where('pengajars.email',Auth::user()->email)
                            ->join('keahlians','keahlians.id_keahlian','=','pengajars.id_keahlian')
                            ->get();
    
        return view('layouts.dash',['pengajar'=>$pengajar,'tes'=>$tes]);
    }
   
    public function profil()
    {
        $status = user::join('roles','roles.id_role','=','users.id_role')
                    ->where('id',Auth::id())
                    ->first();
        if ($status->n_role == "client") {
            $data = user::where('users.id',Auth::id())
                    ->join('clients','clients.email','=','users.email')
                    ->get();
            return view('profil',['data'=>$data]);

        } elseif($status->n_role == "pengajar") {
            $pengajarss = user::join('pengajars','pengajars.email','=','users.email') 
                        ->leftjoin('keahlians','keahlians.id_keahlian','=','pengajars.id_keahlian')
                        ->where('pengajars.email',Auth::user()->email)
                        ->get();
            $id_ajar = pengajar::where('email',Auth::user()->email)->first()->id_pengajar;
            $jadwals = jadwal::where('id_pengajar',$id_ajar)
                    ->first();
            if ($jadwals == NULL) {
            $list_jadwal = NULL;
            } else {
            $list_jadwal = json_decode($jadwals->hari);
            }
            return view('profil',['pengajarss'=>$pengajarss,'id_ajar'=>$id_ajar,'jadwals'=>$jadwals,'list_jadwal'=>$list_jadwal]);

        }else{
            // admin profil
            $data = user::where('id',Auth::id())
                    ->get();
            // dd($data);
            return view('profil',['data'=>$data]);
        }
        


       
    }
    public function eprofile($id)
    {
        $clients = user::where('users.id',Auth::id())
                    ->join('clients','clients.email','=','users.email')
                    ->get();
        $datas = user::join('pengajars','pengajars.email','=','users.email')                        
                    ->leftjoin('keahlians','keahlians.id_keahlian','=','pengajars.id_keahlian')
                    ->where('pengajars.email',Auth::user()->email)
                    ->get();
        $keahlian = keahlian::all();
        return view('Edit/e-profil',['datas'=>$datas,'keahlian'=>$keahlian,'clients'=>$clients]);
    }

    public function cari(Request $request)
    {
        ini_set('memory_limit','256M');
        $term = $request->get('term');
        $results = array();
        $tes = DB::table('trkabupaten_trkecamatan')
                ->join('trkabupaten', 'trkabupaten_id', '=', 'trkabupaten.id')
                ->join('trkecamatan','trkecamatan_id', '=', 'trkecamatan.id')
                ->select('trkabupaten.n_kabupaten','trkecamatan.n_kecamatan')
                ->where('trkecamatan.n_kecamatan', 'LIKE', '%'.$term.'%')
                ->where('trkabupaten.n_kabupaten', 'LIKE', '%Tangerang%')
                // ->orWhere('trkabupaten.n_kabupaten', 'LIKE', '%'.$term.'%')
                
                ->get()
                ->take(10);
                
        foreach ($tes as $query)
        {
            $results[] = [ 'label' =>  $query->n_kabupaten .','. $query->n_kecamatan, 'value' => $query->n_kabupaten.',' .$query->n_kecamatan ];
        }
    // var_dump(Response()->json($results));
    return Response()->json($results);
    }
    public function keahlians()
    {
        $keahlians = keahlian::all();
        return view('keahlian',['keahlians'=>$keahlians]);
    }
    
    public function adminss()
    {
        $admin_list = user::join('roles', 'roles.id_role','=','users.id_role')
                        ->where('n_role','admin')
                        ->orWhere('n_role','super admin')
                        ->get();
        $role_list = role::where('roles.n_role','like','%admin%')
                        ->get();
        $cekAdm = user::join('roles', 'roles.id_role','=','users.id_role')
                        ->where('n_role','super admin')
                        ->get()->pluck('id_role');
        // dd($cekAdm);
        return view('dt-admin',['admin_list'=>$admin_list,'role_list'=>$role_list,'cekAdm'=>$cekAdm]);
    }
    public function listBooking()
    {
        $id_teach = pengajar::where('email',Auth::user()->email)
                                                       ->first();
        $list_book = booking::join('clients','clients.id_client','=','clients_pengajars.id_client')
                            ->join('pengajars','pengajars.id_pengajar','=','clients_pengajars.id_pengajar')
                        ->where('clients_pengajars.id_pengajar',$id_teach->id_pengajar)
                        ->get();
        return view('list-booking',['list_book'=>$list_book]);
    }
    public function history()
    {
        $id_p = pengajar::where('email',Auth::user()->email)
                    ->first();
        $riwayat = transaksi::join('clients','clients.id_client','=','transactions.id_client')
                    ->where('transactions.id_pengajar',$id_p->id_pengajar)
                    ->paginate(10);
        return view('p-trans',['riwayat'=>$riwayat]);
    }

    public function TransDitolak()
    {
        $id_c = client::where('email',Auth::user()->email)
                    ->first();
        $tolak = booking::select('clients_pengajars.*','pengajars.name','pengajars.gaji')
                ->join('pengajars','pengajars.id_pengajar','=','clients_pengajars.id_pengajar')
                ->onlyTrashed()                 
                ->where('clients_pengajars.id_client',$id_c->id_client)               
                ->paginate(10);
        // dd($);
        return view('c-trans',['tolak'=>$tolak]);
    }

    public function TransDiterima()
    {
        $id_c = client::where('email',Auth::user()->email)
                    ->first();
        $terima = transaksi::join('pengajars','pengajars.id_pengajar','=','transactions.id_pengajar')
                    ->where('status','Menunggu Pembayaran Client')               
                    ->where('transactions.id_client',$id_c->id_client)               
                    ->paginate(10);
        return view('c-trans',['terima'=>$terima]);
    }

    public function TransPending()
    {
        $id_c = client::where('email',Auth::user()->email)
        ->first();
        $pending = booking::select('clients_pengajars.*','pengajars.name','pengajars.gaji','clients.kota')
            ->join('pengajars','pengajars.id_pengajar','=','clients_pengajars.id_pengajar') 
            ->join('clients','clients.id_client','=','clients_pengajars.id_client')              
            ->where('clients_pengajars.id_client',$id_c->id_client)               
            ->paginate(10);
        return view('c-booking',['pending'=>$pending]);
    }

    public function TransBelajar()
    {
        $id_c = client::where('email',Auth::user()->email)
                    ->first();
        $terima = transaksi::join('pengajars','pengajars.id_pengajar','=','transactions.id_pengajar') 
                    ->where('transactions.id_client',$id_c->id_client)
                    ->where('status', 'LIKE', '%Pertemuan%')   
                    ->orWhere('status', 'Pembelajaran Dapat Dimulai')                         
                    ->paginate(10);
        return view('c-trans-belajar',['terima'=>$terima]);

    }

    public function dt_trans()
    {
        $shows = transaksi::join('clients','clients.id_client','=','transactions.id_client')
                            ->join('pengajars','pengajars.id_pengajar','=','transactions.id_pengajar')
                            ->select('transactions.*','clients.name as n_client','clients.id_client as id_client','clients.kota','pengajars.name as n_pengajar') 
                            ->where('status','Menunggu Konfirmasi Admin')
                            ->paginate(10);
        // dd($shows);
        return view('dt-trans',['shows'=>$shows]);
    }
    public function dt_trans_all()
    {
        $shows = transaksi::join('clients','clients.id_client','=','transactions.id_client')
                            ->join('pengajars','pengajars.id_pengajar','=','transactions.id_pengajar')
                            ->select('transactions.*','clients.name as n_client','clients.kota','pengajars.name as n_pengajar') 
                            ->paginate(10);
        // dd($shows);
        return view('dt-trans',['shows'=>$shows]);
    }

    public function dt_trans_proses()
    {
        $shows = transaksi::join('clients','clients.id_client','=','transactions.id_client')
                ->join('pengajars','pengajars.id_pengajar','=','transactions.id_pengajar')
                ->select('transactions.*','clients.name as n_client','clients.kota','pengajars.name as n_pengajar') 
                ->where('status','Pembelajaran Dapat Dimulai')
                ->orWhere('status', 'LIKE', '%Pertemuan%')
                ->paginate(10);
        // dd($shows);
        return view('dt-trans',['shows'=>$shows]);

    }
    public function dt_trans_finish()
    {
        $shows = transaksi::join('clients','clients.id_client','=','transactions.id_client')
                ->join('pengajars','pengajars.id_pengajar','=','transactions.id_pengajar')
                ->select('transactions.*','clients.name as n_client','clients.kota','pengajars.name as n_pengajar') 
                ->where('status','Transaksi Selesai')
                ->paginate(10);
        // dd($shows);
        return view('dt-trans',['shows'=>$shows]);
    }

    public function pertemuan($id_trans)
    {
        $ajar = pertemuan::join('transactions','transactions.id_trans','=','pertemuans.id_trans')
                            ->join('pengajars','pengajars.id_pengajar','=','transactions.id_pengajar')
                            ->join('clients','clients.id_client','=','transactions.id_client')
                            ->select('transactions.note','pertemuans.*','clients.name as n_client','clients.alamat','clients.nope','pengajars.name as n_pengajar','pengajars.norek') 
                            ->where('pertemuans.id_trans',$id_trans)
                            ->first();
        // dd($ajar);


        $tampils = pertemuan::where('id_trans',$id_trans)
                    ->orderBy('id_pertemuan','ASC')
                    ->get();
        return view('p-pertemuan',['tampils'=>$tampils,'ajar'=>$ajar]);
    }

    public function dt_pertemuan($id_trans)
    {
        $tampils = pertemuan::join('transactions','transactions.id_trans','=','pertemuans.id_trans')
                            ->join('pengajars','pengajars.id_pengajar','=','transactions.id_pengajar')
                            ->where('pertemuans.id_trans',$id_trans)
                            ->orderBy('id_pertemuan','ASC')
                            ->get();
        
        return view('dt-pertemuan',['tampils'=>$tampils]);
    }

    public function laporan_trans()
    {
        $shows = transaksi::join('clients','clients.id_client','=','transactions.id_client')
                    ->join('pengajars','pengajars.id_pengajar','=','transactions.id_pengajar')
                    ->select('transactions.*','clients.name as n_client','clients.kota','pengajars.name as n_pengajar') 
                    ->where('status','Pembelajaran Dapat Dimulai')
                    ->orWhere('status', 'LIKE', '%Pertemuan%')
                    ->paginate(10);

        return view('laporan-trans',['shows'=>$shows]);
    }
}
