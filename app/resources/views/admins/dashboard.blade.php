@extends('layouts.app')

@section('content')
<!-- Bootstrap Icons CDN -->
<!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.0/font/bootstrap-icons.min.css"> -->

<style>
    .action-button {
        text-align: center;
        vertical-align: middle;
    }

    .action-button button {
        margin: auto;
    }
</style>

<div class="container">
    <h1>管理者用画面</h1>

    <!-- 一般ユーザーのリスト -->
    <h2>一般ユーザーのリスト（違反報告されたユーザー上位10件）</h2>
    <div style="max-height: 400px; overflow-y: auto; margin-top: 20px;">
        <table class="table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>ユーザー名</th>
                    <th>表示停止された投稿件数</th>
                    <th>アクション</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->posts_count }}</td>
                        <td class="action-button">
                            <!-- 利用停止ボタン -->
                            <button class="btn btn-danger">
                                <i class="bi bi-x-circle"></i> 利用停止
                            </button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- 投稿のリスト -->
    <h2>投稿のリスト（違反報告数の多い投稿上位20件）</h2>
    <div style="max-height: 400px; overflow-y: auto;">
        <table class="table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>タイトル</th>
                    <th>違反報告数</th>
                    <th>アクション</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($posts as $post)
                    <tr>
                        <td><a href="{{ route('posts.detail', $post->id) }}">{{ $loop->iteration }}</a></td>
                        <td>{{ $post->title }}</td>
                        <td>{{ $post->reports_count }}</td>
                        <td class="action-button">
                            <!-- 表示停止ボタン -->
                            <button class="btn btn-danger">
                                <i class="bi bi-x-circle"></i> 表示停止
                            </button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
