@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <a href="{{ request()->get('from_request') == '1' ? route('compaints-management.index', ['comp_type_id' => [1,2,5]]) : route('compaints-management.index') }}" class="btn btn-outline-primary">
                        <i class="fas fa-arrow-left me-2"></i>Back to List
                    </a>
                    <h2 class="page-title mb-0">Edit Complaint</h2>
                </div>
                <div class="card my-4">
                    <div class="card-body px-4 pb-2">
                        <h5>Update The Complaints Information...</h5>
                        <form role="form" method="POST" action="{{ route('compaints-management.update', $complaint->id) }}"
                            enctype="multipart/form-data">
                            @method('PUT')
                            @csrf

                            <!-- Customer Information Section -->
                            <div class="row mb-4">
                                <div class="col-12">
                                    <h6 class="text-primary">Customer Information</h6>
                                </div>
                                <div class="form-group col-md-6 p-3">
                                    <label>Consumer Number</label>
                                    <input type="text" class="form-control border-bottom border-1 border-dark"
                                        placeholder="Consumer Number" name="customer_num"
                                        value="{{ old('customer_num', $complaint->customer_num) }}" />
                                </div>
                                <div class="form-group col-md-6 p-3">
                                    <label>Customer Name</label>
                                    <input type="text" class="form-control border-bottom border-1 border-dark"
                                        placeholder="Enter Customer Name Here..." name="customer_name"
                                        value="{{ old('customer_name', $complaint->customer_name) }}" />
                                </div>
                                <div class="form-group col-md-6 p-3">
                                    <label>Phone Number</label>
                                    <input type="tel" class="form-control border-bottom border-1 border-dark"
                                        placeholder="Enter Phone: +92(XXX) XXXXXXX" name="phone"
                                        value="{{ old('phone', $complaint->phone) }}" />
                                </div>
                                <div class="form-group col-md-6 p-3">
                                    <label>Email</label>
                                    <input type="email" class="form-control border-bottom border-1 border-dark"
                                        placeholder="Enter Email Here..." name="email"
                                        value="{{ old('email', $complaint->email) }}" />
                                </div>
                                <div class="form-group col-md-6 p-3">
                                    <label>Address</label>
                                    <input type="text" class="form-control border-bottom border-1 border-dark"
                                        placeholder="Enter Address Here..." name="address"
                                        value="{{ old('address', $complaint->address) }}" />
                                </div>
                                <div class="form-group col-md-6 p-3">
                                    <label>Nearest Landmark</label>
                                    <input type="text" class="form-control border-bottom border-1 border-dark"
                                        placeholder="Enter Nearest Landmark Here..." name="landmark"
                                        value="{{ old('landmark', $complaint->landmark) }}" />
                                </div>
                            </div>

                            <!-- Complaint Information Section -->
                            <div class="row mb-4">
                                <div class="col-12">
                                    <h6 class="text-primary">Complaint Information</h6>
                                </div>
                                <div class="form-group col-md-6 p-3">
                                    <label>Select Town*</label>
                                    <select name="town_id" id="town_id" class="select2-multiple form-control fs-14 h-50px" required>
                                        <option value="">-- Select Town --</option>
                                        @foreach ($town as $row)
                                            <option value="{{ $row->id }}"
                                                @if ($row->id == $complaint->town_id) selected @endif>{{ $row->town }}
                                                ({{ $row->subtown }})</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-6 p-3">
                                    <label>Select SubTown*</label>
                                    <select name="sub_town_id" id="sub_town_id" class="select2-multiple form-control fs-14 h-50px" required>
                                        <option value="">-- Select SubTown --</option>
                                        @foreach ($subtown as $row)
                                            <option value="{{ $row->id }}"
                                                @if ($row->id == $complaint->sub_town_id) selected @endif>({{ $row->town->town }})
                                                {{ $row->title }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-6 p-3">
                                    <label>Select Type*</label>
                                    <select name="type_id" id="type_id" class="select2-multiple form-control fs-14 h-50px" required>
                                        <option value="">-- Select Type --</option>
                                        @foreach ($type as $row)
                                            <option value="{{ $row->id }}"
                                                @if ($row->id == $complaint->type_id) selected @endif>{{ $row->title }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-6 p-3">
                                    <label>Select Sub Type*</label>
                                    <select name="subtype_id" id="subtype_id"
                                        class="select2-multiple form-control fs-14 h-50px" required>
                                        <option value="">-- Select Sub Type --</option>
                                        @if($complaint->subtype)
                                            <option value="{{ $complaint->subtype_id }}" selected>{{ $complaint->subtype->title }}</option>
                                        @endif
                                    </select>
                                </div>
                                <div class="form-group col-md-6 p-3">
                                    <label>Select Priority*</label>
                                    <select name="prio_id" class="select2-multiple form-control fs-14 h-50px">
                                        <option value="">-- Select Priority --</option>
                                        @foreach ($prio as $row)
                                            <option value="{{ $row->id }}" @if ($row->id == $complaint->prio_id) selected @endif>{{ $row->title }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-6 p-3">
                                    <label>Select Source*</label>
                                    <select name="source" class="select2-multiple form-control fs-14 h-50px" required>
                                        <option value="">-- Select Source --</option>
                                        @foreach ($source as $row)
                                            <option value="{{ $row->title }}" @if($row->title == $complaint->source) selected @endif>{{ $row->title }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-12 p-3">
                                    <label>Description*</label>
                                    <textarea class="form-control border-bottom border-1 border-dark" placeholder="Enter Description Here..."
                                        name="description" required>{{ old('description', $complaint->description) }}</textarea>
                                </div>
                                <div class="form-group col-12 p-3">
                                    <label>Picture</label>
                                    <input type="file" class="form-control border-bottom border-1 border-dark" name="image"
                                        value="{{ old('image') }}" />
                                    @if($complaint->image)
                                        <small class="text-muted">Current image: {{ $complaint->image }}</small>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group col-12 p-3 text-right">
                                <button type="submit" class="btn btn-primary">Update</button>
                                @if (auth()->user()->role == 1)
                                    <a href="{{ url('/admin/compaints-management') }}" class="btn btn-secondary">Cancel</a>
                                @else
                                    <a href="{{ url('/system/compaints-management') }}" class="btn btn-secondary">Cancel</a>
                                @endif
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            // Initialize subtype dropdown with current complaint's subtype data
            var currentTypeId = $('#type_id').val();
            var currentSubtypeId = '{{ $complaint->subtype_id }}';

            if (currentTypeId && currentSubtypeId) {
                loadSubtypes(currentTypeId, currentSubtypeId);
            }
        });

        $("#town_id").on("change", function() {
            var town_id = $(this).val();
            if (town_id) {
                $.ajax({
                    type: "get",
                    url: "{{ route('subtown.by.town') }}",
                    data: {
                        'town_id': town_id,
                    },
                    success: function(data) {
                        $("#sub_town_id").html('<option value="">-- Select SubTown --</option>');
                        $.each(data, function(key, val) {
                            $("#sub_town_id").append('<option value="' + val['id'] + '">' + val['title'] + '</option>');
                        });
                    },
                    error: function() {
                        console.log('Error loading subtowns');
                    }
                });
            } else {
                $("#sub_town_id").html('<option value="">-- Select SubTown --</option>');
            }
        });

        $("#type_id").on("change", function() {
            var type_id = $(this).val();
            if (type_id) {
                loadSubtypes(type_id);
            } else {
                $("#subtype_id").html('<option value="">-- Select Sub Type --</option>');
            }
        });

        function loadSubtypes(type_id, selectedSubtypeId = null) {
            $.ajax({
                type: "get",
                url: "{{ route('subtype.by.type') }}",
                data: {
                    'type_id': type_id,
                },
                success: function(data) {
                    $("#subtype_id").html('<option value="">-- Select Sub Type --</option>');
                    $.each(data, function(key, val) {
                        var selected = (selectedSubtypeId && val['id'] == selectedSubtypeId) ? 'selected' : '';
                        $("#subtype_id").append('<option value="' + val['id'] + '" ' + selected + '>' + val['title'] + '</option>');
                    });
                },
                error: function() {
                    console.log('Error loading subtypes');
                }
            });
        }
    </script>
@endsection
