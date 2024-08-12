<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Item;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Condition;


class ItemController extends Controller
{
    //トップページ表示
    public function index()
    {
        $items = Item::all();

        return view('index', compact('items'));
    }

    //商品検索機能
    public function search(Request $request)
    {
        $query = Item::query();
        if ($request->filled('keyword')) {
            $query->keywordSearch($request->input('keyword'));
        }
        $items = $query->get();

        return view('index', compact('items'));
    }

    //商品詳細ページ
    public function detail($item_id)
    {
        $categories = Category::all();
        $conditions = Condition::all();
        $item = Item::with('category','condition','comments')->find($item_id);
        $sellerId = $item->user_id; // 出品者のuser_id

        return view('detail', compact('item', 'categories', 'conditions', 'sellerId'));
    }

    //コメント投稿機能
    public function comment(Request $request, $item_id){
        
        $user_id = Auth::user()->id;
        $form = $request->all();
        $form['user_id'] = $user_id;
        $form['item_id'] = $item_id;
        Comment::create($form);

        return redirect()->route('detail', ['item_id' => $item_id]); 
    }
}
