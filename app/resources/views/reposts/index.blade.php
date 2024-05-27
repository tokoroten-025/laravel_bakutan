<!-- resources/views/reposts/index.blade.php -->

@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">違反報告一覧</div>
                <div class="card-body">
                    @if($reposts->isEmpty())
                        <p>現在、違反報告はありません。</p>
                    @else
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>投稿ID</th>
                                    <th>理由</th>
                                    <th>処理状況</th>
                                    <th>アクション</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($reposts as $repost)
                                    <tr>
                                        <td>{{ $repost->id }}</td>
                                        <td>{{ $repost->post_id }}</td>
                                        <td>{{ $repost->reason }}</td>
                                        <td>{{ $repost->resolved ? '処理済み' : '未処理' }}</td>
                                        <td>
                                            <a href="{{ route('reposts.show', $repost->id) }}" class="btn btn-primary btn-sm">詳細</a>
                                            @if(!$repost->resolved)
                                                <form action="{{ route('reposts.resolve', $repost->id) }}" method="POST" style="display:inline;">
                                                    @csrf
                                                    @method('PUT')
                                                    <button type="submit" class="btn btn-success btn-sm">処理</button>
                                                </form>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
