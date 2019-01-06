@extends('layouts.app') 
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="border rounded shadow col-10 p-5 bg-white">
            <form method="POST" action="/posts/{{ $post->id }}">
                @csrf
                @method('PATCH')
                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" class="form-control {{ ($errors->has('title')) ? 'is-invalid' : ($errors->any() ? 'is-valid' : '') }}" name="title" id="title" value="{{ ($errors->has('title') ? old('title') : $post->title) }}" aria-describedby="helpId" placeholder="Post Ttile">
                    <small id="helpId" class="form-text text-danger">{{ $errors->first('title') }}</small>
                </div>
                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea class="form-control {{ $errors->has('description') ? 'is-invalid' : ($errors->any() ? 'is-valid' : '') }}" name="description" id="description" aria-describedby="helpId" rows="5" placeholder="Post Description">{{ ($errors->has('description') ? old('description') : $post->description) }}</textarea>
                    <small id="helpId" class="form-text text-danger">{{ $errors->first('description') }}</small>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" name="password" id="password" value="{{ ($errors->has('password') ? old('password') : $post->password) }}" aria-describedby="helpId">
                    <small id="helpId" class="form-text text-muted">if empty password field then remove password</small>
                </div>
                <div class="form-group">
                    <div class="">
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection