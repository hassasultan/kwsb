@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <a href="{{ url()->previous() }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Back
                    </a>
                    <h2 class="page-title mb-0">Complaint Details</h2>
                </div>
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Complaint Details</h5>
                        <p class="card-text">
                            <!-- Add your complaint details here -->
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection 