@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12 my-4">
                <div class="card shadow">
                    <div class="card-body">
                        <h1>Add Department</h1>
                        <form action="{{ route('departments.store') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="search" >Type</label>
                                <select class="form-control select2" name="comp_type_id" required>
                                    <option disabled selected> -- Select Type --</option>
                                    @foreach ($ct as $row)
                                        <option value="{{ $row->id }}"> {{ $row->title }} </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" name="name" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea name="description" class="form-control"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="status">Status</label>
                                <select name="status" class="form-control">
                                    <option value="1">Active</option>
                                    <option value="0">Inactive</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-success">Save</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
