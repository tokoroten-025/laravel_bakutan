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
                            <!-- 予約情報の表示 -->
                            <p><strong>予約開始日: </strong>{{ $post->availability_days }}</p>
                            <p><strong>予約終了日: </strong>{{ $post->availability_days }}</p>
                            <p><strong>金額: </strong>{{ $post->amount }}</p>
                            <p><strong>内容: </strong>{{ $post->content }}</p>
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
                </div>
                <div class="card-footer">
                    <form action="{{ route('bookings.store') }}" method="POST">
                        @csrf
                        <!-- 投稿IDを持たせる -->
                        <input type="hidden" name="post_id" value="{{ $post->id }}">
                        <input type="hidden" name="user_id" value="{{ auth()->id() }}">
                        
                        <!-- 予約情報のフォーム -->
                        @foreach(['name' => '名前', 'checkindate' => '予約開始日', 'checkoutdate' => '予約終了日', 'guests' => '人数', 'tel' => '電話番号'] as $field => $label)
                        <div class="form-group">
                            <label for="{{ $field }}">{{ $label }}</label>
                            <input type="{{ $field === 'tel' }}" class="form-control" id="{{ $field }}" name="{{ $field }}" value="{{ $post->{$field} }}" readonly>
                        </div>
                        @endforeach

                        <!-- 確認ボタン -->
                        <button type="submit" class="btn btn-primary">予約する</button>

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
