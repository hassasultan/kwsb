@extends('layouts.app')

@section('content')

<div class="row">
    <div class="col-12">
      <div class="card my-4">
        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
          <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
            <div class="row">
                <div class="col-6">
                    <h6 class="text-white text-capitalize ps-3">Update User</h6>
                </div>
            </div>
          </div>
        </div>
        <div class="card-body px-4 pb-2">
            <h5>Give User Informarion...</h5>
            <form role="form" method="POST" action="{{ route('compaints-management.update',$complaint->id) }}" enctype="multipart/form-data">
                @method('PUT')
                @csrf
                <div class="row">
                    <div class="form-group col-12 p-3">
                        <label>Select Town*</label>
                        <select name="town_id" class="select2-multiple form-control fs-14  h-50px" required>
                            @foreach ($town as $row)
                                <option value="{{ $row->id }}" @if($row->id == $complaint->town_id) selected @endif>{{ $row->town }} ({{ $row->subtown }})</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-12 p-3">
                        <label>Select SubTown*</label>
                        <select name="sub_town_id" class="select2-multiple form-control fs-14  h-50px" required>
                            @foreach ($subtown as $row)
                                <option value="{{ $row->id }}" @if($row->id == $complaint->sub_town_id) selected @endif>({{ $row->town->town }}) {{ $row->title }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-12 p-3">
                        <label>Select Type*</label>
                        <select name="type_id" class="select2-multiple form-control fs-14  h-50px" required>
                            @foreach ($type as $row)
                                <option value="{{ $row->id }}" @if($row->id == $complaint->type_id) selected @endif>{{ $row->title }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-12 p-3">
                        <label>Select Sub Type*</label>
                        <select name="subtype_id" id="subtype_id" class="select2-multiple form-control fs-14  h-50px" required>
                            @foreach ($subtype as $row)
                                <option value="{{ $row->id }}" @if($row->id == $complaint->subtype_id) selected @endif>{{ $row->title }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-12 p-3">
                        <label>Select Priority*</label>
                        <select name="prio_id" class="select2-multiple form-control fs-14  h-50px" required>
                            @foreach ($prio as $row)
                                <option value="{{ $row->id }}">{{ $row->title }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-12 p-3">
                        <label>Select Source*</label>
                        <select name="source" class="select2-multiple form-control fs-14  h-50px" required>
                            @foreach ($source as $row)
                                <option value="{{ $row->title }}">{{ $row->title }}</option>
                            @endforeach
                        </select>
                    </div>
                    {{-- <div class="form-group col-12 p-3">
                        <label>Title*</label>
                        <input type="text" class="form-control border-bottom border-1 border-dark"
                        placeholder="Enter Sub Town Here..." name="title" required  value="{{ old('title',$complaint->title) }}"/>
                    </div> --}}
                    <div class="form-group col-12 p-3">
                        <label>Description*</label>
                        <textarea class="form-control border-bottom border-1 border-dark"
                        placeholder="Enter Description Here..." name="description" required >{{ old('description',$complaint->description) }}</textarea>
                    </div>
                    <div class="form-group col-12 p-3">
                        <label>Customer Name</label>
                        <input type="text" class="form-control border-bottom border-1 border-dark"
                        placeholder="Enter Customer Name Here..." name="customer_name"   value="{{ old('customer_name',$complaint->customer_name) }}"/>
                    </div>
                    <div class="form-group col-12 p-3">
                        <label>Phone Number</label>
                        <input type="tel" class="form-control border-bottom border-1 border-dark"
                        placeholder="Enter Phone Number Here..." name="phone"   value="{{ old('phone',$complaint->phone) }}"/>
                    </div>
                    <div class="form-group col-12 p-3">
                        <label>Email</label>
                        <input type="email" class="form-control border-bottom border-1 border-dark"
                        placeholder="Enter Email Here..." name="email"   value="{{ old('email',$complaint->email) }}"/>
                    </div>
                    <div class="form-group col-12 p-3">
                        <label>Picture</label>
                        <input type="file" class="form-control border-bottom border-1 border-dark"
                             name="image" value="{{ old('image') }}" />
                    </div>
                    <div class="text-center">
                        <button type="submit"
                            class="btn btn-lg bg-gradient-primary btn-lg w-20 mt-4 mb-0">Update</button>
                    </div>
                </div>

            </form>
        </div>
    </div>
  </div>
</div>


@endsection
