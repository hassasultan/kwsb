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
            <form role="form" method="POST" action="{{ route('town-management.update',$town->id) }}" enctype="multipart/form-data">
                @method('PUT')
                @csrf
                <div class="row">
                    <div class="form-group col-12 p-3">
                        <label>Town*</label>
                        <input type="text" class="form-control border-bottom border-1 border-dark"
                        placeholder="Enter Town Here..." name="town" required  value="{{ old('town',$town->town) }}"/>
                    </div>
                    <select name="district_id" class="select2-multiple form-control fs-14  h-50px" required>
                        @foreach ($district as $row)
                            <option value="{{ $row->id }}" @if($row->id == $town->district_id) selected @endif>{{ $row->title }}
                            </option>
                        @endforeach
                    </select>
                    {{-- <div class="form-group col-12 p-3">
                        <label>Sub Town*</label>
                        <input type="text" class="form-control border-bottom border-1 border-dark"
                        placeholder="Enter Sub Town Here..." name="subtown" required  value="{{ old('subtown',$town->subtown) }}"/>
                    </div> --}}
                    <div class="text-center">
                        <button type="submit" class="btn btn-lg bg-gradient-primary btn-lg w-20 mt-4 mb-0">Update</button>
                    </div>
                </div>

            </form>
        </div>
    </div>
  </div>
</div>


@endsection
