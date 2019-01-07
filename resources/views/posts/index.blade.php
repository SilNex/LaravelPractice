@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="border rounded shadow col-10 p-5 bg-white">
            <h1 class="display-5">
                Posts
            </h1>
            <br> 
            @forelse ($posts as $post)
            <div class="border rounded shadow-sm p-3 mb-3 bg-light">
                <div class="row pl-3 pr-1 justify-content-between">
                    <a href="{{ route('posts.show', ['post' => $post->id]) }}" class="text-dark">
                        <h4 class="border-bottom pl-0 text-truncate">{{ $post->title }}</h4>
                    </a>
                    <button type="button" class="btn btn-link" data-toggle="tooltip" data-placement="right" title="{{ $post->user->email }}">
                        {{ $post->user->name }}
                    </button>
                </div>
                <div class="row pl-3 pr-1 justify-content-between">
                    <div class="text-truncate col-10 lead text-secondary">
                        {{ ($post->password ? 'Locked post' : $post->description) }}
                    </div>
                    @if ($post->user->id === auth()->id())
                        <form action="{{ route('posts.index') . '/' . $post->id }}" class="form-inline" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    @endif
                </div>
            </div>
            @empty
            <div class="text-center">
                <h5 class="text-secondary">I want to go home...</h5>
            </div>
            @endforelse
            <a class="btn btn-primary" href="{{ route('posts.create') }}" role="button">Create Post</a>
        </div>
    </div>
</div>
@endsection