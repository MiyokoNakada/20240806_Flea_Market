<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;


class ItemController extends Controller
{
    //トップページ表示
    public function index()
    {
        $items = Item::all();

        return view('index', compact('items'));
    }

    //検索機能
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
        $item = Item::find($item_id);

        return view('detail', compact('item'));
    }

}
