<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RegisterController extends Controller
{
    /**
     * 登録フォーム表示
     */
    public function showForm()
    {
        return view('auth.register');
    }

    
}
