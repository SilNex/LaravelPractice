@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Create Board</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('posts.store', $board->name) }}">
                        @csrf
                        <div class="form-group row">
                            <label for="title" class="col-md-4 col-form-label text-md-right">Title</label>
                            <div class="col-md-6">
                                <input type="text" id="title" title="title" placeholder="Title"
                                    class="form-control @error('title') is-invalid @enderror" value="{{ old('title') }}"
                                    required>
                                @error('title')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="content" class="col-md-4 col-form-label text-md-right">Content</label>
                            <div class="col-md-6">
                                <textarea type="text" id="content" name="content"
                                    class="form-control @error('content') is-invalid @enderror" rows="3"
                                    required>{{ old('content') }}</textarea>
                                @error('content')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="text-right">
                            <button type="submit" class="btn btn-primary">create</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
