@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>
                
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <!-- 旅館の予約サイトのメイン -->
                    <div class="container mt-5">
                        <div class="row">
                            <div class="col">
                                <h1>Welcome</h1>
                                <p>癒しのお宿を集めました </p>
                                <a href="{{ route('ryokan.mypage') }}" class="btn btn-primary">マイページへ</a>                                <!-- このGoのボタンは後で変える ５/3 -->
                            </div>
                        </div>

                    <!--投稿データを表示する -->
                    @foreach ($latestPosts as $post)
                        <div class="card mb-3">
                            <div class="card-header">{{ $post->title }}</div>
                            <div class="card-body">
                                <p class="card-text">{{ $post->content }}</p>
                                <!-- その他の投稿情報を表示 -->
                            </div>
                        </div>
                    @endforeach
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
