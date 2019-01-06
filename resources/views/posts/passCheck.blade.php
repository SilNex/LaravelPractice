@extends('layouts.app') 
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="border rounded shadow col-10 p-5 bg-white">
            <form action="{{ route('posts.passCheck', ['post' => $post->id]) }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="password">Password</label>
                    <small id="helpId" class="form-text text-danger">{{ $errors->first('inValidPasswrod') }}</small>
                    <input type="password" class="form-control" name="password" id="password" aria-describedby="helpId" placeholder="">
                    <small id="helpId" class="form-text text-muted">Post {{ $post->title }} Passowrd</small>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection