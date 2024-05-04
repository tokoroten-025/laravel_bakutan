@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">マイページ</div>
                <div class="card-body">
                    <h5 class="card-title">こんにちは, {{ Auth::user()->name }}</h5>
                    <p class="card-text">Welcome to your profile page.</p>
                    <!-- 新規投稿の追加リンク -->
                    <a href="{{ route('posts.create') }}" class="btn btn-success mb-3">新しい投稿を追加する</a>
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-4">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">My Listings</div>
                <div class="card-body">
                    <!-- ユーザーの投稿一覧を表示 -->
                    @foreach($user->posts as $post)
                    <div class="card mb-3">
                        <img src="{{ $post->image }}" class="card-img-top" alt="{{ $post->title }}">
                        <div class="card-body">
                            <h5 class="card-title">{{ $post->title }}</h5>
                            <p class="card-text">{{ $post->description }}</p>
                            <!-- 投稿の編集と削除リンク -->
                            <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-primary">編集</a>
                            <form action="{{ route('posts.destroy', $post->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">削除</button>
                            </form>
                        </div>
                    </div>
                    @endforeach
                    <!-- 投稿がない場合のメッセージ -->
                    @if($user->posts->isEmpty())
                    <div class="alert alert-info mt-3">
                        まだ投稿がありません。
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
