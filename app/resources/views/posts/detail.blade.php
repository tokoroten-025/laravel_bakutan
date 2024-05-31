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
                    <div class="d-flex justify-content-center">
                    @if(Auth::user())
                        <div>
                            @if($like_model->like_exist(Auth::user()->id,$post->id))
                                <p class="favorite-marke">
                                <a class="js-like-toggle loved" href="" data-postid="{{ $post->id }}"><i class="fas fa-heart fa-2x"></i></a>
                                <span class="likesCount">{{$post_like->likes_count}}</span>
                                </p>
                            @else
                                <p class="favorite-marke">
                                <a class="js-like-toggle" href="" data-postid="{{ $post->id }}"><i class="fas fa-heart fa-2x"></i></a>
                                <span class="likesCount">{{$post_like->likes_count}}</span>
                                </p>
                            @endif
                        </div>
                    @else
                        <div>
                            <a href="{{ route('login') }}">ログイン</a>後お気に入り登録可能です
                        </div>
                    @endif
                    </div>
                    <div class="card-footer">
                   
                    <a href="{{ route('bookings.create', ['post' => $post->id]) }}" class="btn btn-primary">予約</a>
                    <a href="{{ route('home') }}" class="btn btn-secondary">TOPに戻る</a>
                    <!-- 違反報告ボタン -->
                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#reportModal">
                        違反を報告する
                    </button>

                    <!-- 違反報告用モーダル -->
                    <div class="modal fade" id="reportModal" tabindex="-1" role="dialog" aria-labelledby="reportModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="reportModalLabel">違反報告フォーム</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <!-- 違反報告フォーム -->
                                <form action="{{ route('repost.post', ['postId' => $post->id]) }}" method="POST">
                                    @csrf
                                    <div class="form-group">
                                        <!-- <label for="reason">違反理由</label>
                                        <select class="form-control" id="reason" name="reason" required>
                                            <option value="1">スパム</option>
                                            <option value="2">不適切なコンテンツ</option>
                                            <option value="3">その他</option>
                                        </select> -->
                                    </div>
                                    <div class="form-group">
                                        <label for="reason">違反理由</label>
                                        <textarea class="form-control" id="reason" name="reason" rows="3" required></textarea>
                                    </div>
                                    <button type="submit" class="btn btn-primary">送信</button>
                                </form>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
