@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12">
                <h1>Assign Role</h1>
                <div class="card shadow">
                    <div class="card-body">
                        <div class="lead">
                            Manage your roles here.
                            <a href="{{ route('roles.create') }}" class="btn bg-primary text-white btn-sm">Add role</a>
                        </div>

                        <div class="mt-2">
                            @include('layouts.partials.messages')
                        </div>

                        <div class="col-md-12">
                            <form action="{{ route('assign.role.users', $role->id) }}" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="form-group col-12">
                                        <label>Users</label>
                                        <select name="user_id[]" class="select2-multi form-control fs-14  h-50px" required
                                            multiple>
                                            {{-- <option selected disabled>-- Select Option --</option> --}}
                                            @foreach ($user as $col)
                                                <option value="{{ $col->id }}">{{ $col->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="text-right">
                                        <button type="submit"
                                            class="btn text-white bg-primary ">Assigned</button>
                                    </div>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
