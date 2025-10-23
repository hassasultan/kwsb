@extends('layouts.app')

@section('content')
    <div class="container-fluid py-4">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="card shadow-lg border-0">
                    <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                        <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                            <div class="row align-items-center">
                                <div class="col-6">
                                    <h4 class="text-white text-capitalize ps-3 mb-0">
                                        <i class="fas fa-plus-circle me-2"></i>Add New Complaint
                                    </h4>
                                </div>
                                <!-- <div class="col-6 text-end pe-3">
                                    <span class="badge bg-light text-dark">Step 1 of 2</span>
                                </div> -->
                            </div>
                        </div>
                    </div>
                    <div class="card-body px-4 pb-4">
                        <!-- Consumer Lookup Section -->
                        <div class="mb-5">
                            <div class="row align-items-center mb-3">
                                <div class="col-auto">
                                    <div class="avatar avatar-sm bg-gradient-info rounded-circle">
                                        <i class="fas fa-search text-white"></i>
                                    </div>
                                </div>
                                <div class="col">
                                    <h5 class="mb-0 text-gradient text-info">Consumer Lookup (Optional)</h5>
                                    <p class="text-sm text-muted mb-0">Enter consumer number to verify billing details (optional)</p>
                                </div>
                            </div>
                            
                            <form role="form" method="POST" id="consumerLookupForm">
                                @csrf
                                <div class="row align-items-end">
                                    <!-- Input -->
                                    <div class="col-md-5">
                                        <div class="form-group mb-0">
                                            <label for="consumer_no" class="form-control-label text-dark font-weight-bold">
                                                Consumer Number (Optional)
                                            </label>
                                            <div class="input-group input-group-dynamic">
                                                <input 
                                                    type="text" 
                                                    class="form-control border rounded-3 px-3 py-2"
                                                    placeholder="Enter Consumer Number (e.g., A1234567890)" 
                                                    name="consumer_no" 
                                                    id="consumer_no" 
                                                />
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Button -->
                                    <div class="col-md-2">
                                        <button 
                                            type="button" 
                                            id="lookupBtn" 
                                            class="btn btn-primary w-100 py-2 rounded-3"
                                            aria-label="Lookup Consumer"
                                        >
                                            <i class="fas fa-search me-2" aria-hidden="true"></i>
                                            Lookup Consumer
                                        </button>
                                    </div>
                                </div>
                            </form>

                        </div>

                        <!-- Main Form Section -->
                        <form role="form" method="POST" action="{{ route('compaints-management.store') }}"
                        enctype="multipart/form-data">
                        @csrf
                            <!-- Hidden field for consumer number -->
                            <input type="hidden" name="customer_num" id="customer_num" value="">
                            
                            <!-- Consumer Details Section -->
                            <div class="row mb-4">
                                <div class="col-md-6">
                                    <div class="card border shadow-sm h-100">
                                        <div class="card-header bg-gradient-info text-white py-3">
                                            <h6 class="mb-0">
                                                <i class="fas fa-user me-2"></i>Consumer Information (Optional)
                                            </h6>
                                        </div>
                                        <div class="card-body">
                                            <div class="form-group mb-3">
                                                <label class="form-control-label text-dark font-weight-bold">Consumer Number</label>
                                                <input type="text" class="form-control border rounded-3 px-3 py-2 bg-light"
                                                    value="" id="display_consumer_no" disabled />
                                            </div>
                                            <div class="form-group mb-3">
                                                <label class="form-control-label text-dark font-weight-bold">Consumer Name</label>
                                                <input type="text" class="form-control border rounded-3 px-3 py-2 bg-light"
                                                    value="" id="display_consumer_name" disabled />
                                            </div>
                                            <div class="form-group mb-3">
                                                <label class="form-control-label text-dark font-weight-bold">Address</label>
                                                <input type="text" class="form-control border rounded-3 px-3 py-2 bg-light"
                                                    value="" id="display_address" disabled />
                                            </div>
                                            <div class="form-group mb-0">
                                                <label class="form-control-label text-dark font-weight-bold">Zone</label>
                                                <input type="text" class="form-control border rounded-3 px-3 py-2 bg-light"
                                                    value="" id="display_zone" disabled />
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="card border shadow-sm h-100">
                                        <div class="card-header bg-gradient-warning text-white py-3">
                                            <h6 class="mb-0">
                                                <i class="fas fa-file-invoice-dollar me-2"></i>Billing Information (Optional)
                                            </h6>
                                        </div>
                                        <div class="card-body">
                                            <div class="form-group mb-3">
                                                <label class="form-control-label text-dark font-weight-bold">Current Bill Period</label>
                                                <input type="text" class="form-control border rounded-3 px-3 py-2 bg-light"
                                                    value="" id="display_bill_period" disabled />
                                            </div>
                                            <div class="form-group mb-3">
                                                <label class="form-control-label text-dark font-weight-bold">Current Amount Due</label>
                                                <input type="text" class="form-control border rounded-3 px-3 py-2 bg-light"
                                                    value="" id="display_payable" disabled />
                                            </div>
                                            <div class="form-group mb-3">
                                                <label class="form-control-label text-dark font-weight-bold">Current Amount After Due</label>
                                                <input type="text" class="form-control border rounded-3 px-3 py-2 bg-light"
                                                    value="" id="display_after_due" disabled />
                                            </div>
                                            <div class="form-group mb-3">
                                                <label class="form-control-label text-dark font-weight-bold">Current Month Bill Status</label>
                                                <input type="text" class="form-control border rounded-3 px-3 py-2 bg-light"
                                                    value="" id="display_current_month_status" disabled />
                                            </div>
                                            <div class="form-group mb-0">
                                                <label class="form-control-label text-dark font-weight-bold">Last Month Bill Status</label>
                                                <input type="text" class="form-control border rounded-3 px-3 py-2 bg-light"
                                                    value="" id="display_last_month" disabled />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Focal Person Information Section -->
                            <div class="card border shadow-sm mb-4">
                                <div class="card-header bg-gradient-success text-white py-3">
                                    <h6 class="mb-0">
                                        <i class="fas fa-user-tie me-2"></i>Focal Person Information
                                    </h6>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group mb-3">
                                                <label class="form-control-label text-dark font-weight-bold">Person Name</label>
                                                <div class="input-group input-group-dynamic">
                                                    <input type="text" class="form-control border rounded-3 px-3 py-2"
                                                        placeholder="Enter Person Name Here..." name="customer_name"
                                                        value="{{ old('customer_name') }}" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group mb-3">
                                                <label class="form-control-label text-dark font-weight-bold">Phone Number</label>
                                                <div class="input-group input-group-dynamic">
                                                    <input type="tel" class="form-control border rounded-3 px-3 py-2"
                                                        placeholder="Enter Phone: +92(XXX) XXXXXXX" name="phone"
                                                        value="{{ old('phone') }}" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group mb-3">
                                                <label class="form-control-label text-dark font-weight-bold">Email Address</label>
                                                <div class="input-group input-group-dynamic">
                                                    <input type="email" class="form-control border rounded-3 px-3 py-2"
                                                        placeholder="Enter Email Here..." name="email" value="{{ old('email') }}" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group mb-3">
                                                <label class="form-control-label text-dark font-weight-bold">Address</label>
                                                <div class="input-group input-group-dynamic">
                                                    <input type="text" class="form-control border rounded-3 px-3 py-2"
                                                        placeholder="Enter Address Here..." name="address" value="{{ old('address') }}" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group mb-0">
                                                <label class="form-control-label text-dark font-weight-bold">Nearest Landmark</label>
                                                <div class="input-group input-group-dynamic">
                                                    <input type="text" class="form-control border rounded-3 px-3 py-2"
                                                        placeholder="Enter Nearest Land Mark Here..." name="landmark" value="{{ old('landmark') }}" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Complaint Information Section -->
                            <div class="card border shadow-sm mb-4">
                                <div class="card-header bg-gradient-danger text-white py-3">
                                    <div class="row align-items-center">
                                        <div class="col">
                                            <h6 class="mb-0">
                                                <i class="fas fa-exclamation-triangle me-2"></i>Complaint Information
                                            </h6>
                                        </div>
                                        <!-- <div class="col-auto">
                                            <span class="badge bg-light text-dark">Step 2 of 2</span>
                                        </div> -->
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group mb-3">
                                                <label class="form-control-label text-dark font-weight-bold">Select Town *</label>
                                                <select name="town_id" id="town_id" class="form-control border rounded-3 px-3 py-2" required>
                                                    <option disabled selected> -- Select Town Here -- </option>
                                                    @foreach ($town as $row)
                                                        <option value="{{ $row->id }}">{{ $row->town }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group mb-3">
                                                <label class="form-control-label text-dark font-weight-bold">Select SubTown *</label>
                                                <select name="sub_town_id" id="sub_town_id" class="form-control border rounded-3 px-3 py-2" required>
                                                    <option disabled selected> -- Select Subtown Here -- </option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group mb-3">
                                                <label class="form-control-label text-dark font-weight-bold">Select Type *</label>
                                                <select name="type_id" id="type_id" class="form-control border rounded-3 px-3 py-2" required>
                                                    <option disabled selected> -- Select Type Here -- </option>
                                                    @foreach ($type as $row)
                                                        <option value="{{ $row->id }}">{{ $row->title }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group mb-3">
                                                <label class="form-control-label text-dark font-weight-bold">Select Sub Type *</label>
                                                <select name="subtype_id" id="subtype_id" class="form-control border rounded-3 px-3 py-2" required>
                                                    <option disabled selected> -- Select SubType Here -- </option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group mb-3">
                                                <label class="form-control-label text-dark font-weight-bold">Select Priority *</label>
                                                <select name="prio_id" class="form-control border rounded-3 px-3 py-2" required>
                                                    <option disabled selected> -- Select Priority Here -- </option>
                                                    @foreach ($prio as $row)
                                                        <option value="{{ $row->id }}">{{ $row->title }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group mb-3">
                                                <label class="form-control-label text-dark font-weight-bold">Select Source *</label>
                                                <select name="source" class="form-control border rounded-3 px-3 py-2" required>
                                                    <option disabled selected> -- Select Source Here -- </option>
                                                    @foreach ($source as $row)
                                                        <option value="{{ $row->title }}">{{ $row->title }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group mb-3">
                                                <label class="form-control-label text-dark font-weight-bold">Description *</label>
                                                <textarea class="form-control border rounded-3 px-3 py-2" rows="4" 
                                                    placeholder="Enter detailed description of the complaint..."
                                                    name="description" required>{{ old('description') }}</textarea>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group mb-0">
                                                <label class="form-control-label text-dark font-weight-bold">Attach Picture (Optional)</label>
                                                <div class="input-group">
                                                    <input type="file" class="form-control border rounded-3 px-4 py-2"
                                                        name="image" accept="image/*" />
                                                </div>
                                                <small class="text-muted">Supported formats: JPEG, JPG, PNG Max size: 2MB</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Submit Button -->
                            <div class="text-center mb-4">
                                <button 
                                    type="submit" 
                                    class="btn btn-primary btn-lg px-5 py-3 rounded-3"
                                    aria-label="Submit Complaint"
                                    id="submitBtn"
                                >
                                    <i class="fas fa-paper-plane me-2" aria-hidden="true"></i>
                                    Submit Complaint
                                </button>
                            </div>
                        </form>
                    </div>
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
                alert('Please enter a consumer number to lookup');
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
                        
                        // Update hidden field for form submission
                        $("#customer_num").val(consumer.consumer_no);
                        
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
        
        // Form submission validation - Consumer lookup is optional
        $("form").on("submit", function(e) {
            // Consumer lookup is optional - no validation needed
            // Users can create complaints with or without consumer numbers
        });
    </script>
@endsection

