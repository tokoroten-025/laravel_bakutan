@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">予約を編集する</div>

                <div class="card-body">
                    <form action="{{ route('bookings.update', ['id' => $booking->id]) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <label for="name">おなまえ</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ $booking->name }}" required>
                        </div>

                        <div class="form-group">
                            <label for="checkindate">チェックイン</label>
                            <input type="date" class="form-control" id="checkindate" name="checkindate" value="{{ $booking->checkindate }}" required>
                        </div>

                        <div class="form-group">
                            <label for="checkoutdate">チェックアウト</label>
                            <input type="date" class="form-control" id="checkoutdate" name="checkoutdate" value="{{ $booking->checkoutdate }}" required>
                        </div>

                        <div class="form-group">
                            <label for="guests">人数</label>
                            <input type="number" class="form-control" id="guests" name="guests" value="{{ $booking->num_of_guests }}" required>
                        </div>

                        <div class="form-group">
                            <label for="tel">連絡先</label>
                            <input type="tel" class="form-control" id="tel" name="tel" value="{{ $booking->tel }}" required>
                        </div>

                        <button type="submit" class="btn btn-primary">予約を変更</button>
                        <a href="{{ route('my.bookings') }}" class="btn btn-secondary">予約一覧に戻る</a>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
