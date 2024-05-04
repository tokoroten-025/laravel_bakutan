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
                            <a href="{{ route('post.show', $post->id) }}" class="btn btn-primary">View Listing</a>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
