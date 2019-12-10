@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Board Info</div>
                <div class="card-body">
                    <h5 class="card-title">{{ $post->title }}</h5>
                    <p class="card-text">{{ $post->content }}</p>

                    <div class="text-right mt-2">
                        <button class="btn btn-danger" type="button" data-toggle="modal" data-target="#deleteModal" role="button">Delete</button>
                        <a href="{{ route('posts.index', $board->name) }}" class="btn btn-secondary">List</a>
                        <a href="{{ route('posts.edit', [$board->name, $post->id]) }}" class="btn btn-primary">Edit</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
