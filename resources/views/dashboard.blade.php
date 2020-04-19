@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <h1 class="card-header">Dashboard</h1>

                    <div class="card-body">

                        <h2>
                            Hello,
                            <br>
                            {{ Auth::user()->name }}
                        </h2>
                        <p>
                            {{ Auth::user()->email }}
                            <br>
                            @if (Auth::user()->isStudent())
                                Your student ID: {{ Auth::user()->student->id }}
                            @else
                                Your teacher ID: {{ Auth::user()->teacher->id }}
                            @endif
                        </p>

                        @if (!Auth::user()->hasVerifiedEmail())
                            <p>
                                You haven't verified your email.
                                <a href="{{ route('verification.notice') }}">Verify now</a>
                                <br>
                                <small>Note: This is just a mock. No email will be sent.</small>
                            </p>
                        @endif

                        <div class="d-flex justify-content-center">
                            <div class="btn-group">
                                <a href="{{ route('profile.index') }}" class="btn btn-outline-dark">My Profile</a>
                                <a
                                    href="{{ route('assignments.all') }}"
                                    class="btn btn-outline-dark">
                                    My Assignments
                                </a>
                                <a href="{{ route('classrooms.index') }}"
                                   class="btn btn-outline-dark"
                                >
                                    My Classrooms
                                </a>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
