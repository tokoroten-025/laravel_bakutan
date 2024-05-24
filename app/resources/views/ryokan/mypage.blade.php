@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">★Welcome to your profile page★</div>
                <div class="card-body">
                    <h5 class="card-title"></h5>
                    <!-- ユーザー情報の表示 -->
                    <div>
                        <p>ユーザー名: {{ Auth::user()->name }}</p>
                        <p>メールアドレス: {{ Auth::user()->email }}</p>
                        <p>ユーザーアイコン: 
                            @if(Auth::user()->icon)
                                <img src="{{ asset('storage/' . Auth::user()->icon) }}" alt="User icon" class="img-thumbnail">
                            @else
                                <img src="{{ asset('default-icon.png') }}" alt="Default icon" class="img-thumbnail">
                            @endif
                    </div>
                    <!-- ユーザー情報編集リンク -->
                    <a href="{{ route('ryokan.edit', Auth::user()->id) }}" class="btn btn-primary">編集</a>

                    <!-- 新規投稿の追加リンク -->
                    <a href="{{ route('posts.create') }}" class="btn btn-success">新しい投稿をする</a>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-4 justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">マイリスト</div>
                <div class="card-body">
                    <!-- 投稿内容を表示 -->
                    @foreach($posts as $post)
                    <div class="card mb-3">
                    <a href="{{ route('posts.detail', $post->id) }}" class="card-header">{{ $post->title }}</a>
                    @if($post->image)
                        <img src="{{ asset('public/img/' . $post->id . '/' . $post->image) }}" class="card-img-top" alt="{{ $post->title }}">
                    @endif 
                        <div class="card-body">
                            <p class="card-text">{{ $post->description }}</p>
                            <!-- 編集　-->
                            <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-primary">編集</a>
                            <!-- 削除 -->
                            <form action="{{ route('posts.softDestroyPost', $post->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">削除</button>
                            </form>
                        </div>
                    </div>
                    @endforeach

                    <!-- 投稿がない場合のメッセージ -->
                    @if($posts->isEmpty())
                        <div class="alert alert-info mt-3">
                            まだ投稿がありません。
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<!-- TOPへ戻るボタン -->
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <a href="/" class="btn btn-primary">TOPへ戻る</a>
        </div>
    </div>
</div>
@endsection