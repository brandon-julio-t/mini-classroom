@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-8">
                <div class="card">
                    <h1 class="card-header">Profile</h1>

                    <div class="card-body">

                        <div class="row">
                            <strong class="col-4 text-right">Name</strong>
                            <p class="col-6">{{ Auth::user()->name }}</p>
                        </div>
                        <div class="row">
                            @if (Auth::user()->isStudent())
                                <strong class="col-4 text-right">Student ID</strong>
                                <p class="col-6">{{ Auth::user()->student->id }}</p>
                            @else
                                <strong class="col-4 text-right">Teacher ID</strong>
                                <p class="col-6">{{ Auth::user()->teacher->id }}</p>
                            @endif
                        </div>
                        <div class="row">
                            <strong class="col-4 text-right">Email</strong>
                            <p class="col-6">{{ Auth::user()->email }}</p>
                        </div>
                        <div class="row">
                            <strong class="col-4 text-right">Gender</strong>
                            <p class="col-6">{{ Auth::user()->gender }}</p>
                        </div>
                        <div class="row">
                            <strong class="col-4 text-right">Date of Birth</strong>
                            <p class="col-6">{{ Auth::user()->date_of_birth }}</p>
                        </div>

                        <form method="POST" action="{{ route('profile.destroy', Auth::id()) }}"
                              class="d-flex justify-content-center">
                            @method('DELETE')
                            @csrf

                            <div class="btn-group">
                                <a href="{{ route('profile.edit', Auth::id()) }}" class="btn btn-outline-dark">Edit</a>
                                <a href="{{ route('password.request') }}" class="btn btn-outline-dark">
                                    Reset Password
                                </a>
                                <button type="submit" class="btn btn-outline-danger">
                                    @if (Auth::user()->isStudent())
                                        Drop Out
                                    @else
                                        Resign
                                    @endif
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
