// search_results.blade.php

@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-9">
            <div class="card">
                <div class="card-header">Search Results</div>
                <div class="card-body">
                    @if ($results->isEmpty())
                        <p>No results found.</p>
                    @else
                        <div class="list-group">
                            @foreach ($results as $result)
                                <a href="{{ route('posts.detail', $result) }}" class="list-group-item list-group-item-action">
                                    <div class="d-flex w-100 justify-content-between">
                                        <h5 class="mb-1">{{ $result->title }}</h5>
                                        <small>{{ $result->created_at->format('Y-m-d') }}</small>
                                    </div>
                                    <p class="mb-1">{{ $result->content }}</p>
                                </a>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
