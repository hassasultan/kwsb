@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12">
                {{-- @include('layouts.include.toolbar') --}}
                <h2 class="page-title">District Management</h2>

                <div class="row">
                    <div class="col-md-12">
                        <div class="card-header">
                            <strong class="card-title">Districts</strong>
                            <h5>Add Districts</h5>
                        </div>
                    </div>
                    {{-- <div class="row mt-3"> --}}
                        <div class="col-md-12 mt-3">
                            <div class="card shadow mb-4">
                                <div class="card-body px-4 pb-2">
                                    <h5>Give District Informarion...</h5>
                                    <form method="POST" action="{{ route('districts.store') }}">
                                        @csrf
                                        <div class="row">
                                            <div class="form-group col-12 p-3">
                                                <label for="name">Title:</label>
                                                <input type="text" class="form-control border-bottom border-1 border-dark"
                                                    id="name" name="title" value="{{ old('title') }}" required>
                                                @error('title')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            {{-- <div class="form-group col-12 p-3">
                                                <label>Sub Town*</label>
                                                <input type="text" class="form-control border-bottom border-1 border-dark"
                                                placeholder="Enter Sub Town Here..." name="subtown" required  value="{{ old('subtown') }}"/>
                                            </div> --}}
                                            <div class="text-right">
                                                <button type="submit" class="btn btn-primary">Create</button>
                                                <a href="{{ route('districts.index') }}" class="btn btn-secondary">Cancel</a>
        
                                            </div>
                                        </div>
        
                                    </form>
                                </div>
                            </div>
                        </div>
                    {{-- </div> --}}
                </div>
            </div>
        </div>
    </div>
@endsection
