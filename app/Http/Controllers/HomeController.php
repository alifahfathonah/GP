<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\keahlian as keahlian;
use App\user as user;
use App\role as role;
use App\client as client;
use App\pengajar as pengajar;
use App\jadwal as jadwal;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    
    public function __construct()
    {
        $semua = \App\pengajar::join('keahlians','keahlians.id_keahlian','=','pengajars.id_keahlian')
        ->join('jadwals','jadwals.id_pengajar','=','pengajars.id_pengajar')
        ->orderBy('pengajars.id_pengajar')
        ->paginate(10);
       
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $semua = \App\pengajar::join('keahlians','keahlians.id_keahlian','=','pengajars.id_keahlian')
                ->join('jadwals','jadwals.id_pengajar','=','pengajars.id_pengajar')
                ->where('st_aktif','1')
                ->orderBy('pengajars.id_pengajar')                
                ->paginate(10);
        // dd($semua);
        return view('index',['semua'=>$semua]);
    }

    public function pengajars($n_keahlian)
    {
        $list = pengajar::join('keahlians','keahlians.id_keahlian','=','pengajars.id_keahlian')
                ->join('jadwals','jadwals.id_pengajar','=','pengajars.id_pengajar')
                ->where('n_keahlian',$n_keahlian)
                ->where('st_aktif','1')
                ->get();
        $jdwl = pengajar::with('jadwal','keahlian')
                ->get();
        // $jadwal = json_decode($list->hari,true);
        // dd($list);
        return view('list-pengajar',['list'=>$list]);
    }

    public function howto()
    {
        return view('howto');
    }

}
