@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <h1 class="card-header">Submit Answer</h1>

                    <div class="card-body">

                        <h2>Classroom Name: {{ $assignment->classroom->name }}</h2>
                        <h2>Assignment Title: {{ $assignment->title }}</h2>

                        <h3>Answer file requirement</h3>
                        <ul>
                            <li>Microsoft Office and PDF only</li>
                            <li>Make sure your identity is in the file. If not, you can resubmit.</li>
                            <li>Multiple file? ZIP them.</li>
                            <li>Non-text file (video / image)? Send link.</li>
                        </ul>

                        <form
                            method="POST"
                            action="{{ route('assignments.submitted.store', $assignment) }}"
                            enctype="multipart/form-data"
                        >
                            @csrf

                            <div class="form-group">
                                <label for="answer">Answer File</label>
                                <input
                                    type="file"
                                    name="answer"
                                    id="answer"
                                    class="form-control-file @error('answer') is-invalid @enderror"
                                    accept=".pdf,.docx,.pptx,.xlsx,.zip"
                                    required
                                >

                                @error('answer')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>

                                <div class="form-group row justify-content-around">
                                <button type="submit" class="col-5 btn btn-outline-primary">Post Answer</button>
                                <a href="{{ url()->previous() }}" class="col-5 btn btn-outline-dark">Back</a>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

