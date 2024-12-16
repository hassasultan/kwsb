@extends('layouts.app')

@section('content')

<div class="row">
    <div class="col-12">
      <div class="card my-4">
        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
          <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
            <div class="row">
                <div class="col-6">
                    <h6 class="text-black text-capitalize ps-3">Agent List</h6>
                </div>
                <div class="col-12 text-right">
                    <a class="btn btn-primary" href="{{ route('agent-management.create') }}">add</i>&nbsp;&nbsp;<i class="fa fa-user"></i></a>
                </div>
            </div>
          </div>
        </div>
        <div class="card-body px-0 pb-2">
          <div class="p-0">
            <table id="example1" class="table table-bordered align-items-center mb-0">
              <thead>
                <tr>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Agent</th>
                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Town</th>
                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Type</th>
                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Address</th>
                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Description</th>
                  {{-- <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Total Trucks</th> --}}
                  <th class="text-secondary opacity-7">Action</th>
                </tr>
              </thead>
              <tbody>
                {{-- @if(count($user) > 0) --}}
                    @foreach ($agent as $key => $row)
                        <tr>
                            <td>
                                <p class="text-xs font-weight-bold mb-0">{{ $row->user->name }}</p>
                                @if ($row->avatar != NULL)
                                    <img src="{{ asset('storage/'.$row->avatar) }}" class="img-fluid" style="width: 70px; height: 70px;"/>
                                @endif
                            </td>
                            <td class="align-middle text-center text-sm">
                                <p class="text-xs text-secondary mb-0">{{ $row->town->town }}</p>
                                <p class="text-xs text-secondary mb-0">{{ $row->town->subtown }}</p>
                            </td>
                            <td class="align-middle text-center text-sm">
                                <p class="text-xs text-secondary mb-0">{{ $row->complaint_type->title ?? 'Type is not defined...' }}</p>
                            </td>
                            <td>
                                <p class="text-xs text-center font-weight-bold mb-0"> {{ $row->address }} </p>
                            </td>
                            <td>
                                <p class="text-xs text-center font-weight-bold mb-0"> {{ $row->description }} </p>
                            </td>
                            {{-- <td class="align-middle text-center text-sm">
                                <p class="text-xs text-secondary mb-0">{{ count($row->hydrant->vehicles) }}</p>
                            </td> --}}
                            <td class="align-middle">
                                <a href="{{ route('agent-management.edit',$row->id) }}" class="text-secondary font-weight-bold text-xs m-3" data-toggle="tooltip" data-original-title="Edit user">
                                Edit
                                </a>
                                |
                                <a href="{{ route('agent-management.details',$row->id) }}" class="text-secondary font-weight-bold text-xs m-3" data-toggle="tooltip" data-original-title="Show Complaints">
                                    Assigned Complaints
                                    </a>
                                    |
                                    <button 
                                class="btn btn-link text-secondary p-0 m-0" 
                                onclick="openDateRangeModal({{ $row->id }})">
                                GET REPORT
                            </button>
                            </td>
                        </tr>
                    @endforeach
                {{-- @else
                    No Record Find...
                @endif --}}
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="dateRangeModal" tabindex="-1" aria-labelledby="dateRangeModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="POST" action="{{ route('agent-management.report', ':id') }}">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="dateRangeModalLabel">Select Date Range</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div>
                        <input type="checkbox" id="use_date_range" name="use_date_range" value="1">
                        <label for="use_date_range">Filter by date range</label>
                    </div>
                    <div id="date-range-fields" style="display: none;">
                        <label for="from_date">From Date</label>
                        <input type="date" id="from_date" name="from_date" class="form-control">
                        
                        <label for="to_date" class="mt-2">To Date</label>
                        <input type="date" id="to_date" name="to_date" class="form-control">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" id="cancel-button">Cancel</button>
                    <button type="submit" class="btn btn-primary">Generate Report</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Include Bootstrap CSS and JS -->
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/5.2.3/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>

<script>
    const dateRangeFields = document.getElementById('date-range-fields');
    const useDateRangeCheckbox = document.getElementById('use_date_range');
    const modal = new bootstrap.Modal(document.getElementById('dateRangeModal'));

    // Toggle date range fields
    useDateRangeCheckbox.addEventListener('change', () => {
        dateRangeFields.style.display = useDateRangeCheckbox.checked ? 'block' : 'none';
    });

    // Open the modal and update form action
    function openDateRangeModal(agentId) {
        const form = document.querySelector('#dateRangeModal form');
        form.action = form.action.replace(':id', agentId);
        modal.show();
    }

    // Close the modal on "Cancel" button click
    document.getElementById('cancel-button').addEventListener('click', () => {
        modal.hide();
    });
</script>


@endsection
