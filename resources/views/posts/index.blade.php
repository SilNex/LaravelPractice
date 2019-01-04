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
                    <a href="#" class="text-dark">
                        <h4 class="border-bottom pl-0 text-truncate">{{ $post->title }}</h4>
                    </a>
                    <button type="button" class="btn btn-link" data-toggle="tooltip" data-placement="right" title="Author Full Name">
                        Author
                    </button>
                </div>
                <div class="text-truncate col-10 lead text-secondary">
                    {{ $post->description }}
                </div>
            </div>
            @empty
            <div class="text-center">
                <h5 class="text-secondary">I want to go home...</h5>
            </div>
            @endforelse
        </div>
    </div>
</div>
@endsection