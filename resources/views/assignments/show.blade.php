@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <h1 class="card-header">{{ $assignment->title }}</h1>

                    <div class="card-body">

                        <h2>Posted by: {{ $assignment->teacher->name() }}</h2>
                        <h3>Classroom: {{ $classroom->name }}</h3>
                        <p>
                            Created at: {{ $assignment->created_at }}
                            <br>
                            Updated at: {{ $assignment->updated_at }}
                        </p>
                        <p class="lead">Due at: {{ $assignment->due }}</p>

                        <h2>Instructions</h2>
                        <div>{!! nl2br(e($assignment->body)) !!}</div>

                        <br>

                        @if (Auth::user()->isStudent())
                            <div class="row justify-content-around">
                                <a
                                    href="{{ route('assignments.submitted.create', [$classroom]) }}"
                                    class="col-3 btn btn-outline-dark @if (Carbon\Carbon::parse($assignment->due)->isPast()) disabled @endif">
                                    Submit Answer
                                </a>
                                <a href="{{ url()->previous() }}" class="col-3 btn btn-outline-dark">Back</a>
                                @if (is_null(Auth::user()->student->submittedAssignments->firstWhere('assignment_id', $assignment->id)))
                                    <button class="col-3 btn btn-outline-dark disabled">
                                        No Answer
                                    </button>
                                @else
                                    <a
                                        href="{{ Storage::url(Auth::user()->student->submittedAssignments->firstWhere('assignment_id', $assignment->id)->path) }}"
                                        class="col-3 btn btn-outline-dark">
                                        Download Answer
                                    </a>
                                @endif
                            </div>
                        @else
                            <form
                                method="POST"
                                action="{{ route('classrooms.assignments.destroy', [$classroom, $assignment]) }}"
                                class="row justify-content-around"
                            >
                                @method('DELETE')
                                @csrf

                                <a
                                    href="{{ route('classrooms.assignments.edit', [$classroom, $assignment]) }}"
                                    class="col-2 btn btn-outline-dark d-flex justify-content-center align-items-center"
                                >
                                    Edit
                                </a>
                                <a
                                    href="{{ route('assignments.submitted.index', $assignment) }}"
                                    class="col-2 btn btn-outline-dark d-flex justify-content-center align-items-center"
                                >
                                    View All Answers
                                </a>
                                <button
                                    type="submit"
                                    class="col-2 btn btn-outline-danger"
                                >
                                    Delete
                                </button>
                                <a
                                    href="{{ url()->previous() }}"
                                    class="col-2 btn btn-outline-dark d-flex justify-content-center align-items-center"
                                >
                                    Back
                                </a>
                            </form>
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
