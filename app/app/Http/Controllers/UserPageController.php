<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Post;// 予約した投稿を表示するために必要
use App\User;


class UserPageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // 現在ログインしているユーザーの情報を取得
        $user = Auth::user();
        $userPosts = Post::where('user_id', $user->id)->latest()->get();

        // dd($user, $userPosts);

        // ユーザー情報と投稿をマイページビューに渡して表示
        return view('user.mypage', ['user' => $user, 'userPosts' => $userPosts]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        // return view('user.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // //  バリデーションなどの処理が必要

        // // 新しい投稿を作成
        // $post = new Post();
        // $post->user_id = auth()->id();
        // $post->title = $request->title;
        // $post->content = $request->content;
        // // 他の必要な属性を追加

        // // 保存
        // $post->save();

        // return redirect()->route('user.mypage')->with('success', '新しい投稿が作成されました！');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $user = User::findOrFail($id);
        return view('user.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // $user = Auth::user();
        $user = User::findOrFail($id);
        $user->name = $request->name;
        $user->email = $request->email;

        if ($request->hasFile('icon')) {
            if ($user->icon) {
                Storage::disk('public')->delete($user->icon);
            }
            $iconPath = $request->file('icon')->store('icon', 'public');
            $user->icon = $iconPath;
        }

        $user->save();

        return redirect()->route('user.mypage')->with('success', 'ユーザー情報が更新されました！');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        if ($user->icon) {
            Storage::disk('public')->delete($user->icon);
        }
        $user->delete();

        Auth::logout();

        return redirect()->route('home')->with('message', 'アカウントを削除しました');
    
    }
}
