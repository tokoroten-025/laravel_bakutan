<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repost; 
use App\Post; // 違反報告の対象である投稿を使用するために記載
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class RepostController extends Controller
{
    public function reportPost(Request $request, $postId)
    {
        $request->validate([
            'reason' => 'required|string|max:300',
            // 'comment' => 'required|string|max:1000',
        ]);

        // 違反報告を保存
        $repost = new Repost(); 
        $repost->post_id = $postId;
        $repost->reason = $request->input('reason');
        $repost->user_id = Auth::id(); // 認証されたユーザーのIDを取得
        $repost->save();

        return redirect()->back()->with('success', '違反が報告されました。');
    }

    // すべての違反報告を表示
    public function index()
    {
        $reposts = Repost::all(); 
        return view('reposts.index', ['reposts' => $reposts]);
    }

    // 特定の違反報告を表示
    public function show($id)
    {
        $repost = Repost::findOrFail($id); 
        return view('reposts.show', ['repost' => $repost]); 
    }

    // 違反報告を処理
    public function resolve(Request $request, $id)
    {
        $repost = Repost::findOrFail($id); 
        // 違反報告を処理するロジックを実装
        $repost->resolved = true;
        $repost->save();
        Session::flash('success', '違反が報告されました。');
        return redirect()->back();
        // リダイレクト後もフラッシュメッセージが保持
    }
}

