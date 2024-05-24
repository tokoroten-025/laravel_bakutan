@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <form action="{{ route('posts.update', $post->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="title">タイトル</label>
                            <input type="text" class="form-control" id="title" name="title" value="{{ $post->title }}" required>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="availability_guests">予約人数</label>
                            <input type="text" class="form-control" id="availability_guests" name="availability_guests" value="{{ $post->availability_guests }}" required>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="checkindate">予約開始日</label>
                    <input type="date" class="form-control" id="availability_days" name="availability_days" value="{{ $post->availability_days }}" required>
                </div>
                
                <div class="form-group">
                    <label for="checkoutdate">予約終了日</label>
                    <input type="date" class="form-control" id="availability_days" name="availability_days" value="{{ $post->availability_days }}" required>
                </div>

                <div class="form-group">
                    <label for="content">内容</label>
                    <textarea class="form-control" id="content" name="content" rows="5" required>{{ $post->content }}</textarea>
                </div>

                <div class="form-group">
                    <label for="image">画像</label>
                    <input type="file" class="form-control-file" id="image" name="image">
                </div>

                <div class="form-group">
                    <label for="amount">金額</label>
                    <input type="number" class="form-control" id="amount" name="amount" value="{{ $post->amount }}" required>
                </div>

                <!-- 他のフォーム項目も同様にデフォルト値を設定 -->

                <button type="submit" class="btn btn-primary">更新する</button>
                <a href="{{ route('user.mypage') }}" class="btn btn-primary">戻る</a>
            </form>
            </div>
        </div>
    </div>
@endsection
