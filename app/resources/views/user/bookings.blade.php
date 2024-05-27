@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">My Bookings</div>

                <div class="card-body">
                    @if ($userBookings->isEmpty())
                        <p>まだ予約はありません</p>
                    @else
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">予約先</th>
                                        <th scope="col">チェックイン</th>
                                        <th scope="col">チェックアウト</th>
                                        <th scope="col">人数</th>
                                        <th scope="col">連絡先</th>
                                        <th scope="col">メールアドレス</th>
                                        <th scope="col">操作</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($userBookings as $booking)
                                        <tr>
                                            <th scope="row">{{ $booking->id }}</th>
                                            <td>{{ $booking->name }}</td>
                                            <td>{{ $booking->checkindate }}</td>
                                            <td>{{ $booking->checkoutdate }}</td>
                                            <td>{{ $booking->num_of_guests }}</td>
                                            <td>{{ $booking->tel }}</td>
                                            <td>{{ $booking->email }}</td>
                                            <td>
                                                <a href="{{ route('bookings.edit', ['id' => $booking->id]) }}" class="btn btn-warning btn-sm">編集</a>
                                                <form action="{{ route('bookings.destroy', ['id' => $booking->id]) }}" method="POST" style="display:inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('本当にこの予約をキャンセルしますか？')">予約取消</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                    <a href="{{ route('user.mypage') }}" class="btn btn-primary mt-3">マイページに戻る</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
