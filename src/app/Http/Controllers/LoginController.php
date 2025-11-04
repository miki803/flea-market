<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
     /**
     * ログイン画面表示
     */
    public function showLogin()
    {
        return view('auth.login');
    }

   
}
