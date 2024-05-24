@extends('layouts.app')

@section('content')
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
                    <form action="{{ route('search') }}" method="GET">
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
                                <button type="submit" class="btn btn-link text-decoration-none">検索</button>
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
                        @foreach ($latestPosts as $post)
                                <div class="card mb-3">
                                    <!-- タイトルをリンク -->
                                    <a href="{{ route('posts.detail', $post) }}" class="card-header">{{ $post->title }}</a>
                                    <div class="card-body">
                                        <!-- 画像を表示 -->
                                        @if ($post->image)
                                            <img src="{{ asset('img/' . $post->id . '/' . $post->image) }}" alt="{{ $post->title }}" class="img-fluid">
                                        @endif
                                        <p class="card-text">{{ $post->content }}</p>
                                    </div>
                                </div>
                        @endforeach
                    
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
                            @foreach ($latestPosts as $post)
                                <div class="card mb-3">
                                    <!-- タイトルをリンク -->
                                    <a href="{{ route('posts.detail', $post) }}" class="card-header">{{ $post->title }}</a>
                                    <div class="card-body">
                                        <!-- 画像を表示 -->
                                        @if ($post->image)
                                            <img src="{{ asset('img/' . $post->id . '/' . $post->image) }}" alt="{{ $post->title }}" class="img-fluid">
                                        @endif
                                        <p class="card-text">{{ $post->content }}</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
