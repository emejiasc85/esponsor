<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class RegistrationController extends Controller
{

    public function create()
    {
        return view('register');
    }

    public function store(Request $request)
    {

        $this->validate($request, [
            'name'     => 'required',
            'email'    => 'required|email|unique:users,email',
            'username' => 'required|unique:users,username',
            'password' => 'required|confirmed'
        ]);
        
        $user = User::create([
            'name'     => $request->name,
            'username' => $request->username,
            'email'    => $request->email,
            'password' => bcrypt($request->password),
        ]);
        
        auth()->login($user);
        
        return redirect()->to('/');
    }
}
