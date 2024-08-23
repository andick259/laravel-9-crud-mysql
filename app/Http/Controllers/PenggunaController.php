<?php

namespace App\Http\Controllers;
use App\Models\pengguna;
use Illuminate\Http\Request;
use Hash;
use Session;

class PenggunaController extends Controller
{
    public function login(){
        return view("/auth/login");
    }

    public function registration(){
        return view("/auth/register");
    }

    public function create_register(Request $request)
    {
       $request->validate([
        'username'=>'required',
        'email'=>'required|email',
        'password'=>'required'
       ], [
        'username.required' => 'Username wajib diisi',
        'email.required' => 'Email wajib diisi',
        'email.email' => 'Penulisan email salah',
        'password.required' => 'Password wajib diisi'
       ]);
        $data = [
            'username'=>$request->input('username'),
            'email'=>$request->input('email'),
            'password'=>Hash::make($request->input('password')),
            'status'=>$request->input('status')
        ];
        pengguna::create($data);
        return redirect('/auth/login')->with('success', 'Registrasi Berhasil Silakan Login');
    }

    public function sign_in(Request $request){
        $request->validate([
            'username'=>'required',
            'password'=>'required'
           ], [
            'username.required' => 'Username wajib diisi',
            'password.required' => 'Password wajib diisi'
           ]);
           $user = pengguna::where('username','=', $request->username)->first();
           if($user){
            if(Hash::check($request->password, $user->password)){
                $request->session()->put('loginId', $user->username);
                return redirect('/dashboard');
            }else{
                return redirect('/auth/login')->with('success','Password Salah');
            }
           }else{
                return redirect('/auth/login')->with('success','Gagal Login. Akun Belum Terdaftar');
           }
        }

    public function dashboard(){
        $user = array();
        if(Session::has('loginId')){
            $user = pengguna::where('username','=', Session::get('loginId'))->first();
        }
        return view('/dashboard', compact('user'));
    }

    public function logout(){
        if(Session::has('loginId')){
            Session::pull('loginId');
           return redirect('/auth/login');
        }
    }

}
