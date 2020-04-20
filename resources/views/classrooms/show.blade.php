@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col">
                <div class="card">
                    <h1 class="card-header">{{ $classroom->name }}</h1>

                    <div class="card-body">

                        <h2>
                            Teacher: {{ ($classroom->teacher->gender() == 'Male' ? 'Mr' : 'Ms') }}.
                            {{ $classroom->teacher->name() }}
                        </h2>
                        <p>
                            Email: {{ $classroom->teacher->email() }}
                            <br>
                            Teacher ID: {{ $classroom->teacher->id }}
                        </p>

                        <h2>Assignments</h2>
                        <table class="table table-hover table-borderless">
                            <thead>
                            <tr>
                                <th scope="col">Title</th>
                                <th scope="col">Due Date</th>
                                <th scope="col">Last Updated</th>
                                <th scope="col">Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($classroom->assignments as $assignment)
                                <tr>
                                    <td>{{ $assignment->title }}</td>
                                    <td>{{ $assignment->due }}</td>
                                    <td>{{ $assignment->updated_at }}</td>
                                    <td>
                                        @if (Auth::user()->isStudent())
                                            <div class="row justify-content-around">
                                                <a
                                                    href="{{ route('classrooms.assignments.show', [$classroom, $assignment]) }}"
                                                    class="col-3 btn btn-outline-dark d-flex align-items-center justify-content-center"
                                                >
                                                    View
                                                </a>
                                                <a
                                                    href="{{ route('assignments.submitted.create', [$assignment]) }}"
                                                    class="col-3 btn btn-outline-dark">
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
                                        @else
                                            <form
                                                method="POST"
                                                action="{{ route('classrooms.assignments.destroy', [$classroom, $assignment]) }}"
                                                class="row justify-content-around"
                                            >
                                                @method('DELETE')
                                                @csrf

                                                <a
                                                    href="{{ route('classrooms.assignments.show', [$classroom, $assignment]) }}"
                                                    class="col-3 btn btn-outline-dark d-flex justify-content-center align-items-center"
                                                >
                                                    View
                                                </a>
                                                <a
                                                    href="{{ route('classrooms.assignments.edit', [$classroom, $assignment]) }}"
                                                    class="col-3 btn btn-outline-dark d-flex justify-content-center align-items-center"
                                                >
                                                    Edit
                                                </a>
                                                <a
                                                    href="{{ route('assignments.submitted.index', $assignment) }}"
                                                    class="col-3 btn btn-outline-dark"
                                                >
                                                    View All Answers
                                                </a>
                                                <button
                                                    type="submit"
                                                    class="col-3 btn btn-outline-danger"
                                                >
                                                    Delete
                                                </button>
                                            </form>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <p>
                                    No assignment for this class.
                                    @if (Auth::user()->isStudent())
                                        Enjoy your day!
                                    @else
                                        Let the students be free for a little longer?
                                    @endif
                                </p>
                            @endforelse
                            </tbody>
                        </table>

                        @if (!Auth::user()->isStudent())
                            <form
                                method="POST"
                                action="{{ route('classrooms.destroy', $classroom->id) }}"
                                class="row justify-content-around"
                            >
                                @method('DELETE')
                                @csrf
                                <a
                                    href="{{ route('classrooms.assignments.create', $classroom) }}"
                                    class="col-5 btn btn-outline-dark"
                                >
                                    Create Assignment
                                </a>

                                <button type="submit" class="col-5 btn btn-outline-danger">Delete Classroom</button>
                            </form>
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
