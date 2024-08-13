<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Favourite;

class FavouriteController extends Controller
{
    // お気に入り機能
    public function favourite(Request $request, $item_id)
    {
        $user_id = Auth::id();
        $existingFavourite = Favourite::where('user_id', $user_id)
            ->where('item_id', $item_id)
            ->first();

        if (!$existingFavourite) {
            $favourite = new Favourite();
            $favourite->user_id = $user_id;
            $favourite->item_id = $item_id;
            $favourite->save();
            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false]);
    }

    // お気に入り削除機能
    public function unfavourite(Request $request, $item_id)
    {
        $user_id = Auth::id();
        $existingFavourite = Favourite::where('user_id', $user_id)
            ->where('item_id', $item_id)
            ->first();

        if ($existingFavourite) {
            $existingFavourite->delete();
            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false]);
    }

    //お気に入り数更新
    public function favouriteCount($item_id)
    {
        $count = Favourite::where('item_id', $item_id)->count();
        return response()->json(['count' => $count]);
    }

}
