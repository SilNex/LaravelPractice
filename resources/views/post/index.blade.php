@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">post list</div>
                <div class="card-body">
                    <div class="list-group list-group-flush">
                        @foreach ($posts as $post)
                        <a href="{{route('posts.show', [$board, $post->id])}}" class="list-group-item list-group-item-action">{{ $post->title }}</a>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="text-right mt-2">
                    <a class="btn btn-primary" href="{{route('posts.create', $board)}}" role="button">Create Post</a>
            </div>
        </div>
    </div>
</div>
@endsection
