<?php

namespace App\Http\Controllers;


use Illuminate\Support\Facades\Auth;
use App\Models\Item;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Condition;
use App\Models\Favourite;
use App\Http\Requests\SearchRequest;
use App\Http\Requests\CommentRequest;


class ItemController extends Controller
{
    //トップページ表示
    public function index()
    {
        $items = Item::where('sold', false)->get();

        return view('index', compact('items'));
    }

    //お気に入り一覧取得してトップページ表示
    public function myFavourite()
    {
        $user_id = Auth::id();
        $myfavourites = Favourite::where('user_id', $user_id)
            ->with('item')
            ->get();
        $items = $myfavourites->pluck('item');

        return view('index', compact('items'));
    }

    //商品検索機能
    public function search(SearchRequest $request)
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
        $item = Item::with('categories', 'condition', 'comments')
            ->withCount(['favourites','comments'])
            ->find($item_id);

        $sellerId = $item->user_id; 

        $isFavourited = Auth::check() ? Favourite::where('user_id', Auth::id())->where('item_id', $item_id)->exists() : false; 

        return view('detail', compact('item', 'categories', 'conditions', 'sellerId', 'isFavourited'));
    }

    //コメント投稿機能
    public function comment(CommentRequest $request, $item_id)
    {

        $user_id = Auth::user()->id;
        $form = $request->all();
        $form['user_id'] = $user_id;
        $form['item_id'] = $item_id;
        Comment::create($form);

        return redirect()->route('detail', ['item_id' => $item_id]);
    }

    //コメント削除機能
    public function deleteComment($item_id, $comment_id)
    {
        $comment = Comment::find($comment_id);
        if (Auth::id() !== $comment->user_id) {
            abort(403, 'Unauthorized action.');
        }
        $comment->delete();

        return redirect()->route('detail', ['item_id' => $item_id])->with('message', 'コメントが削除されました。');
    }
}
