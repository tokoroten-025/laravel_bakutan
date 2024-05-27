<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Post;// 予約した投稿を表示するために必要
use App\User;
use App\Booking;

class UserPageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *å
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

    // 予約一覧
    public function myBookings()
    {
        $user = Auth::user();
        // 現在ログインしているユーザーの予約一覧を取得
        $userBookings = Booking::where('user_id', Auth::id())->get();

        // ユーザーの予約一覧をビューに渡す
        return view('user.bookings', ['userBookings' => $userBookings]);
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
