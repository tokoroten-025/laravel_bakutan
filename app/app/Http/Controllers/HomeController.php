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
        $this->middleware('auth')->except(['index']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function index()
    {
        // ユーザーがログインしている場合の処理
        if (Auth::check()) {
            if(Auth::user()->role == 1){
                return redirect('/admins/dashboard');
            }
        // ログインユーザーが自分が投稿したデータも取得する
        $userPosts = Auth::user()->post()->get();
        } else {
            // 未ログインユーザーには空のコレクションを返す
            $userPosts = collect();
        }
        // latest()はEloquentクエリビルダのメソッド。DBに保存されているレコードを作成日時または更新日時の降順で並び替える役割がある。最新のレコードを取得するためによく使用されるメソッド。
        // 旅館ユーザーが投稿したデータを取得する（最新の8件）
        $latestPosts = Post::latest()->take(8)->get();
        // dd($latestPosts);
        $keyword = '';
        $checkindate = '';
        $price_range = '';

        // 取得した投稿データをビューに渡す
        return view('home', [
            'latestPosts' => $latestPosts,
            'userPosts' => $userPosts,
            'keyword' => $keyword,
            'checkindate' => $checkindate,
            'price_range' => $price_range,
        ]);

    }
}