<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\User;


class RyokanPageController extends Controller
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
        // 旅館ユーザーに紐づく投稿を取得
        $userId = Auth::id();
        $latestPosts = Post::where('user_id', $userId)->get(); 
        
        return view('ryokan.mypage', ['posts' => $latestPosts]);
        
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
        return view('ryokan.edit');
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
        // バリデーション

        // 指定されたIDに対応するユーザーをデータベースから取得する
        $user = User::findOrFail($id);

        // ユーザー情報を更新
        $user->name = $request->name;
        $user->email = $request->email;

        // ユーザーアイコンがアップロードされた場合は保存
        if ($request->hasFile('icon')) {
            if ($user->icon) {
                Storage::disk('public')->delete($user->icon);
            }

            $iconPath = $request->file('icon')->store('icon','public');
            $user->icon = $iconPath;
        }

        // 保存
        $user->save();

        // 更新後にマイページにリダイレクト
        return redirect()->route('ryokan.mypage')->with('success', 'ユーザー情報が更新されました！');
    }

    // 確認画面
    public function userConfirm(Request $request)
    {
         // お名前とメールアドレスを取得
         $name = $request->name;
         $email = $request->email;
    }

    // 登録
    public function userComplete(Request $request)
    {
        $uploader = new Uploader();
        $uploader->name  = $request->name;
        $uploader->email  = $request->email;
        $uploader->image = $request->image;
        $uploader->save();

        // レコードを挿入したときのIDを取得
        $lastInsertedId = $uploader->id;

        // ディレクトリを作成
        if (!file_exists(public_path() . "/img/" . $lastInsertedId)) {
            mkdir(public_path() . "/img/" . $lastInsertedId, 0777);
        }

        // 一時保存から本番の格納場所へ移動
        rename(public_path() . "/img/tmp/" . $request->image, public_path() . "/img/" . $lastInsertedId . "/" . $request->image);
        
        // 一時保存の画像を削除
        \File::cleanDirectory(public_path() . "/img/tmp");

        return view('uploads.complete');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    // 削除確認画面を表示
    public function confirmDelete()
    {
        return view('users.confirm');
    }

    // アカウントを削除
    public function delete(Request $request)
    {
        // ログイン中のユーザーを取得
        $user = $request->user();

        if ($user->icon) {
            Storage::disk('public')->delete($user->icon);
        }
        // アカウントを削除
        $user->delete();

        // ログアウトしてホーム画面にリダイレクトするなどの処理を追加
        Auth::logout();
        return redirect()->route('home')->with('message', 'アカウントを削除しました');
    }


    // UUserPageController.php

    public function destroy()
    {
        // ログイン中のユーザーを取得
        $user = Auth::user();
        if ($user->icon) {
            Storage::disk('public')->delete($user->icon);
        }
        
        // ユーザーに関連する情報を削除する例
        // $user->posts()->delete();
        // $user->bookings()->delete();

        // ユーザーを削除
        $user->delete();

        // ログアウトさせて
        Auth::logout();

        // リダイレクトまたはメッセージを表示
        return redirect()->route('home')->with('success', '退会しました。');
    }

}
