@extends('layouts.app')

@section('content')
<div class="container">
    <!-- ユーザー情報セクション -->
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">★旅館ユーザー★</div>
                <div class="card-body">
                    <div>
                        <p>ユーザー名: {{ Auth::user()->name }}</p>
                        <p>メールアドレス: {{ Auth::user()->email }}</p>
                        @if (Auth::user()->icon)
                            <p>ユーザーアイコン: <img src="{{ Storage::url(Auth::user()->icon) }}" alt="User icon" class="img-thumbnail"></p>
                        @endif
                    </div>
                    <a href="{{ route('ryokan.edit', Auth::user()->id) }}" class="btn btn-primary">編集</a>
                    <a href="{{ route('posts.create') }}" class="btn btn-success">新しい投稿をする</a>
                </div>
            </div>
        </div>
    </div>

    <!-- 投稿セクション -->
    <div class="row mt-4 justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">マイリスト</div>
                <div class="card-body">
                    <div class="row">
                    @foreach($posts as $post)
                        @if($post && isset($post->title))
                            <div class="col-md-6 mb-3">
                                <div class="card h-100">
                                    <a href="{{ route('posts.detail', $post->id) }}" class="card-header">{{ $post->title }}</a>
                                    @if ($post->image)
                                        <img src="{{ asset('img/' . $post->id . '/' . $post->image) }}" alt="{{ $post->title }}" class="img-fluid">
                                    @endif
                                    <div class="card-body">
                                        <p class="card-text">{{ $post->description }}</p>
                                        <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-primary">編集</a>
                                        <form action="{{ route('posts.softDestroyPost', $post->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">削除</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach

                    </div>
                    @if($posts->isEmpty())
                        <div class="alert alert-info mt-3">まだ投稿がありません。</div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- 予約セクション -->
    <div class="row mt-4 justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">予約一覧</div>
                <div class="card-body">
                    @if ($reservations->isEmpty())
                        <div class="alert alert-info mt-3">まだ予約がありません。</div>
                    @else
                        <table class="table-responsive">
                            <thead>
                                <tr>
                                    <th>投稿タイトル</th>
                                    <th>予約者名</th>
                                    <th>チェックイン日</th>
                                    <th>チェックアウト日</th>
                                    <th>違反報告</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach ($reservations as $reservation)
                                <tr>
                                    <td><a href="{{ route('posts.detail', $reservation->post_id) }}">{{ $reservation->post->title }}</a></td>
                                    <td>{{ $reservation->user->name }}</td>
                                    <td>{{ $reservation->checkin_date }}</td>
                                    <td>{{ $reservation->checkout_date }}</td>
                                    <td>
                                        <button type="button" class="btn btn-warning report-btn" data-toggle="modal" data-target="#reportModal" data-reported-user-id="{{ $reservation->user->id }}">違反報告</button>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- 違反報告セクション -->
    <div class="row mt-4 justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">違反報告一覧</div>
                <div class="card-body">
                    @if ($reposts->isEmpty())
                        <div class="alert alert-info mt-3">まだ違反報告がありません。</div>
                    @else
                        <table class="table-responsive">
                            <thead>
                                <tr>
                                    <th>投稿タイトル</th>
                                    <th>違反理由</th>
                                    <th>報告者</th>
                                    <th>処理</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach ($reposts as $repost)
                                <tr>
                                    <td>{{ $repost['post']['title'] }}</td>
                                    <td>{{ $repost->reason }}</td>
                                    <td>{{ $repost->user->name }}</td>
                                    <td>
                                        @if (!$repost->reason)
                                            <form action="{{ route('reposts.resolve', $repost->id) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <button type="submit" class="btn btn-success">報告</button>
                                            </form>
                                        @else
                                            <span class="badge badge-success">報告</span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<!-- 違反報告モーダル -->
<div class="modal fade" id="reportModal" tabindex="-1" role="dialog" aria-labelledby="reportModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="{{ route('repost.post', ['postId' => $post->id]) }}" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="reportModalLabel">違反報告</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="reported_user_id" id="reported_user_id">
                    <div class="form-group">
                        <label for="reason">違反の理由</label>
                        <textarea class="form-control" id="reason" name="reason" rows="3" required></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">閉じる</button>
                    <button type="submit" class="btn btn-primary">報告する</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- スクリプト -->
<script>
    $('#reportModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var reportedUserId = button.data('reported-user-id');
        var modal = $(this);
        modal.find('#reported_user_id').val(reportedUserId);
    });
</script>
@endsection
