@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Board Info</div>
                <div class="card-body">
                    <form method="POST" action="{{route('board.update', $id)}}">
                        @csrf
                        @method("PUT")
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">Board Name</label>
                            <div class="col-md-6">
                                <input type="text" id="name" name="name" class="form-control" value="{{ $name }}" disabled>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="display_name" class="col-md-4 col-form-label text-md-right">Display Name
                                (option)</label>
                            <div class="col-md-6">
                                <input type="text" id="display_name" name="display_name" placeholder="Display Name"
                                    class="form-control @error('display_name') is-invalid @enderror"
                                    value="{{ old('display_name') ?: $display_name }}">
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
                                <textarea type="text" id="explain" name="explain" placeholder="Board Explain"
                                    class="form-control @error('explain') is-invalid @enderror"
                                    rows="3">{{ old('explain') ?: $explain }}</textarea>
                                @error('explain')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="text-right mt-2">
                            <button class="btn btn-danger" type="button" data-toggle="modal" data-target="#deleteModal"
                                role="button">Delete</button>
                            <button class="btn btn-primary" type="submit" role="button">Submit</button>
                            <a href="{{ url()->previous() }}" class="btn btn-secondary" role="button">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
