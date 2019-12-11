@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Post</div>
                <div class="card-body">
                    <h5 class="card-title">{{ $post->title }}</h5>
                    <p class="card-text">{{ $post->content }}</p>

                    <div class="text-right mt-2">
                        <button class="btn btn-danger" type="button" data-toggle="modal" data-target="#deleteModal"
                            role="button">Delete</button>
                        <a href="{{ route('posts.index', $board->name) }}" class="btn btn-secondary">List</a>
                        <a href="{{ route('posts.edit', [$board->name, $post->id]) }}" class="btn btn-primary">Edit</a>
                    </div>
                </div>
                <div>
                    <label for="Comment" class="m-2">Comment</label>
                    <form action="{{ route('comments.store', $post->id) }}" method="post" class="d-flex">
                        <textarea name="content" id="Comment"  rows="5"
                            class="form-control border ml-2 @error('content') is-invalid @enderror" placeholder="Comment">
                            {{ old('content') }}
                        </textarea>
                        <button type="button" class="btn btn-secondary mr-2">comment</button>
                        @error('content')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </form>
                    @foreach ($comments as $coment)
                    <div class="border m-2 p-2">
                        {{ $coment->content }}
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
