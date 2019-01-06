@extends('layouts.app') 
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="border rounded shadow col-10 p-5 bg-white">
            <form method="POST" action="/posts">
                @csrf
                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" class="form-control {{ ($errors->has('title')) ? 'is-invalid' : ($errors->any() ? 'is-valid' : '') }}" name="title" id="title" value="{{ old('title') }}" aria-describedby="helpId" placeholder="Post Ttile">
                    <small id="helpId" class="form-text text-danger">{{ $errors->first('title') }}</small>
                </div>
                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea class="form-control {{ $errors->has('description') ? 'is-invalid' : ($errors->any() ? 'is-valid' : '') }}" name="description" id="description" aria-describedby="helpId" rows="5" placeholder="Post Description">{{ old('description') }}</textarea>
                    <small id="helpId" class="form-text text-danger">{{ $errors->first('description') }}</small>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" name="password" id="password" value="{{ old('password') }}" aria-describedby="helpId">
                    <small id="helpId" class="form-text text-muted"> Password is option </small>
                </div>
                <div class="form-group">
                    <div class="">
                        <button type="submit" class="btn btn-primary">Create</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection