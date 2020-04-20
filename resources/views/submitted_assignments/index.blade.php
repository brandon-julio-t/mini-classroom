@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <h1 class="card-header">{{ $assignment->title }}</h1>

                    <div class="card-body">

                        <table class="table table-hover table-borderless">
                            <thead>
                            <tr>
                                <th scope="col">Student Name</th>
                                <th scope="col">Student ID</th>
                                <th scope="col">Submission Date</th>
                                <th scope="col">Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse ($assignment->submittedAssignments as $answer)
                                <tr>
                                    <td>{{ $answer->student->user->name }}</td>
                                    <td>{{ $answer->student->id }}</td>
                                    <td>{{ $answer->created_at }}</td>
                                    <td>
                                        <a href="{{ Storage::url($answer->path) }}" class="btn btn-outline-dark">
                                            Download
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <p>No answers have been submitted. Give you students a little more time?</p>
                            @endforelse
                            </tbody>
                        </table>

                        <div class="row justify-content-center">
                            <a href="{{ url()->previous() }}" class="col-11 btn btn-outline-dark">Back</a>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
