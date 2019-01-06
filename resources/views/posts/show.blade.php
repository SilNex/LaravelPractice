@extends('layouts.app') 
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="border rounded shadow col-10 p-5 bg-white card">
            <div class="card-body">
                <h4 class="card-title">{{ $post->title }}</h4>
                {{--
                <h6 class="card-subtitle text-muted">부제목</h6> --}}
            </div>
            <div class="card-body">
                <p class="card-text">{{ $post->description }}</p>
                <br>
                <div class="row justify-content-between">
                    <a href="{{ route('posts.show', ['post' => ($post->id - 1)]) }}" class="card-link">이전 글</a>
                    <a href="{{ route('posts.show', ['post' => ($post->id + 1)]) }}" class="card-link">다음 글</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection