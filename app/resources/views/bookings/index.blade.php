@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">予約一覧</div>

                <div class="card-body">
                    <ul>
                        @foreach ($bookings as $booking)
                        <li>{{ $booking->name }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
