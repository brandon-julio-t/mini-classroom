@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Register') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('register') }}">
                            @csrf

                            {{-- Name --}}

                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                                <div class="col-md-6">
                                    <input id="name" type="text"
                                           class="form-control @error('name') is-invalid @enderror" name="name"
                                           value="{{ old('name') }}" required autocomplete="name" autofocus>

                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            {{-- Email --}}

                            <div class="form-group row">
                                <label for="email"
                                       class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                                <div class="col-md-6">
                                    <input id="email" type="email"
                                           class="form-control @error('email') is-invalid @enderror" name="email"
                                           value="{{ old('email') }}" required autocomplete="email">

                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            {{-- Date of Birth --}}

                            <div class="form-group row">
                                <label for="date_of_birth"
                                       class="col-md-4 col-form-label text-md-right">{{ __('Date of Birth') }}</label>

                                <div class="col-md-6">
                                    <input id="date_of_birth" type="date"
                                           class="form-control @error('date_of_birth') is-invalid @enderror"
                                           name="date_of_birth" value="{{ old('date_of_birth') }}" required
                                           autocomplete="bday">

                                    @error('date_of_birth')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            {{-- Gender --}}

                            <div class="form-group row">
                                <label for="gender"
                                       class="col-md-4 col-form-label text-md-right pt-0">{{ __('Gender') }}</label>

                                <div class="col-md-6">
                                    <div class="form-check">
                                        <input id="gender" type="radio"
                                               class="form-check-input @error('gender') is-invalid @enderror"
                                               name="gender" value="Male" required>
                                        <label for="gender" class="form-check-label">Male</label>
                                    </div>
                                    <div class="form-check">
                                        <input id="gender" type="radio"
                                               class="form-check-input @error('gender') is-invalid @enderror"
                                               name="gender" value="Female" required>
                                        <label for="gender" class="form-check-label">Female</label>
                                    </div>

                                    @error('gender')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            {{-- Role --}}

                            <div class="form-group row">
                                <label for="role"
                                       class="col-md-4 col-form-label text-md-right pt-0">{{ __('Role') }}</label>

                                <div class="col-md-6">
                                    <div class="form-check">
                                        <input id="role" type="radio"
                                               class="form-check-input @error('role') is-invalid @enderror"
                                               name="role" value="Student" required>
                                        <label for="role" class="form-check-label">Student</label>
                                    </div>
                                    <div class="form-check">
                                        <input id="role" type="radio"
                                               class="form-check-input @error('role') is-invalid @enderror"
                                               name="role" value="Teacher" required>
                                        <label for="role" class="form-check-label">Teacher</label>
                                    </div>

                                    @error('role')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            {{-- Password --}}

                            <div class="form-group row">
                                <label for="password"
                                       class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                                <div class="col-md-6">
                                    <input id="password" type="password"
                                           class="form-control @error('password') is-invalid @enderror" name="password"
                                           required autocomplete="new-password">

                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password-confirm"
                                       class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                                <div class="col-md-6">
                                    <input id="password-confirm" type="password" class="form-control"
                                           name="password_confirmation" required autocomplete="new-password">
                                </div>
                            </div>

                            {{-- Submit --}}

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Register') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
