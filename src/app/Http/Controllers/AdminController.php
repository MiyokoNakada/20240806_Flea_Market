<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Comment;

class AdminController extends Controller
{
    //Adminページ表示
    public function admin()
    {
        return view('admin');
    }

    //ユーザー管理ページ表示
    public function userManagement()
    {
        $users = User::all();

        return view('admin_user', compact('users'));
    }

    //ユーザー削除機能
    public function deleteUser(Request $request){
        $user_id = $request->id;
        User::find($user_id)->delete();
        
        return redirect('/admin/user')->with('message', 'ユーザーが削除されました。');
    }


    //コメント管理ページ表示
    public function commentManagement()
    {
        $comments = Comment::with('user', 'item')->get();

        return view('admin_comment', compact('comments'));
    }
    
    //コメント削除機能
    public function deleteComment(Request $request){
        $comment_id = $request->comment_id;
        $comment = Comment::find($comment_id)->delete;

        return redirect()->route('detail')->with('message', 'コメントが削除されました。');
    }
}
