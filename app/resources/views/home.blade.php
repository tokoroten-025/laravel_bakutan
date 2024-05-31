@extends('layouts.app')

@section('content')
<style>
    .img-fluid {
        height: 200px; /* 画像の高さを指定 */
       width: 100%;  /*  画像の幅を100%に指定 */
        object-fit: cover; /* 画像をボックスにフィットさせる */
    }
</style>

<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-9">
            <div class="card">
                <div class="card-header">Dashboard</div>
            </div>
            <div class="card-body">
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif
                <!-- 検索 -->
                <form action="{{ route('search.result') }}" method="GET">
                    <div class="form-row">
                        <div class="col-md-4">
                            <input type="text" class="form-control" name="keyword" placeholder="キーワード">
                        </div>
                        <div class="col-md-4">
                            <input type="date" class="form-control" name="checkindate" placeholder="チェックイン日">
                        </div>
                        <div class="col-md-4">
                            <select class="form-control" name="price_range">
                                <option value="">金額を選択</option>
                                <option value="0-5000">0 - 5000円</option>
                                <option value="5001-10000">5001 - 10000円</option>
                                <option value="10001-50000">10001 - 50000円</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-row mt-3">
                        <div class="col-md-12 text-right">
                            <button type="submit" class="btn btn-link text-decoration-none"></button>
                        </div>
                    </div>
                </form>

                <!-- 旅館の予約サイトのメイン -->
                <!-- ログインユーザーのロールに応じて表示を切り替える-->
                @if(Auth::user()->role == 10)
                    <!-- 一般ユーザー向けのコンテンツ -->
                    <div class="container mt-3">
                        <div class="row justify-content-center">                               
                            <div class="col-md-4">
                                <h1>Welcome</h1>
                                <p>癒しのお宿を集めました </p> 
                            </div>
                        </div>
                    </div>
                    <!--投稿データを表示する -->
                    <!-- ２列に -->
                    <div class="row">
                        @foreach ($latestPosts as $post)
                        <div class="col-md-6 mb-4">
                            <div class="card">
                                <!-- タイトルをリンク -->
                                <a href="{{ route('posts.detail', $post) }}" class="card-header">{{ $post->title }}</a>
                                <div class="card-body">
                                    <!-- 画像を表示 -->
                                    @if ($post->image)
                                        <img src="{{ asset('img/' . $post->id . '/' . $post->image) }}" alt="{{ $post->title }}" class="img-fluid">
                                    @else
                                        <p>画像がありません</p>
                                    @endif
                                    <!-- 内容 -->
                                    <!-- <p class="card-text">{{ $post->content }}</p> -->
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                @elseif(Auth::user()->role == 2) <!-- 旅館ユーザーの場合 -->
                    <!-- 旅館ユーザー向けのコンテンツ -->   
                    <div class="container mt-3">
                        <div class="row justify-content-center">                               
                            <div class="col-md-3">
                                <h1>Welcome</h1>
                                <p>憩いの場をご用意いたします</p> 
                            </div>
                        </div>
                        <!--投稿データを表示する -->
                        <div class="row">
                            @foreach ($latestPosts as $post)
                            <!-- 1行に２列 -->
                            <div class="col-md-6 mb-4">
                                <div class="card">
                                    <!-- タイトルをリンク -->
                                    <a href="{{ route('posts.detail', $post) }}" class="card-header">{{ $post->title }}</a>
                                    <div class="card-body">
                                        <!-- 画像を表示 -->
                                        @if ($post->image)
                                            <img src="{{ asset('img/' . $post->id . '/' . $post->image) }}" alt="{{ $post->title }}" class="img-fluid">
                                        @else
                                            <p>画像がありません</p>
                                        @endif
                                        <!-- 内容 -->
                                        <!-- <p class="card-text">{{ $post->content }}</p> -->
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
