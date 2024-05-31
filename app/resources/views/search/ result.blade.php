@extends('layouts.app')

@section('content')
<div class="container">
    <h1>検索結果</h1>
    @if($posts->isEmpty())
        <p>該当する投稿が見つかりませんでした。</p>
    @else
        <div class="row">
            @foreach ($posts as $post)
                <div class="col-md-4 mb-3">
                    <div class="card">
                        <div class="card-header">
                            <a href="{{ route('posts.detail', $post) }}">{{ $post->title }}</a>
                        </div>
                        <div class="card-body">
                            @if ($post->image)
                                <img src="{{ asset('img/' . $post->id . '/' . $post->image) }}" alt="{{ $post->title }}" class="img-fluid">
                            @endif
                            <p>{{ $post->content }}</p>
                        </div>
                        <div class="card-footer text-muted">
                            <small>{{ $post->created_at->format('Y-m-d') }}</small>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
