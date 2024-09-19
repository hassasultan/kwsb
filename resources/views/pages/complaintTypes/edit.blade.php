@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card my-4">
                {{-- <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                    <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                        <div class="row">
                            <div class="col-6">
                                <h6 class="text-white text-capitalize ps-3">Edit Complaint Type</h6>
                            </div>
                        </div>
                    </div>
                </div> --}}
                <div class="card-body px-4 pb-2">
                    <h5>Update Complaint Type Informarion...</h5>
                    <hr />
                    <form role="form" method="POST" action="{{ route('compaints-type-management.update', $type->id) }}"
                        enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="row">

                            <div class="form-group col-12">
                                <label>Title</label>
                                <input type="text" class="form-control border-bottom"
                                    placeholder="Enter Customer Title..." name="title"
                                    value="{{ old('title', $type->title) }}" required />

                            </div>

                            <div class="form-group col-12">
                                <label>Description</label>
                                <textarea type="text" class="form-control border-bottom" placeholder="Enter Customer Description..."
                                    name="description">{{ old('description', $type->description) }}</textarea>

                            </div>


                            <div class="form-group col-12 p-3 text-right">
                                <button type="submit" class="btn btn-primary">Update</button>
                                @if (auth()->user()->role == 1)
                                    <a href="{{ url('/admin/compaints-type-management') }}"
                                        class="btn btn-secondary">Cancel</a>
                                @else
                                    <a href="{{ url('/system/compaints-type-management') }}"
                                        class="btn btn-secondary">Cancel</a>
                                @endif
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
