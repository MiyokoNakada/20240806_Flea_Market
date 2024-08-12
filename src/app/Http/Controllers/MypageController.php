<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Item;

class MypageController extends Controller
{
    public function mypage()
    {
        $user_id = Auth::user()->id;
        $user = User::find($user_id);
        $items = Item::where('user_id', $user_id)->get();
      
        return view('mypage', compact('user', 'items'));
    }

    public function profile(){
        return view('profile');
    }
}
