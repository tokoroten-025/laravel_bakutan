@extends('layouts.app')

@section('content')
<style>
    /* .img-fluid クラスを使用して、画像がレスポンシブになり、一貫した高さを保つように */
    .img-fluid {
        height: 200px; /* 画像の高さを指定 */
        width: 100%;  /* 画像の幅を100%に指定 */
        object-fit: cover; /* 画像をボックスにフィットさせる */
    }
</style>


<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-9">
            <div class="card-body">
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif
                <!-- キーワード、チェックイン日、価格帯での検索 -->
                <form action="{{ route('search.result') }}" method="get">
                    <div class="form-row">
                        <div class="col-md-4">
                            <input type="text" class="form-control" name="keyword" placeholder="キーワード" value="{{ $keyword }}">
                        </div>
                        <div class="col-md-4">
                            <input type="date" class="form-control" name="checkindate" placeholder="チェックイン日" value="{{ $checkindate }}">
                        </div>
                        <div class="col-md-4">
                            <select class="form-control" name="price_range" value="{{ $price_range }}">
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
 
            <!-- ログインユーザーのロールに応じて表示を切り替える。role == 10 は一般ユーザー、role == 2 は旅館ユーザー-->
            @if(Auth::check())
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
                    <!--最新の投稿データをカード形式で表示し、画像と投稿の詳細へのリンクで表示する -->
                    <!-- ２列に -->
                    <div class="row">
                        @foreach ($latestPosts as $post)
                        <div class="col-md-6 mb-4">
                            <div class="card h-100">
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
                <!-- 旅館ユーザーの場合 -->
                    @elseif(Auth::user()->role == 2) 
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
            @else
            <!-- 未ログインユーザー向けのコンテンツ -->
                <p>ゲストユーザーです。ログインまたは新規登録してください。</p>

                <!-- 最新の投稿一覧を表示 -->
                    <div class="row">
                        @foreach ($latestPosts as $post)
                        <div class="col-md-6 mb-4">
                            <div class="card h-100">
                                <!-- タイトルをリンク -->
                                <a href="{{ route('posts.detail', $post) }}" class="card-header">{{ $post->title }}</a>
                                <div class="card-body">
                                    <!-- 画像を表示 -->
                                    @if ($post->image)
                                        <img src="{{ asset('img/' . $post->id . '/' . $post->image) }}" alt="{{ $post->title }}" class="img-fluid">
                                    @else
                                        <p>画像がありません</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    @if (session('status'))
        Swal.fire({
            title: '成功!',
            text: "{{ session('status') }}",
            icon: 'success',
            confirmButtonText: 'OK'
        });
    @endif
</script>
@endsection