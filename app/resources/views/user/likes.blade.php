@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">いいねした投稿一覧</div>

                <div class="card-body">
                    @if ($userLikes->isEmpty())
                        <p>まだいいねした投稿はありません。</p>
                    @else
                        <ul class="list-group">
                            @foreach ($userLikes as $like)
                                <li class="list-group-item">
                                    <!-- ここにいいねした投稿の情報を表示 -->
                                    <a href="{{ route('posts.detail', $like->post->id) }}">
                                        {{ $like->post->title }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </div>
                <!-- マイページに戻るボタン -->
                <div class="card-footer">
                    <a href="{{ route('user.mypage') }}" class="btn btn-primary">マイページに戻る</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
