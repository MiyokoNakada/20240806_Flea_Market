<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Condition;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Item;


class SellController extends Controller
{
    //出品ページ表示
    public function sellerPage()
    {
        $categories = Category::all();
        $conditions = Condition::all(); 

        return view('sell', compact('categories', 'conditions') );
    }

    //出品機能
    public function sell(Request $request)
    {
        $user = Auth::user();
        $form = $request->all();
        $form['user_id'] = $user->id;
        $item = Item::create($form);
        // 画像のアップロード処理(環境に応じて切り分け)
        if ($request->hasFile('image')) {
            $imageFile = $request->file('image');
            $imageName = $imageFile->getClientOriginalName();
            $imageFile->storeAs('public/image' , $imageName);
            $form['image'] = $imageName;
            Item::find($item->id)->update($form);
        }
        return redirect('/')->with('message', '出店しました');
    }
}
