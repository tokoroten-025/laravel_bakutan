<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // 全ての投稿を取得
        $posts = Post::all();
        
        // 投稿一覧ページを表示
        return view('posts.index', ['posts' => $posts]);
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createPostForm()
    {
        // 新規投稿フォームを表示するページ
        return view('create.post');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    // 投稿を保存する処理
    public function store(Request $request)
    {
        //バリデーション


        // データベースに投稿を保存
        $post = new Post();
        $post->title = $request->title;
        $post->availability = $request->availability;
        $post->content = $request->content;
        $post->amount = $request->amount;
        // 画像のパスを保存（省略）
        $post->save();


        // マイページにリダイレクトする
        // return redirect('/mypage')
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
