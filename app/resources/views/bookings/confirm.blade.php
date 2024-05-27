<!-- resources/views/bookings/confirm.blade.php -->

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
                    <p><strong>名前: </strong>{{ session('name') }}</p>
                    <p><strong>予約開始日: </strong>{{ session('checkindate') }}</p>
                    <p><strong>予約終了日: </strong>{{ session('checkoutdate') }}</p>
                    <p><strong>人数: </strong>{{ session('guests') }}</p>
                    <p><strong>電話番号: </strong>{{ session('tel') }}</p>
                </div>
                <div class="card-footer">
                    <form action="{{ route('bookings.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="post_id" value="{{ $post->id }}">

                        <button type="submit" class="btn btn-primary">予約を確定する</button>
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
