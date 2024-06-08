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

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // return view('home');

        if(Auth::user()->role == 1){
            return redirect('/admins/dashboard');
        }
        // latest()はEloquentクエリビルダのメソッド。DBに保存されているレコードを作成日時または更新日時の降順で並び替える役割がある。最新のレコードを取得するためによく使用されるメソッド。
        // 旅館ユーザーが投稿したデータを取得する（最新の5件）
        $latestPosts = Post::latest()->take(5)->get();
        // dd($latestPosts);
        // ログインユーザーが自分が投稿したデータも取得する
        $userPosts = Auth::user()->post()->get();

        // dd($posts);

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