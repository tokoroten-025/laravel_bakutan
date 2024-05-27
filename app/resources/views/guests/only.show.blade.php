@extends('layouts.app')

@section('content')

    @if (Auth::check())
        {{-- ログインしている場合の表示 --}}
        <p>ログインしています。詳細な情報や機能を表示します。</p>
    @else
        {{-- ログインしていない場合の表示 --}}
        <p>ログインしていません。一般的な情報のみ表示します。</p>
    @endif

@endsection
