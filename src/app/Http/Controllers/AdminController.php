<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    //Adminページ表示
    public function admin()
    {
        return view('admin');
    }
}
