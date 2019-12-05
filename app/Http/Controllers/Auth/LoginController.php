<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\User as user;
use Auth;
class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */

    protected function redirectTo()
    {   
        // $q = Auth::user()->id_role;
        // 
        $tes = user::join('roles','roles.id_role','users.id_role')
        ->where('email',Auth::user()->email)->first();
        // dd($tes);
            if ($tes->n_role != 'client' OR $tes->n_role != 'pengajar') {
                return '/login';
            } 

    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function AdminLoginProcs(Request $request)
    {
        $q = Auth::user()->id_role->n_role;
        // dd($q);
    }
}
