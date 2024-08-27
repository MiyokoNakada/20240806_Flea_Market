<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\User;
use App\Models\Item;
use App\Models\Profile;
use App\Models\Order;
use App\Http\Requests\ProfileRequest;

class MypageController extends Controller
{
    //マイページ表示
    public function mypage()
    {
        $user_id = Auth::id();
        $user = User::find($user_id);
        $items = Item::where('user_id', $user_id)->get();

        return view('mypage', compact('user', 'items'));
    }

    //購入商品表示機能
    public function boughtItems()
    {
        $user_id = Auth::id();
        $user = User::find($user_id);
        $boughtItems = Order::where('user_id', $user_id)
            ->with('item')
            ->get();
        $items = $boughtItems->pluck('item');

        return view('mypage', compact('user', 'items'));
    }

    //プロフィール編集ページ表示
    public function profile()
    {
        return view('profile');
    }

    //プロフィール更新機能
    public function updateProfile(ProfileRequest $request)
    {
        $user_id = Auth::user()->id;
        $form = $request->all();
        $form['user_id'] = $user_id;

        $profile = Profile::where('user_id', $user_id)->first();
        if ($profile) {
            $profile->update($form);
        } else {
            $profile = Profile::create($form);
        }
        User::find($user_id)->update(['name' => $form['name']]);

        if ($request->hasFile('profile_image')) {
            $imageFile = $request->file('profile_image');
            $imageName = $imageFile->getClientOriginalName();
            if (app()->environment('local')) {
                $imageFile->storeAs('public/image', $imageName);
                $form['profile_image'] = $imageName;
            } else {
                Storage::disk('s3')->put('image/' . $imageName, file_get_contents($imageFile));
                Storage::disk('s3')->setVisibility('image/' . $imageName, 'public');
                $form['profile_image'] = $imageName;
            }
            Profile::find($profile->id)->update($form);
        }

        return redirect('/mypage')->with('message', 'プロフィールを更新しました');
    }
}
