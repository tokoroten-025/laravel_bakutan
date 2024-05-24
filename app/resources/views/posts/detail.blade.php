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
                                <img src="{{ asset('img/' . $post->id . '/' . $post->image) }}" class="img-fluid" alt="{{ $post->title }}">
                                @else
                                    <p>画像はありません</p>
                                @endif
                            </div>
                        </div>
                        <hr>
                        <p><strong>内容: </strong>{{ $post->content }}</p>
                    </div>
                    <div class="card-footer">
                   
                    <a href="{{ route('bookings.create', ['post' => $post->id]) }}">予約作成</a>
                    <a href="{{ route('home') }}" class="btn btn-secondary">TOPに戻る</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
