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
        
        $user = User::create(request(['name', 'email', 'password', 'username']));
        
        auth()->login($user);
        
        return redirect()->to('/');
    }
}
