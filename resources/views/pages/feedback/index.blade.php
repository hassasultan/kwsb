@extends('layouts.app')
@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-12">
            {{-- @include('layouts.include.toolbar') --}}
            <h2 class="page-title">Customers Feedback</h2>
            
            <div class="row">
                <div class="col-md-12">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-9">
                                <strong class="card-title">Feedback</strong>
                                <h5>Feedback List</h5>
                            </div>
                            {{-- <div class="col-md-3 text-right">
                                <a class="btn btn-primary" href="{{ route('districts.create') }}">Add District</a>
                            </div> --}}
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-12">
                            <div class="card shadow mb-4">
                                <div class="card-body">
                                    <div class="card-title">
                                        {{-- <h5>
                                            District List
                                        </h5> --}}
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <table class="table table-borderless table-hover">
                                                <thead>
                                                    <tr>
                                                        <th>ID</th>
                                                        <th>Customer</th>
                                                        <th>Message</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($data as $row)
                                                    <tr>
                                                        <td>{{ $row->id }}</td>
                                                        <td>{{ $row->user->name }}</td>
                                                        <td>{{ $row->message }}</td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
