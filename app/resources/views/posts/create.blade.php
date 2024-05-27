@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="form-group">
                    <label for="title">タイトル</label>
                    <input type="text" class="form-control" id="title" name="title" required>
                </div>

                <div class="form-group">
                    <label for="num_of_guests">予約可能人数</label>
                    <input type="text" class="form-control" id="num_of_guests" name="num_of_guests" required>
                </div>

                <div class="form-group">
                    <label for="checkindate">予約開始日</label>
                    <input type="date" class="form-control" id="checkindate" name="checkindate" required>
                </div>

                <div class="form-group">
                    <label for="checkoutdate">予約終了日</label>
                    <input type="date" class="form-control" id="checkoutdate" name="checkoutdate" required>
                </div>

                <div class="form-group">
                    <label for="content">内容</label>
                    <textarea class="form-control" id="content" name="content" rows="5" required></textarea>
                </div>

                <div class="form-group">
                    <label for="image">画像</label>
                    <input type="file" class="form-control-file" id="image" name="image">
                </div>

                <div class="form-group">
                    <label for="amount">金額</label>
                    <input type="number" class="form-control" id="amount" name="amount" required>
                </div>

                <button type="submit" class="btn btn-primary">投稿する</button>
                <a href="{{ route('user.mypage') }}" class="btn btn-primary">戻る</a>
            </form>
        </div>
    </div>
</div>
@endsection
