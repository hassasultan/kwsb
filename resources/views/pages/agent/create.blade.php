@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card my-4">
                <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                    <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                        <div class="row">
                            <div class="col-6">
                                <h6 class="text-white text-capitalize ps-3">Add Mobile Agent</h6>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body px-4 pb-2">
                    <h5>Give Agent Informarion...</h5>
                    <form role="form" method="POST" action="{{ route('agent-management.store') }}"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="form-group col-12 p-3">
                                <label>Select User*</label>
                                <select name="user_id" class="select2-multiple form-control fs-14  h-50px" required>
                                    @foreach ($user as $row)
                                        <option value="{{ $row->id }}">{{ $row->name }} ({{ $row->email }})</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-12 p-3">
                                <label>Select Town*</label>
                                <select name="town_id" class="select2-multiple form-control fs-14  h-50px" required>
                                    @foreach ($town as $row)
                                        <option value="{{ $row->id }}">{{ $row->town }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-12 p-3">
                                <label>Select SubTown*</label>
                                <select name="sub_town_id" class="select2-multiple form-control fs-14  h-50px" required>
                                    @foreach ($subtown as $row)
                                        <option value="{{ $row->id }}">({{ $row->town->town }})  {{ $row->title }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-12 p-3">
                                <label>Select Type*</label>
                                <select name="type_id" class="select2-multiple form-control fs-14  h-50px" required>
                                    @foreach ($type as $row)
                                        <option value="{{ $row->id }}">({{ $row->title }})</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-12 p-3">
                                <label>Agent Profile</label>
                                <input type="file" class="form-control border-bottom border-1 border-dark"
                                     name="avatar" value="{{ old('avatar') }}" required />
                            </div>
                            <div class="form-group col-12 p-3">
                                <label>Description</label>
                                <textarea class="form-control border-bottom border-1 border-dark"
                                    placeholder="Enter Desciption..." name="description" value="{{ old('description') }}" required ></textarea>

                            </div>
                            <div class="form-group col-12 p-3">
                                <label>Address*</label>
                                <input type="text" class="form-control border-bottom border-1 border-dark"
                                placeholder="Enter Address Here..." name="address" required  value="{{ old('address') }}"/>
                            </div>


                            <div class="text-center">
                                <button type="submit"
                                    class="btn btn-lg bg-gradient-primary btn-lg w-20 mt-4 mb-0">Create</button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
