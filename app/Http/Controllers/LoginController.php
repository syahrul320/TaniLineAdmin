<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class LoginController extends Controller
{

    public function index()
    {
        return view('login.index');
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            $user = Auth::getProvider()->retrieveByCredentials($credentials);
            Auth::login($user, $request->get('remember'));

            if($user->level != 'admin'){
                Auth::logout();
                return back()->with('loginError', 'Login hanya untuk admin');
            }

            return redirect()->intended('dashboard');
        }

        return back()->with('loginError', 'Akun tidak ditemukan');
    }


    protected function authenticated(Request $request, $user) 
    {   
        Auth::logoutOtherDevices($request->password);
    
        return redirect()->intended();
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }

    public function privacy()
    {
        return view('privacy.privacy');
    }
}
