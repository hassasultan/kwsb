@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <a href="{{ url()->previous() }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Back
            </a>
            <h2 class="page-title mb-0">Edit Town</h2>
        </div>
        <div class="card my-4">
            {{-- <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
          <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
            <div class="row">
                <div class="col-6">
                    <h6 class="text-white text-capitalize ps-3">Update User</h6>
                </div>
            </div>
          </div>
        </div> --}}
            <div class="card-body px-4 pb-2">
                <h5>Give User Informarion...</h5>
                <form role="form" method="POST" action="{{ route('user-management.update', $user->id) }}"
                    enctype="multipart/form-data">
                    @method('PUT')
                    @csrf
                    <div class="row">
                        <div class="form-group col-12 p-3">
                            <label>Name</label>
                            <input type="text" class="form-control border-bottom border-1 border-dark"
                                placeholder="Enter User Name..." name="name" value="{{ old('name', $user->name) }}"
                                required />
                        </div>
                        <div class="form-group col-12 p-3">
                            <label>Email</label>
                            <input type="email" class="form-control border-bottom border-1 border-dark"
                                placeholder="Enter Email..." name="email" value="{{ old('email', $user->email) }}"
                                required />
                        </div>
                        <div class="form-group col-12 p-3">
                            <label>User Type</label>
                            <select name="role" id="role-id" class="select2-multiple form-control fs-14  h-50px" required>
                                <option value="1" @if($user->role == 1) selected @endif>Admin</option>
                                <option value="2" @if($user->role == 2) selected @endif>System User</option>
                                <option value="3" @if($user->role == 3) selected @endif>Mobile Agent</option>
                                <option value="4" @if($user->role == 4) selected @endif>Department</option>
                            </select>
                        </div>
                        <div class="form-group col-12 p-3 @if($user->department_id == 0) d-none @endif" id="department-div">
                            <label>Department</label>
                            <select name="department_id" id="department-id"
                                class="select2-multiple form-control fs-14  h-50px">
                                @foreach ($department as $row)
                                <option value="{{ $row->id }}" @if($user->department_id == $row->id) selected @endif>{{ $row->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-12 p-3">
                            <label>Password</label>
                            <input type="password" class="form-control border-bottom border-1 border-dark"
                                placeholder="Enter Password..." name="password" value="{{ old('password') }}" />
                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="form-group col-12 p-3">
                            <label>Confirmed Password</label>
                            <input type="password" class="form-control border-bottom border-1 border-dark"
                                placeholder="Enter Password Confirmation..." name="password_confirmation"
                                autocomplete="new-password" value="{{ old('password_confirmation') }}" />
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
@endsection
@section('bottom_script')
<script>
    $(document).ready(function() {
        $("#role-id").on("change", function() {
            const selectedRole = $(this).val();
            if (selectedRole === '4') {
                $("#department-div").removeClass("d-none");
                $("#department-id").attr('required', 'required');
            } else {
                $("#department-div").addClass("d-none");
                $("#department-id").attr('required', false);

            }
        });
    });
</script>
@endsection