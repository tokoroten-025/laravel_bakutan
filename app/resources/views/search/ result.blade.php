@foreach ($results as $result)
    <div>
        <h2>{{ $result->title }}</h2>
        <p>{{ $result->content }}</p>
        <p>住所: {{ $result->address }}</p>
        <p>チェックイン日: {{ $result->checkindate }}</p>
        <p>金額: {{ $result->price }}</p>
    </div>
@endforeach
