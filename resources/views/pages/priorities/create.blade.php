@extends('layouts.app')

@section('content')

<div class="row">
    <div class="col-12">
      <div class="card my-4">
        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
          <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
            <div class="row">
                <div class="col-6">
                    <h6 class="text-white text-capitalize ps-3">Add Priority</h6>
                </div>
            </div>
          </div>
        </div>
        <div class="card-body px-4 pb-2">
            <h5>Give  Priority Informarion...</h5>
            <form role="form" method="POST" action="{{ route('priorities-management.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="row">

                    <div class="form-group col-12">
                        <label>Title</label>
                        <input type="text" class="form-control border-bottom text-white" placeholder="Enter Priority Title..." name="title" value="{{ old('title') }}" required/>

                    </div>


                    <div class="text-center">
                        <button type="submit" class="btn btn-lg bg-gradient-primary btn-lg w-20 mt-4 mb-0">Create</button>
                      </div>
                  </div>

            </form>
        </div>
    </div>
  </div>
</div>


@endsection
