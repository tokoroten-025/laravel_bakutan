<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\BookingController;
use App\Like;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // ログインしているユーザーの情報を取得
        $user = Auth::user();
        
        // 旅館ユーザーに紐づく投稿を取得
        $latestPosts = Post::all();
        
       // 投稿一覧ページを表示
    //    return view('ryokan.mypage', ['user' => $user, 'posts' => $latestPosts]);
            
            $keyword = $request->input('keyword');
        
            $query = Post::query();
        
            if(!empty($keyword)) {
                $query->where('title', 'LIKE', "%{$keyword}%")
                    ->orWhere('author', 'LIKE', "%{$keyword}%");
            }
        
            $posts = $query->get();
    
            return view('index', compact('posts', 'keyword'));
            
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

     public function create()
    {
        $checkindate = date('Y-m-d');
        $checkoutdate = date('Y-m-d');
        return view('posts.create', compact('checkindate', 'checkoutdate'));
    }
    
    // 投稿を保存する処理
    public function store(Request $request)
    {
            //バリデーション


            // ログインしているユーザーの ID を取得
            $userId = auth()->id();

            // データベースに投稿を保存
            $post = new Post();
            $post->title = $request->title;
            $post->content = $request->content;
            $post->amount = $request->amount;
            // ユーザーの ID をセット　書く場所間違えてた。なんでここか後で聞く
            $post->user_id = $userId;
            $post->checkindate = $request->checkindate;
            $post->checkoutdate = $request->checkoutdate;
            $post->reservation_datetime = now(); // 現在の日時を設定
            if ($request->hasFile('image')) {
                $imageName = $request->file('image')->getClientOriginalName();
                $extension = $request->file('image')->getClientOriginalExtension();
                $newImageName = pathinfo($imageName, PATHINFO_FILENAME) . "_" . uniqid() . "." . $extension;
                $post->image = $newImageName;
                $post->save();
            
                $lastInsertedId = $post->id;
                if (!file_exists(public_path() . "/img/" . $lastInsertedId)) {
                    mkdir(public_path() . "/img/" . $lastInsertedId, 0777);
                }
                $request->file('image')->move(public_path() . "/img/" . $lastInsertedId . "/" ,$newImageName);
            } else {
                $post->save();
                // 保留：ファイルの保存に失敗した場合の処理も必要？？？
            }
            // マイページにリダイレクトする
            return redirect()->route('ryokan.mypage');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        //【いいね機能】
        $like_model = new Like;//Likeモデルのデータ取得
        $post_like = Post::withCount('likes')->find($post->id);

        // dd($post);

        // 特定の投稿の詳細を表示
        return view('posts.detail', [
            'post' => $post,
            'like_model' => $like_model,
            'post_like' => $post_like,
        ]);

        // 特定の投稿の詳細を表示
        // return view('posts.detail', ['post' => $post]);
    }

    // いいね機能
    public function ajaxlike(Request $request)
    {
        // dd('ajax成功');
        $id = Auth::user()->id;
        $post_id = $request->post_id;
        $like = new Like;
        $post = Post::findOrFail($post_id);

        if ($like->like_exist($id, $post_id)) {
            $like = Like::where('post_id', $post_id)->where('user_id', $id)->delete();
        } else {
            // $like = new Like;
            $like->post_id = $request->post_id;
            $like->user_id = Auth::user()->id;
            $like->save();
        }
        
        $postLikesCount = $post->loadCount('likes')->likes_count;
        
        $json = [
            'postLikesCount' => $postLikesCount,
        ];
        //下記の記述でajaxに引数の値を返す
        return response()->json($json);
    }

    // いいね一覧
    public function likedPosts()
    {
        // ログインしているユーザーがいいねした投稿を取得
        $userLikes = Auth::user()->likes()->with('post')->get();

        // いいねした投稿の一覧ページを表示
        return view('posts.liked', ['userLikes' => $userLikes]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        // 投稿データをビューに渡す
        return view('posts.edit', compact('post'));
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
        // dd($request);
        $post = Post::find($id);
    // 投稿の内容を更新
        $post->title = $request->input('title');
        $post->content = $request->input('content');
        $post->amount = $request->input('amount');
        $post->checkindate = $request->input('checkindate'); // チェックイン日を更新
        $post->checkoutdate = $request->input('checkoutdate'); // チェックアウト日を更新
        
        $post->save();
        // 更新後に編集した投稿の詳細ページにリダイレクト
        return redirect()->route('posts.detail', $post->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    
    public function softDestroyPost(Post $post)
    {
        $post->del_flg = 1;

        $post->save();
        // 投稿を削除
        $post->delete();

        // マイページにリダイレクト
        return redirect()->route('ryokan.mypage')->with('success', '投稿が削除されました');
    }
}
