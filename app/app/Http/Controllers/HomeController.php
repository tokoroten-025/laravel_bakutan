<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Booking;

use Auth;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // latest()はEloquentクエリビルダのメソッド。DBに保存されているレコードを作成日時または更新日時の降順で並び替える役割がある。最新のレコードを取得するためによく使用されるメソッド。
        // 旅館ユーザーが投稿したデータを取得する（最新の5件）
        $latestPosts = Post::latest()->take(5)->get();

        // ログインユーザーが自分が投稿したデータも取得する
        $userPosts = Auth::user()->post()->get();

        // dd($posts);

        // 取得した投稿データをビューに渡す
        return view('home',[
            'latestPosts' => $latestPosts,
            'userPosts' => $userPosts
        ]);
    }
    // POSTにBookingを紐づけようとするとエラーっぽい表示が出るから一旦パス！
}