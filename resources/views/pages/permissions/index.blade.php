@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-12">
            <h2 class="page-title">Permissions Management</h2>
            <div class="col-12 text-right">
                <a class="btn btn-primary" href="{{ route('permissions.create') }}">Add Permission <i class="fa fa-plus"></i></a>
            </div>
            <div class="row">
                <div class="col-md-12 my-4">
                    <div class="card shadow">
                        <div class="card-body">
                            <div class="card-title">
                                <h5>Permissions List</h5>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-hover table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($permissions as $permission)
                                            <tr>
                                                <td>{{ $permission->name }}</td>
                                                <td>
                                                    <a href="{{ route('permissions.edit', $permission->id) }}" class="btn btn-warning">Edit</a>
                                                    <form action="{{ route('permissions.destroy', $permission->id) }}" method="POST" style="display:inline;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger">Delete</button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            {{-- {{ $permissions->links() }} <!-- Pagination --> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
