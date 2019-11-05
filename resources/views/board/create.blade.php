@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Create Board</div>
                <div class="card-body">
                    <form method="POST" action="/board">
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">Board Name</label>
                            <div class="col-md-6">
                                <input type="text" id="name" name="name" placeholder="Board Name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}">
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="display_name" class="col-md-4 col-form-label text-md-right">Display Name (option)</label>
                            <div class="col-md-6">
                                <input type="text" id="display_name" name="display_name" placeholder="Display Name" class="form-control @error('display_name') is-invalid @enderror" value="{{ old('display_name') }}">
                                @error('display_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="explain" class="col-md-4 col-form-label text-md-right">Explain (option)</label>
                            <div class="col-md-6">
                                <textarea type="text" id="explain" name="explain" placeholder="Board Explain" class="form-control @error('explain') is-invalid @enderror" rows="3">{{ old('explain') }}</textarea>
                                @error('explain')
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
