@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="row">
                    <div class="col-md-12 my-4">
                        <div class="card shadow p-4">
                            <h1>Announcements</h1>

                            @if (session('success'))
                                <div class="alert alert-success">
                                    {{ session('success') }}
                                </div>
                            @elseif (session('error'))
                                <div class="alert alert-danger">
                                    {{ session('error') }}
                                </div>
                            @endif

                            @if ($announcement)
                                <div>
                                    <h2>{{ $announcement->title }}</h2>
                                    <p>{{ $announcement->description }}</p>
                                    <p class="{{ $announcement->status == '1' ? 'bg-success' : 'bg-danger' }}">Status: {{ $announcement->status == '1' ? 'Active' : 'InActive' }}</p>
                                    <div class="w-100">
                                        <img src="{{ asset('storage/') .'/' . $announcement->image }}" width="400"/>
                                    </div>
                                    <br/>
                                    <a href="{{ route('announcements.edit', $announcement->id) }}"
                                        class="btn btn-primary mt-3">Edit</a>
                                </div>
                            @else
                                <p>No announcement available.</p>
                                <a href="{{ route('announcements.create') }}" class="btn btn-success">Create
                                    Announcement</a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
