<!-- // admin.blade.php -->

@extends('layouts.app')

@section('content')
// admin.blade.php

@extends('layouts.app')

@section('content')
<div class="container">
    <h1>管理者ページ</h1>

    <h2>一般ユーザーのリスト</h2>
    <ul>
        @foreach ($Users as $user)
            <li>{{ $user->name }} - {{ $user->email }}</li>
        @endforeach
    </ul>

    <h2>旅館運営ユーザーの投稿のリスト</h2>
    <ul>
        @foreach ($ryokanPosts as $post)
            <li>{{ $post->title }} - {{ $post->content }}</li>
        @endforeach
    </ul>
</div>
@endsection
