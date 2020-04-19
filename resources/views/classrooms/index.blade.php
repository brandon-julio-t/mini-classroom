@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <h1 class="card-header">My Classrooms</h1>

                    <div class="card-body">

                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        @if (Auth::user()->isStudent())
                            @if (empty(Auth::user()->student->classrooms->all()))
                                <p>
                                    You are not enrolled in any classroom. Contact your teacher for the classroom code.
                                </p>
                            @else
                                <table class="table table-hover table-borderless">
                                    <thead>
                                    <tr>
                                        <th scope="col">Name</th>
                                        <th scope="col">Code</th>
                                        <th scope="col">Teacher</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach (Auth::user()->student->classrooms as $classroom)
                                        <tr>
                                            <td>{{ $classroom->name }}</td>
                                            <td>{{ $classroom->code }}</td>
                                            <td>
                                                {{ $classroom->teacher->name() }}
                                                <br>
                                                <small>{{ $classroom->teacher->email() }}</small>
                                            </td>
                                            <td>
                                                <form
                                                    method="POST"
                                                    action="{{ route('classrooms.unenroll', $classroom->id) }}"
                                                    class="row justify-content-around"
                                                >
                                                    @method('DELETE')
                                                    @csrf

                                                    <a
                                                        href="{{ route('classrooms.show', $classroom->id) }}"
                                                        class="col-5 btn btn-outline-dark"
                                                    >
                                                        View
                                                    </a>
                                                    <button type="submit" class="col-5 btn btn-outline-danger">
                                                        Leave
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            @endif
                        @else
                            @if (empty(Auth::user()->teacher->classrooms->all()))
                                <p>You don't have any classroom. Create one for your students.</p>
                            @else
                                <p>Copy and share the classroom's code for your students.</p>

                                <table class="table table-hover table-borderless">
                                    <thead>
                                    <tr>
                                        <th scope="col">Name</th>
                                        <th scope="col">Code</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach (Auth::user()->teacher->classrooms as $classroom)
                                        <tr>
                                            <td>{{ $classroom->name }}</td>
                                            <td title="Copy and share me to your students!">{{ $classroom->code }}</td>
                                            <td>
                                                <form
                                                    method="POST"
                                                    action="{{ route('classrooms.destroy', $classroom->id) }}"
                                                    class="row justify-content-around"
                                                >
                                                    @method('DELETE')
                                                    @csrf

                                                    <a
                                                        href="{{ route('classrooms.show', $classroom->id) }}"
                                                        class="col-3 btn btn-outline-primary"
                                                    >
                                                        View
                                                    </a>
                                                    <button
                                                        type="button"
                                                        class="col-3 btn btn-outline-dark"
                                                        data-toggle="modal"
                                                        data-target="#edit-classroom-modal"
                                                    >
                                                        Edit
                                                    </button>
                                                    <button type="submit" class="col-3 btn btn-outline-danger">
                                                        Delete
                                                    </button>
                                                </form>

                                                {{-- Edit classroom modal pop-up --}}

                                                <div
                                                    class="modal fade"
                                                    id="edit-classroom-modal"
                                                    tabindex="-1"
                                                    role="dialog"
                                                    aria-labelledby="edit-classroom-modal-title"
                                                    aria-hidden="true"
                                                >
                                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                                        <form
                                                            method="POST"
                                                            action="{{ route('classrooms.update', $classroom->id) }}"
                                                            class="modal-content"
                                                        >
                                                            @method('PUT')
                                                            @csrf

                                                            <div class="modal-header">
                                                                <h2 class="modal-title" id="edit-classroom-modal-title">
                                                                    Edit Classroom
                                                                </h2>

                                                                <button
                                                                    type="button"
                                                                    class="close"
                                                                    data-dismiss="modal"
                                                                    aria-label="Close"
                                                                >
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>

                                                            <div class="modal-body form-group">
                                                                <label for="classroom_name">Classroom Name</label>
                                                                <input
                                                                    type="text"
                                                                    name="classroom_name"
                                                                    id="classroom_name"
                                                                    class="form-control"
                                                                >
                                                            </div>

                                                            <div class="modal-footer justify-content-center">
                                                                <div class="btn-group">
                                                                    <button
                                                                        type="submit"
                                                                        class="btn btn-outline-primary"
                                                                    >
                                                                        Submit
                                                                    </button>
                                                                    <button
                                                                        type="button"
                                                                        class="btn btn-outline-secondary"
                                                                        data-dismiss="modal"
                                                                    >
                                                                        Cancel
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            @endif
                        @endif

                        <div class="d-flex justify-content-center">
                            @if (Auth::user()->isStudent())

                                {{-- Add classroom for student --}}

                                <button
                                    type="button"
                                    class="btn btn-outline-dark"
                                    data-toggle="modal"
                                    data-target="#add-classroom-modal"
                                >
                                    Add Classroom
                                </button>

                                {{-- Add classroom modal pop-up --}}

                                <div
                                    class="modal fade"
                                    id="add-classroom-modal"
                                    tabindex="-1"
                                    role="dialog"
                                    aria-labelledby="add-classroom-modal-title"
                                    aria-hidden="true"
                                >
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <form
                                            method="POST"
                                            action="{{ route('classrooms.enroll') }}"
                                            class="modal-content"
                                        >
                                            @csrf

                                            <div class="modal-header">
                                                <h2 class="modal-title" id="add-classroom-modal-title">
                                                    Add Classroom
                                                </h2>

                                                <button
                                                    type="button"
                                                    class="close"
                                                    data-dismiss="modal"
                                                    aria-label="Close"
                                                >
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>

                                            <div class="modal-body form-group">
                                                <label for="classroom_code">Classroom Code</label>
                                                <input
                                                    type="text"
                                                    name="classroom_code"
                                                    id="classroom_code"
                                                    class="form-control"
                                                >
                                            </div>

                                            <div class="modal-footer justify-content-center">
                                                <div class="btn-group">
                                                    <button type="submit" class="btn btn-outline-primary">Add</button>
                                                    <button
                                                        type="button"
                                                        class="btn btn-outline-secondary"
                                                        data-dismiss="modal"
                                                    >
                                                        Cancel
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            @else

                                {{-- Create classroom for teacher --}}

                                <a
                                    href="{{ route('classrooms.create') }}"
                                    class="btn btn-outline-dark"
                                    data-toggle="modal"
                                    data-target="#create-classroom-modal"
                                >
                                    Create Classroom
                                </a>

                                {{-- Create classroom pop-up --}}

                                <div
                                    class="modal fade"
                                    id="create-classroom-modal"
                                    tabindex="-1"
                                    role="dialog"
                                    aria-labelledby="create-classroom-modal-title"
                                    aria-hidden="true"
                                >
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <form method="POST"
                                              action="{{ route('classrooms.store') }}"
                                              class="modal-content"
                                        >
                                            @csrf

                                            <div class="modal-header">
                                                <h2 class="modal-title" id="create-classroom-modal-title">
                                                    Create Classroom
                                                </h2>

                                                <button
                                                    type="button"
                                                    class="close"
                                                    data-dismiss="modal"
                                                    aria-label="Close"
                                                >
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>

                                            <div class="modal-body form-group">
                                                <label for="classroom_name">Classroom Name</label>
                                                <input
                                                    type="text"
                                                    name="classroom_name"
                                                    id="classroom_name"
                                                    class="form-control"
                                                >
                                            </div>

                                            <div class="modal-footer justify-content-center">
                                                <div class="btn-group">
                                                    <button type="submit" class="btn btn-outline-primary">
                                                        Submit
                                                    </button>
                                                    <button type="button" class="btn btn-outline-dark"
                                                            data-dismiss="modal"
                                                    >
                                                        Cancel
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            @endif
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
