@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">★一般ユーザー★</div>
                <div class="card-body">
                    <h5 class="card-title"></h5>
                    <!-- ユーザー情報の表示 -->
                    <div>
                        <p>ユーザー名: {{ Auth::user()->name }}</p>
                        <p>メールアドレス: {{ Auth::user()->email }}</p>
                        <!-- ユーザーアイコン -->
                        @if (Auth::user()->icon)
                            <p>ユーザーアイコン: <img src="{{ Storage::url(Auth::user()->icon) }}" alt="User icon" class="img-thumbnail"></p>
                        @endif
                    </div>
                    <!-- ユーザー情報編集リンク -->
                    <a href="{{ route('user.edit', Auth::user()->id) }}" class="btn btn-primary">編集</a>

                    <!-- 新規投稿の追加リンク -->
                    <!-- <a href="{{ route('posts.create') }}" class="btn btn-success">新しい投稿をする</a> -->
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-4 justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">マイリスト</div>
                
                <div class="card-body">
                    @if ($bookings->isEmpty())
                        <p>まだ予約はありません</p>
                    @else
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    
                                    <tr>
                                        <th scope="col"></th>
                                        <th scope="col">名前</th>
                                        <th scope="col">チェックイン</th>
                                        <th scope="col">チェックアウト</th>
                                        <th scope="col">人数</th>
                                        <th scope="col">連絡先</th>
                                        <!-- <th scope="col">メールアドレス</th> -->
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($bookings as $booking)
                                        <tr>
                                            <th scope="row"><a href="{{ route('posts.detail', ['post' => $booking->post_id] ) }}" class="card-header">詳細</a></th>
                                            <td>{{ $booking->name }}</td>
                                            <td>{{ $booking->checkindate }}</td>
                                            <td>{{ $booking->checkoutdate }}</td>
                                            <td>{{ $booking->num_of_guests }}</td>
                                            <td>{{ $booking->tel }}</td>
                                            <!-- <td>{{ $booking->email }}</td> -->
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>
                <!-- 予約一覧ページへのリンク -->
                <a href="{{ route('my.bookings') }}" class="btn btn-primary">予約一覧へ</a>
                <!-- いいねした投稿一覧ページへのリンク -->
                <a href="{{ route('likes') }}" class="btn btn-pink">いいね一覧へ</a>
        
                </div>

            </div>
        </div>
    </div>
</div>

<!-- TOPへ戻るボタン -->
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <a href="/" class="btn btn-primary">TOPへ戻る</a>
        </div>
    </div>
</div>
@endsection