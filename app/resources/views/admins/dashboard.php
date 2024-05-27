<!-- resources/views/bookings/index.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">マイ予約一覧</div>
                    
                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">予約開始日</th>
                                    <th scope="col">予約終了日</th>
                                    <th scope="col">金額</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($bookings as $booking)
                                <tr>
                                    <th scope="row">{{ $booking->id }}</th>
                                    <td>{{ $booking->checkindate }}</td>
                                    <td>{{ $booking->checkoutdate }}</td>
                                    <td>{{ $booking->amount }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
