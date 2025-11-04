<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PurchaseController extends Controller
{
    public function showForm()
    {

        return view('purchase.buy');
    }

   
}
