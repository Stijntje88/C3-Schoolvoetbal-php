<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BaseController extends Controller
{
    public function home(){
        return view('home');
    }

    public function user(){
        $user = Auth::user();
        return view('profiles.user', ['user' => $user]);
    }

    public function logout(User $user){
        Auth::logout($user);
        return view('home');
    }
}
