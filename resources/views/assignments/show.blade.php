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
                                <a href="#" class="col-5 btn btn-outline-primary">Submit Answer</a>
                                <a href="{{ url()->previous() }}" class="col-5 btn btn-outline-dark">Back</a>
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
                                    class="col-3 btn btn-outline-dark"
                                >
                                    Edit
                                </a>
                                <button
                                    type="submit"
                                    class="col-3 btn btn-outline-danger"
                                >
                                    Delete
                                </button>
                                <a href="{{ url()->previous() }}" class="col-3 btn btn-outline-dark">Back</a>
                            </form>
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
