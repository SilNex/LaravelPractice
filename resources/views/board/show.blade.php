@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Board Info</div>
                <div class="card-body">
                    <h5 class="card-title">{{ $display_name . " - {$name}" ?? $name }}</h5>
                    <p class="card-text">{{ $explain }}</p>

                    <div class="text-right mt-2">
                        <button class="btn btn-danger" type="button" data-toggle="modal" data-target="#deleteModal" role="button">Delete</button>
                        <a href="{{ route('boards.index') }}" class="btn btn-secondary">List</a>
                        <a href="{{ route('boards.edit', $name) }}" class="btn btn-primary">Edit</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
