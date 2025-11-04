<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AddressController extends Controller
{
     /**
     * 住所変更フォーム表示
     */
    public function showForm()
    {
        
        return view('purchase.address');
    }

   
}
