@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col">
                <div class="card">
                    <h1 class="card-header">My Assignments</h1>

                    <div class="card-body">

                        <table class="table table-hover table-borderless">
                            <thead>
                            <tr>
                                <th scope="col">Title</th>
                                <th scope="col">Classroom</th>
                                <th scope="col">Last Updated</th>
                                <th scope="col">Due Date</th>
                                <th scope="col">Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if (Auth::user()->isStudent())
                                @forelse (Auth::user()->student->classrooms as $classroom)
                                    @forelse ($classroom->assignments as $assignment)
                                        @if (Carbon\Carbon::parse($assignment->due)->isFuture())
                                            <tr>
                                                <td>{{ $assignment->title }}</td>
                                                <td>{{ $assignment->classroom->name }}</td>
                                                <td>{{ $assignment->updated_at }}</td>
                                                <td>{{ $assignment->due }}</td>
                                                <td>
                                                    <div class="row justify-content-around">
                                                        <a
                                                            href="{{ route('classrooms.assignments.show', [$classroom, $assignment]) }}"
                                                            class="col-3 btn btn-outline-dark d-flex align-items-center justify-content-center"
                                                        >
                                                            View
                                                        </a>
                                                        <a
                                                            href="{{ route('assignments.submitted.create', [$assignment]) }}"
                                                            class="col-3 btn btn-outline-dark @if (Carbon\Carbon::parse($assignment->due)->isPast()) disabled @endif">
                                                            Submit Answer
                                                        </a>
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
                                                </td>
                                            </tr>
                                        @endif
                                    @empty
                                        <p>No assignment for today. Enjoy your day!</p>
                                    @endforelse
                                @empty
                                    <p>
                                        You are not enrolled in any classroom.
                                        Contact your teacher for the classroom code.
                                    </p>
                                @endforelse
                            @else
                                @forelse (Auth::user()->teacher->assignments as $assignment)
                                    <tr>
                                        <td>{{ $assignment->title }}</td>
                                        <td>{{ $assignment->classroom->name }}</td>
                                        <td>{{ $assignment->updated_at }}</td>
                                        <td>{{ $assignment->due }}</td>
                                        <td>
                                            <form
                                                method="POST"
                                                action="{{ route('classrooms.assignments.destroy', [$assignment->classroom, $assignment]) }}"
                                                class="row justify-content-around"
                                            >
                                                @method('DELETE')
                                                @csrf

                                                <a
                                                    href="{{ route('classrooms.assignments.show', [$assignment->classroom, $assignment]) }}"
                                                    class="col-4 btn btn-outline-primary"
                                                >
                                                    View
                                                </a>
                                                <a
                                                    href="{{ route('classrooms.assignments.edit', [$assignment->classroom, $assignment]) }}"
                                                    class="col-4 btn btn-outline-dark"
                                                >
                                                    Edit
                                                </a>
                                                <button
                                                    type="submit"
                                                    class="col-4 btn btn-outline-danger"
                                                >
                                                    Delete
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <p>No assignment for this class. Let the students be free for a little longer?</p>
                                @endforelse
                            @endif
                            </tbody>
                        </table>

                        <div class="row justify-content-center">
                            <a href="{{ route('home') }}" class="col-11 btn btn-outline-dark">Back</a>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
