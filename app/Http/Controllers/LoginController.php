<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function create()
    {
        return view('login');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'username' => 'required',
            'password' => 'required',
        ]);
    
        $login_type = filter_var($request->input('username'), FILTER_VALIDATE_EMAIL ) 
            ? 'email' 
            : 'username';
    
        $request->merge([
            $login_type => $request->input('username')
        ]);

        if (Auth::attempt($request->only($login_type, 'password'))) {
            return redirect('/');
        }

        return redirect()->back()
            ->withInput()
            ->withErrors([
                'username' => 'Estas credenciales no coinciden con nuestros registros.',
            ]);
    }
}
