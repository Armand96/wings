<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    //
    public function loginPage()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        $data = $request->except(['_token']);;

        try {
            if(Auth::attempt($data))
            {
                if(Auth::user()->is_admin) return redirect()->route('admin.product');
                else return redirect()->route('client.products');
            }
            else return redirect()->back()->withErrors(['notif' => 'user atau password salah']);
        } catch (\Throwable $th) {
            throw $th;
            return redirect()->back()->withErrors(['notif' => $th->getMessage()]);
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login.page')->with(['notif' => 'Berhasil logout']);
    }

    public function checkLogin()
    {
        if(Auth::check()) return redirect()->route('/login');
        else return view('admin.product');
    }
}
