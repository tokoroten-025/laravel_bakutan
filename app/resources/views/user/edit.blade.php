@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">ユーザー情報の編集</div>
                <div class="card-body">
                    <form action="{{ route('user.update', Auth::user()->id) }}" method="POST" enctype="multipart/form-data">

                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <label for="name">ユーザー名</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ Auth::user()->name }}" required>
                        </div>

                        <div class="form-group">
                            <label for="email">メールアドレス</label>
                            <input type="email" class="form-control" id="email" name="email" value="{{ Auth::user()->email }}" required>
                        </div>

                        <div class="form-group">
                            <label for="icon">ユーザーアイコン</label>
                            <input type="file" class="form-control-file" id="icon" name="icon">
                            @if (Auth::user()->icon)
                                <img src="{{ Storage::url(Auth::user()->icon) }}" alt="User Icon" class="img-thumbnail mt-2" style="max-width: 80px;">
                            @endif
                        </div>

                        <button type="submit" class="btn btn-primary">更新する</button>
                    </form>
                </div>
            </div>

            <div class="card mt-4">
                <div class="card-header">ユーザーの退会</div>
                <div class="card-body">
                    <form action="{{ route('user.destroy', ['id' => Auth::user()->id]) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">退会する</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
