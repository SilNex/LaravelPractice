@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Create Post</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('posts.update', [$board->name, $post->id]) }}">
                        @csrf
                        @method('PUT')
                        <div class="form-group row">
                            <label for="title" class="col-md-3 col-form-label text-md-right">Title</label>
                            <div class="col-md-8">
                                <input type="text" id="title" name="title" placeholder="Title"
                                    class="form-control @error('title') is-invalid @enderror" value="{{ old('title') ?? $post->title }}"
                                    required>
                                @error('title')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="content" class="col-md-3 col-form-label text-md-right">Content</label>
                            <div class="col-md-8">
                                <textarea type="text" id="content" name="content"
                                    class="form-control @error('content') is-invalid @enderror" rows="3"
                                    required>{{ old('content') ?? $post->title }}</textarea>
                                @error('content')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="text-right">
                            <button type="submit" class="btn btn-primary">update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
