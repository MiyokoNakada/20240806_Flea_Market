<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Comment;
use App\Mail\AdminMail;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\EmailRequest;
use App\Http\Requests\SearchRequest;

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
    public function deleteUser(Request $request)
    {
        $user_id = $request->id;
        User::find($user_id)->delete();

        return redirect('/admin/user')->with('message', 'ユーザーが削除されました。');
    }

    //ユーザー検索機能
    public function userSearch(SearchRequest $request)
    {
        $query = User::query();
        if ($request->filled('keyword')) {
            $query->keywordSearch($request->input('keyword'));
        }
        $users = $query->get();

        return view('admin_user', compact('users'));
    }

    //コメント管理ページ表示
    public function commentManagement()
    {
        $comments = Comment::with('user', 'item')->get();
        return view('admin_comment', compact('comments'));
    }

    //コメント削除機能
    public function deleteComment(Request $request)
    {
        $comment_id = $request->id;
        Comment::find($comment_id)->delete();

        return redirect('/admin/comment')->with('message', 'コメントが削除されました。');
    }

    //コメント検索機能
    public function commentSearch(SearchRequest $request)
    {
        $query = Comment::query();
        if ($request->filled('keyword')) {
            $query->keywordSearch($request->input('keyword'));
        }
        $comments = $query->get();

        return view('admin_comment', compact('comments'));
    }

    //メール送信機能
    public function sendEmail(EmailRequest $request)
    {
        $emails = [
            'title' => $request->title,
            'body' => $request->body
        ];
        Mail::to($request->email_address)->send(new AdminMail($emails));

        return redirect('/admin')->with('message', 'メールが送信されました');
    }
}
