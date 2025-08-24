@extends('department.layouts.app')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card shadow">
                <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                    <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                        <div class="row">
                            <div class="col-6">
                                <h6 class="text-white text-capitalize ps-3">Add Complaint</h6>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body px-4 pb-2">
                    <h5>Give Complaint Informarion...</h5>
                    <form role="form" method="get" action="{{ route('compaints-management.create') }}"
                        enctype="multipart/form-data">
                        <div class="row">

                            <div class="form-group col-8 p-3">
                                <label>Customer Number</label>
                                <input type="text" class="form-control border-bottom border-1 border-dark"
                                    placeholder="Enter Customer Number for search ..." name="search" required
                                    value="{{ old('search') }}" />
                                <button type="submit"
                                    class="btn btn-lg bg-gradient-primary btn-lg w-20 mt-4 mb-0">Search</button>
                            </div>
                        </div>
                    </form>

                    <form role="form" method="POST" action="{{ route('compaints-management.store') }}"
                    enctype="multipart/form-data">
                    @csrf
                        <div class="row">
                            <div class="col-6 card-body px-4 pb-2 ">
                                <div class="row border border-2 border-dark p-2">
                                    <h5>Consumer Informarion...</h5>
                                    <div class="form-group col-12 p-3">
                                        <label>Consumer #*</label>
                                        <input type="text" class="form-control border-bottom border-1 border-dark"
                                            value="@if ($customer != null){{ $customer->customer_id }}@endif" disabled />
                                    </div>
                                    <div class="form-group col-12 p-3">
                                        <label>Consumer Name*</label>
                                        <input type="text" class="form-control border-bottom border-1 border-dark"
                                            value="@if ($customer != null){{ $customer->customer_name }}@endif" disabled />
                                    </div>
                                    <div class="form-group col-12 p-3">
                                        <label>Town*</label>
                                        <input type="text" class="form-control border-bottom border-1 border-dark"
                                            value="@if ($customer != null){{ $customer->town }}@endif" disabled />
                                    </div>
                                    <div class="form-group col-12 p-3">
                                        <label>Sub Town*</label>
                                        <input type="text" class="form-control border-bottom border-1 border-dark"
                                            value="@if ($customer != null){{ $customer->sub_town }}@endif" disabled />
                                    </div>
                                </div>
                            </div>

                            <div class="col-6 card-body px-4 pb-2 ">
                                <div class="row  border border-2 border-dark p-2">
                                    <div class="form-group col-12 p-3">
                                        <label>Consumer #</label>
                                        <input type="text" class="form-control border-bottom border-1 border-dark"
                                            placeholder="Enter Consumer Number Here..." name="customer_num"
                                            value="{{ old('customer_num') }}" />
                                    </div>
                                    <h5>Focal Person Informarion...</h5>
                                    <div class="form-group col-12 p-3">
                                        <label>Person Name</label>
                                        <input type="text" class="form-control border-bottom border-1 border-dark"
                                            placeholder="Enter Person  Name Here..." name="customer_name"
                                            value="{{ old('customer_name') }}" />
                                    </div>
                                    <div class="form-group col-12 p-3">
                                        <label>Person Phone Number</label>
                                        <input type="tel" class="form-control border-bottom border-1 border-dark"
                                            placeholder="Enter Phone: +92(XXX) XXXXXXX" name="phone"
                                            value="{{ old('phone') }}" />
                                    </div>
                                    <div class="form-group col-12 p-3">
                                        <label>Person Email</label>
                                        <input type="email" class="form-control border-bottom border-1 border-dark"
                                            placeholder="Enter Email Here..." name="email" value="{{ old('email') }}" />
                                    </div>
                                    <div class="form-group col-12 p-3">
                                        <label>Person Address</label>
                                        <input type="text" class="form-control border-bottom border-1 border-dark"
                                            placeholder="Enter Address Here..." name="address" value="{{ old('address') }}" />
                                    </div>
                                    <div class="form-group col-12 p-3">
                                        <label>Person Nearest Land Mark</label>
                                        <input type="text" class="form-control border-bottom border-1 border-dark"
                                            placeholder="Enter Nearest Land Mark Here..." name="landmark" value="{{ old('landmark') }}" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 card-body px-4 pb-2 border border-2 border-dark mt-3">
                                <h5>Complaint Informarion...</h5>
                                <div class="row">
                                    <div class="form-group col-12 p-3">
                                        <label>Select Town*</label>
                                        <select name="town_id" id="town_id" class="select2-multiple form-control fs-14  h-50px" required>
                                            @foreach ($town as $row)
                                                <option value="{{ $row->id }}">{{ $row->town }}

                                                </option>
                                            @endforeach
                                        </select>
                                        @if ($customer != null)
                                            <input type="hidden" name="customer_id"
                                            value="@if (isset($customer->customer_id)) {{ $customer->id }} @endif" />
                                        @endif
                                    </div>
                                    <div class="form-group col-12 p-3">
                                        <label>Select SubTown*</label>
                                        <select name="sub_town_id" id="sub_town_id" class="select2-multiple form-control fs-14  h-50px" required>
                                            @foreach ($subtown as $row)
                                                <option value="{{ $row->id }}">({{ $row->town->town }})  {{ $row->title }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group col-12 p-3">
                                        <label>Select Type*</label>
                                        <select name="type_id" id="type_id" class="select2-multiple form-control fs-14  h-50px" required>
                                            @foreach ($type as $row)
                                                <option value="{{ $row->id }}">{{ $row->title }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group col-12 p-3">
                                        <label>Select Sub Type*</label>
                                        <select name="subtype_id" id="subtype_id" class="select2-multiple form-control fs-14  h-50px" required>
                                            @foreach ($subtype as $row)
                                                <option value="{{ $row->id }}">{{ $row->title }}</option>
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
                                            placeholder="Enter Sub Town Here..." name="title" required
                                            value="{{ old('title') }}" />
                                    </div> --}}
                                    <div class="form-group col-12 p-3">
                                        <label>Description*</label>
                                        <textarea class="form-control border-bottom border-1 border-dark" placeholder="Enter Description Here..."
                                            name="description" required>{{ old('description') }}</textarea>
                                    </div>
                                    <div class="form-group col-12 p-3">
                                        <label>Picture</label>
                                        <input type="file" class="form-control border-bottom border-1 border-dark"
                                            name="image" value="{{ old('image') }}" />
                                    </div>
                                </div>
                            </div>
                            {{-- @if ($customer != null) --}}
                                <div class="text-center">
                                    <button type="submit"
                                        class="btn btn-lg bg-gradient-primary btn-lg w-20 mt-4 mb-0">Create</button>
                                </div>
                            {{-- @endif --}}
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('bottom_script')
    <script>
        $("#town_id").on("change",function(){
            var town_id = $(this).val();
            $.ajax({
                type: "get",
                url: "{{ route('subtown.by.town') }}",
                data: {
                    'town_id':town_id,
                },
                success: function (data) {
                    $("#sub_town_id").html("");
                    var your_html = "";
                        $.each(data, function (key, val) {
                            console.log(val);
                            your_html += "<option value="+val['id']+">" +  val['title'] + "</option>"
                        });
                    $("#sub_town_id").append(your_html); //// For Append
                },
                error: function() {
                    console.log(data);
                }
            });
        });
        $("#type_id").on("change",function(){
            var type_id = $(this).val();
            $.ajax({
                type: "get",
                url: "{{ route('subtype.by.type') }}",
                data: {
                    'type_id':type_id,
                },
                success: function (data) {
                    $("#subtype_id").html("");
                    var your_html = "";
                        $.each(data, function (key, val) {
                            console.log(val);
                            your_html += "<option value="+val['id']+">" +  val['title'] + "</option>"
                        });
                    $("#subtype_id").append(your_html); //// For Append
                },
                error: function() {
                    console.log(data);
                }
            });
        });
    </script>
@endsection

