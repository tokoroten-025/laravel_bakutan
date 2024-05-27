@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ $post->title }}</div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <p><strong>予約開始日: </strong>{{ $post->checkindate }}</p>
                            <p><strong>予約終了日: </strong>{{ $post->checkoutdate }}</p>
                            <p><strong>金額: </strong>{{ $post->amount }}</p>
                        </div>
                        <div class="col-md-6">
                            @if ($post->image)
                            <img src="{{ asset($post->image) }}" class="img-fluid" alt="投稿画像">
                            @else
                            <p>画像はありません</p>
                            @endif
                        </div>
                    </div>
                    <hr>
                    <p><strong>内容: </strong>{{ $post->content }}</p>
                </div>
                <div class="card-footer">
                    <form action="{{ route('bookings.store') }}" method="POST">
                        @csrf
                        <!-- 投稿IDを持たせる -->
                        <input type="hidden" name="post_id" value="{{ $post->id }}">
                        <input type="hidden" name="user_id" value="{{ auth()->id() }}">

                        <div class="form-group">
                            <label for="name">名前</label>
                            <input type="text" class="form-control" id="name" name="name" required>
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
                            <label for="guests">人数</label>
                            <input type="number" class="form-control" id="guests" name="guests" required>
                        </div>

                        <div class="form-group">
                            <label for="tel">電話番号</label>
                            <input type="tel" class="form-control" id="tel" name="tel" required>
                        </div>
                        
                        <button type="submit" class="btn btn-primary">確認する</button>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <a href="/" class="btn btn-primary">TOPへ戻る</a>
        </div>
    </div>
</div>
@endsection
