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
                                <input type="text" id="name" name="name" placeholder="Board Name"
                                    class="form-control @error('name') is-invalid @enderror"
                                    value="{{ old('name') ?: $name }}">
                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
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
                            <button class="btn btn-primary" type="submit" role="button">Edit</button>
                            <button class="btn btn-danger" type="button" data-toggle="modal" data-target="#deleteModal" role="button">Delete</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Confirm</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    ...
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.getElementById("delete_btn").onclick(() => {
            if (confirm("Delete this board?")) {
                console.log("delete code here...")
            }
        })
    </script>
</div>
@endsection
