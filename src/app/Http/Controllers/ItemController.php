<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ItemController extends Controller
{
    public function index()
    {
        $items = [];
        return view('items.list', compact('items'));
    }

   

}
