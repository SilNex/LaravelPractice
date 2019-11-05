@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Board list</div>
                <div class="card-body">
                    <div class="list-group list-group-flush">
                        @foreach ($boards as $board)
                        <a href="{{route('board.show', $board->id)}}" class="list-group-item list-group-item-action">{{ $board->display_name ?: $board->name }}</a>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="text-right mt-2">
                    <a class="btn btn-primary" href="{{route('board.create')}}" role="button">Create Board</a>
            </div>
        </div>
    </div>
</div>
@endsection
