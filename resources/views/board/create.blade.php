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
                                <input type="text" id="name" name="name" placeholder="Board Name" class="form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="display_name" class="col-md-4 col-form-label text-md-right">Display Name
                                (option)</label>
                            <div class="col-md-6">
                                <input type="text" id="display_name" name="display_name" placeholder="Display Name"
                                    class="form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="explain" class="col-md-4 col-form-label text-md-right">Explain (option)</label>
                            <div class="col-md-6">
                                <textarea type="text" id="explain" name="explain" placeholder="Board Explain"
                                    class="form-control" rows="3"></textarea>
                            </div>
                        </div>
                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4"><button type="submit" class="btn btn-primary">
                                    create
                                </button>
                            </div>
                    </form>
                    @error('name')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
