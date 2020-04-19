@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <h1 class="card-header">Create Assignment</h1>

                    <div class="card-body">

                        <h2>Class: {{ $classroom->name }}</h2>

                        <form
                            method="POST"
                            action="{{ route('classrooms.assignments.update', [$classroom, $assignment]) }}"
                        >
                            @method('PUT')
                            @csrf

                            <div class="form-group">
                                <label for="title">Title</label>
                                <input
                                    class="form-control"
                                    type="text"
                                    name="title"
                                    id="title"
                                    value="{{ old('title') ?? $assignment->title }}"
                                    required
                                    autocomplete="on"
                                >
                            </div>

                            <div class="form-group">
                                <label for="body">Instruction for your students</label>
                                <textarea
                                    class="form-control @error('body') is-invalid @enderror"
                                    name="body"
                                    id="body"
                                    cols="30"
                                    rows="10"

                                    required
                                    autocomplete="on"
                                >{{ old('body') ?? $assignment->body }}</textarea>

                                @error('body')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>

                            <div class="form-group row">
                                <label class="col-md-2 col-form-label" for="due">Due date</label>
                                <div class="col-md-4">
                                    <input
                                        class="form-control @error('due') is-invalid @enderror"
                                        type="date"
                                        name="due"
                                        id="due"
                                        required
                                        autocomplete="off"
                                        value="{{ old('due') ?? date('Y-m-d', strtotime($assignment->due)) }}"
                                    >

                                    @error('due')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>


                            </div>

                            <div class="form-group row justify-content-around">
                                <button type="submit" class="col-5 btn btn-outline-primary">Submit</button>
                                <a href="{{ url()->previous() }}" class="col-5 btn btn-outline-dark">Back</a>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
