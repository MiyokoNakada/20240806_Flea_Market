<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\Item;
use App\Models\Category;
use App\Models\Condition;
use App\Http\Requests\SellRequest;


class SellController extends Controller
{
    //出品ページ表示
    public function sellerPage()
    {
        $categories = Category::all();
        $conditions = Condition::all();

        return view('sell', compact('categories', 'conditions'));
    }

    //出品機能
    public function sell(SellRequest $request)
    {
        $user = Auth::user();
        $form = $request->all();
        $form['user_id'] = $user->id;
        $item = Item::create($form);

        if ($request->hasFile('image')) {
            $imageFile = $request->file('image');
            $imageName = $imageFile->getClientOriginalName();
            if (app()->environment('local')) {
                $imageFile->storeAs('public/image', $imageName);
                $form['image'] = $imageName;
            } else {
                Storage::disk('s3')->put('image/' . $imageName, file_get_contents($imageFile));
                Storage::disk('s3')->setVisibility('image/' . $imageName, 'public');
                $form['image'] = $imageName;
            }
            Item::find($item->id)->update($form);
        }
        $item->categories()->sync($request->categories);

        return redirect('/')->with('message', '出店しました');
    }
}
