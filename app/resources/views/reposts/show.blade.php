<!-- resources/views/reposts/show.blade.php -->

@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">違反報告詳細</div>
                <div class="card-body">
                    <p><strong>投稿ID: </strong>{{ $repost->post_id }}</p>
                    <p><strong>理由: </strong>{{ $repost->reason }}</p>
                    <p><strong>処理状況: </strong>{{ $repost->resolved ? '処理済み' : '未処理' }}</p>
                    @if(!$repost->resolved)
                        <form action="{{ route('reposts.resolve', $repost->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <button type="submit" class="btn btn-success">処理</button>
                        </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
