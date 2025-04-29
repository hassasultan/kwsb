@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12 my-4">
                <div class="card shadow">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h1>Departments</h1>
                            <a href="{{ route('departments.create') }}" class="btn btn-primary">Add Department</a>
                        </div>
                        @if (session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @endif
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Description</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($departments as $department)
                                    <tr>
                                        <td>{{ $department->name }}</td>
                                        <td>{{ $department->description }}</td>
                                        <td>{{ $department->status ? 'Active' : 'Inactive' }}</td>
                                        <td>
                                            <a href="{{ route('departments.edit', $department->id) }}"
                                                class="btn btn-sm btn-warning">Edit</a>
                                            {{-- <a href="{{ route('departments.details', $department->id) }}"
                                                class="text-secondary font-weight-bold text-xs m-3" data-toggle="tooltip"
                                                data-original-title="Show Complaints">
                                                Assigned Complaints
                                            </a> --}}
                                            <form action="{{ route('departments.destroy', $department->id) }}"
                                                method="POST" style="display:inline-block;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $departments->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
