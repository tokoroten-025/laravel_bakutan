@extends('layouts.app')

@section('content')
<div class="container">
    <h1>管理者用画面</h1>

    <!-- 一般ユーザーのリスト -->
    <h2>一般ユーザーのリスト（表示停止された投稿件数上位10件）</h2>
    <ul>
        @foreach ($users as $user)
            <li>{{ $user->name }} - 表示停止された投稿件数: {{ $user->posts_count }}</li>
        @endforeach
    </ul>

    <!-- 投稿のリスト -->
    <h2>投稿のリスト（違反報告数の多い投稿上位20件）</h2>
    <table class="table">
        <thead>
            <tr>
                <th>#</th>
                <th>タイトル</th>
                <th>違反報告数</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($posts as $post)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $post->title }}</td>
                    <td>{{ $post->reports_count }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
