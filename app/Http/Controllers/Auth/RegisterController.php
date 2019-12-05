<?php

namespace App\Http\Controllers\Auth;

use App\User;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use App\client as client;
use App\pengajar as pengajar;
class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        // dd($data['id_role']);
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:25'],
            'email' => ['required', 'string', 'email', 'max:30', 'unique:users'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */



    protected function create(array $data)
    {
        if ($data['id_role']=="1") {
            // client
             
            $user = User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
                'id_role'   =>  $data['id_role'],
             ]);
             client::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'jk'    => $data['gender'],
                'nope'  => "",
                'kota'  => "",
                'alamat' => ""
             ]);
            return $user;
        } elseif($data['id_role']=="2") {
            // pengajar
            $user =  User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
                'id_role'   =>  $data['id_role'],
             ]);
            pengajar::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'id_keahlian'=> NULL,
                'jk'    => $data['gender'],                
                'norek' =>  "",
                'gaji'  =>  100000,
                'st_aktif'=>  "0",
                'area'=>"",
                'foto'  =>"",
             ]);
            return $user;
        }
        
       
    }
}
