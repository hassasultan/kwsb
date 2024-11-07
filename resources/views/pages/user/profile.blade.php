@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12">
                <h2 class="page-title">User Profile</h2>
                <div class="row">
                    <div class="col-md-12 my-4">
                        <div class="card shadow">
                            <div class="card-body">
                                <div class="card-title">
                                    <h5>
                                        {{ $user->name }} Profile Update
                                    </h5>
                                </div>
                                <div class="form-row">
                                    <form role="form" method="POST"
                                        action="{{ route('user.update.password') }}">
                                        @method('PUT')
                                        @csrf
                                        <input type="hidden" name="change_password" value="1" />
                                        <div class="row">
                                            <div class="form-group col-12 p-3">
                                                <label>Password*</label>
                                                <input type="password"
                                                    class="form-control border-bottom border-1 border-dark"
                                                    placeholder="Enter Old Password Here..." name="old_password" required
                                                    value="{{ old('old_password') }}" />
                                            </div>
                                            <div class="form-group col-6 p-3">
                                                <label>New Password*</label>
                                                <input type="password"
                                                    class="form-control border-bottom border-1 border-dark"
                                                    placeholder="Enter Old Password Here..." name="password" required
                                                    value="{{ old('password') }}" />
                                            </div>
                                            <div class="form-group col-6 p-3">
                                                <label>Confirmed Password*</label>
                                                <input type="password"
                                                    class="form-control border-bottom border-1 border-dark"
                                                    placeholder="Enter Old Password Here..." name="password_confirmation"
                                                    required value="{{ old('password_confirmation') }}" />
                                            </div>
                                            <div class="form-group col-12 p-3">

                                                <div class="form-group col-12 p-3 text-right">
                                                    <button type="submit" class="btn btn-primary">Update</button>
                                                    @if (auth()->user()->role == 1)
                                                        <a href="{{ url('/admin/user-management') }}"
                                                            class="btn btn-secondary">Cancel</a>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
