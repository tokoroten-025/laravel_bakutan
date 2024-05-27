@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">マイ予約一覧</div>
                
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">予約内容</th>
                                <th scope="col">投稿詳細</th>
                                <th scope="col">チェックイン</th>
                                <th scope="col">チェックアウト</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($userBookings as $booking)
                            <tr>
                                <th scope="row">{{ $booking->id }}</th>
                                <td>
                                    <a href="{{ route('posts.detail', ['post' => $booking->post_id]) }}">
                                        {{ $booking->post->title }}
                                    </a>
                                </td>
                                <td>{{ $booking->checkindate }}</td>
                                <td>{{ $booking->checkoutdate }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="card-footer">
                    <a href="{{ route('user.mypage') }}" class="btn btn-primary">マイページへ戻る</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
