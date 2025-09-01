@extends('layouts.app')

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
                    <h5>Give Complaint Information...</h5>
                    <form role="form" method="POST" id="consumerLookupForm">
                        @csrf
                        <div class="row">
                            <div class="form-group col-8 p-3">
                                <label>Consumer Number</label>
                                <input type="text" class="form-control border-bottom border-1 border-dark"
                                    placeholder="Enter Consumer Number to lookup details..." name="consumer_no" id="consumer_no" required />
                                <button type="button" id="lookupBtn"
                                    class="btn btn-lg bg-gradient-primary btn-lg w-20 mt-4 mb-0">Lookup Consumer</button>
                            </div>
                        </div>
                    </form>

                    <form role="form" method="POST" action="{{ route('compaints-management.store') }}"
                    enctype="multipart/form-data">
                    @csrf
                        <div class="row">
                            <div class="col-6 card-body px-4 pb-2 ">
                                <div class="row border border-2 border-dark p-2">
                                    <h5>Consumer Information...</h5>
                                    <div class="form-group col-12 p-3">
                                        <label>Consumer #*</label>
                                        <input type="text" class="form-control border-bottom border-1 border-dark"
                                            value="" id="display_consumer_no" disabled />
                                    </div>
                                    <div class="form-group col-12 p-3">
                                        <label>Consumer Name*</label>
                                        <input type="text" class="form-control border-bottom border-1 border-dark"
                                            value="" id="display_consumer_name" disabled />
                                    </div>
                                    <div class="form-group col-12 p-3">
                                        <label>Address*</label>
                                        <input type="text" class="form-control border-bottom border-1 border-dark"
                                            value="" id="display_address" disabled />
                                    </div>
                                    <div class="form-group col-12 p-3">
                                        <label>Zone*</label>
                                        <input type="text" class="form-control border-bottom border-1 border-dark"
                                            value="" id="display_zone" disabled />
                                    </div>
                                </div>
                            </div>

                            <div class="col-6 card-body px-4 pb-2 ">
                                <div class="row border border-2 border-dark p-2">
                                    <h5>Billing Information...</h5>
                                    <div class="form-group col-12 p-3">
                                        <label>Current Bill Period</label>
                                        <input type="text" class="form-control border-bottom border-1 border-dark"
                                            value="" id="display_bill_period" disabled />
                                    </div>
                                    <div class="form-group col-12 p-3">
                                        <label>Current Amount Due</label>
                                        <input type="text" class="form-control border-bottom border-1 border-dark"
                                            value="" id="display_payable" disabled />
                                    </div>
                                    <div class="form-group col-12 p-3">
                                        <label>Current Amount After Due</label>
                                        <input type="text" class="form-control border-bottom border-1 border-dark"
                                            value="" id="display_after_due" disabled />
                                    </div>
                                    <div class="form-group col-12 p-3">
                                        <label>Current Month Bill Status</label>
                                        <input type="text" class="form-control border-bottom border-1 border-dark"
                                            value="" id="display_current_month_status" disabled />
                                    </div>
                                    <div class="form-group col-12 p-3">
                                        <label>Last Month Bill Status</label>
                                        <input type="text" class="form-control border-bottom border-1 border-dark"
                                            value="" id="display_last_month" disabled />
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 card-body px-4 pb-2 border border-2 border-dark mt-3">
                                <h5>Focal Person Information...</h5>
                                <div class="row">
                                    <div class="form-group col-6 p-3">
                                        <label>Person Name</label>
                                        <input type="text" class="form-control border-bottom border-1 border-dark"
                                            placeholder="Enter Person Name Here..." name="customer_name"
                                            value="{{ old('customer_name') }}" />
                                    </div>
                                    <div class="form-group col-6 p-3">
                                        <label>Person Phone Number</label>
                                        <input type="tel" class="form-control border-bottom border-1 border-dark"
                                            placeholder="Enter Phone: +92(XXX) XXXXXXX" name="phone"
                                            value="{{ old('phone') }}" />
                                    </div>
                                    <div class="form-group col-6 p-3">
                                        <label>Person Email</label>
                                        <input type="email" class="form-control border-bottom border-1 border-dark"
                                            placeholder="Enter Email Here..." name="email" value="{{ old('email') }}" />
                                    </div>
                                    <div class="form-group col-6 p-3">
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
                                <h5>Complaint Information...</h5>
                                <div class="row">
                                    <div class="form-group col-12 p-3">
                                        <label>Select Town*</label>
                                        <select name="town_id" id="town_id" class="select2-multiple form-control fs-14  h-50px" required>
                                            <option disabled selected> -- Select Town Here -- </option>
                                            @foreach ($town as $row)
                                                <option value="{{ $row->id }}">{{ $row->town }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group col-12 p-3">
                                        <label>Select SubTown*</label>
                                        <select name="sub_town_id" id="sub_town_id" class="select2-multiple form-control fs-14  h-50px" required>
                                            <option disabled selected> -- Select Subtown Here -- </option>
                                            {{-- @foreach ($subtown as $row)
                                                <option value="{{ $row->id }}">({{ $row->town->town }})  {{ $row->title }}</option>
                                            @endforeach --}}
                                        </select>
                                    </div>
                                    <div class="form-group col-12 p-3">
                                        <label>Select Type*</label>
                                        <select name="type_id" id="type_id" class="select2-multiple form-control fs-14  h-50px" required>
                                            <option disabled selected> -- Select Type Here -- </option>
                                            @foreach ($type as $row)
                                                <option value="{{ $row->id }}">{{ $row->title }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group col-12 p-3">
                                        <label>Select Sub Type*</label>
                                        <select name="subtype_id" id="subtype_id" class="select2-multiple form-control fs-14  h-50px" required>
                                            <option disabled selected> -- Select SubType Here -- </option>
                                            {{-- @foreach ($subtype as $row)
                                                <option value="{{ $row->id }}">{{ $row->title }}</option>
                                            @endforeach --}}
                                        </select>
                                    </div>
                                    <div class="form-group col-12 p-3">
                                        <label>Select Priority*</label>
                                        <select name="prio_id" class="select2-multiple form-control fs-14  h-50px" required>
                                            <option disabled selected> -- Select Priority Here -- </option>
                                            @foreach ($prio as $row)
                                                <option value="{{ $row->id }}">{{ $row->title }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group col-12 p-3">
                                        <label>Select Source*</label>
                                        <select name="source" class="select2-multiple form-control fs-14  h-50px" required>
                                            <option disabled selected> -- Select Source Here -- </option>
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

@section('bottom_script')
    <script>
        $("#lookupBtn").on("click", function() {
            var consumerNo = $("#consumer_no").val();
            if (!consumerNo) {
                alert('Please enter a consumer number');
                return;
            }

            $.ajax({
                type: "POST",
                url: "{{ route('compaints-management.get-consumer-details') }}",
                data: {
                    'consumer_no': consumerNo,
                    '_token': '{{ csrf_token() }}'
                },
                success: function (response) {
                    if (response.status === 'success') {
                        var consumer = response.consumer;
                        
                        // Update consumer information
                        $("#display_consumer_no").val(consumer.consumer_no);
                        $("#display_consumer_name").val(consumer.name);
                        $("#display_address").val(consumer.address);
                        $("#display_zone").val(consumer.zone_name);
                        
                        // Update billing information
                        $("#display_bill_period").val(consumer.bill_period);
                        $("#display_payable").val('Rs. ' + consumer.payable);
                        $("#display_after_due").val('Rs. ' + consumer.after_due);
                        $("#display_last_month").val('Last Month Billed Amount '+ consumer.last_month_billed + ': Last Month Paid ' + consumer.last_month_paid + ': Date of Payment  ' + consumer.last_month_date);
                        
                        // Update current month bill status
                        if (consumer.current_month_status) {
                            var statusText = consumer.current_month_status;
                            if (consumer.current_month_status === 'Unpaid') {
                                statusText += ' - Rs. ' + consumer.current_month_amount;
                                if (consumer.current_month_surcharge > 0) {
                                    statusText += ' + Surcharge: Rs. ' + consumer.current_month_surcharge;
                                }
                            } else if (consumer.current_month_status === 'No billing data found') {
                                statusText = 'No current month billing data found';
                                console.log('API Debug Info:', consumer.api_debug);
                            } else if (consumer.current_month_status === 'API call failed') {
                                statusText = 'Unable to fetch current month status (API Error: ' + consumer.api_error + ')';
                            }
                            $("#display_current_month_status").val(statusText);
                        } else {
                            $("#display_current_month_status").val('Status not available');
                        }
                        
                    } else {
                        alert('Error: ' + response.message);
                    }
                },
                error: function() {
                    alert('Error occurred while fetching consumer details');
                }
            });
        });

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
                    $("#sub_town_id").append(your_html);
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
                    $("#subtype_id").append(your_html);
                },
                error: function() {
                    console.log(data);
                }
            });
        });
    </script>
@endsection

