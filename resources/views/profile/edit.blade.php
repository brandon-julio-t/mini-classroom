@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <h1 class="card-header">Edit Profile</h1>

                    <div class="card-body">

                        <form method="POST" action="{{ route('profile.update', Auth::id()) }}">
                            @method('PUT')
                            @csrf

                            {{-- Name --}}

                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                                <div class="col-md-6">
                                    <input id="name" type="text"
                                           class="form-control @error('name') is-invalid @enderror" name="name"
                                           value="{{ Auth::user()->name }}" required autocomplete="name" autofocus>

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
                                           value="{{ Auth::user()->email }}" required autocomplete="email">

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
                                           name="date_of_birth" value="{{ Auth::user()->date_of_birth }}" required
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
                                               name="gender" value="Male"
                                               required {{ Auth::user()->gender == 'Male' ? 'checked' : null }}>
                                        <label for="gender" class="form-check-label">Male</label>
                                    </div>
                                    <div class="form-check">
                                        <input id="gender" type="radio"
                                               class="form-check-input @error('gender') is-invalid @enderror"
                                               name="gender" value="Female"
                                               required {{ Auth::user()->gender == 'Female' ? 'checked' : null }}>
                                        <label for="gender" class="form-check-label">Female</label>
                                    </div>

                                    @error('gender')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            {{-- Submit --}}

                            <div class="d-flex justify-content-center">
                                <div class="btn-group">
                                    <button type="submit" class="btn btn-outline-primary">{{ __('Submit') }}</button>
                                    <a href="{{ url()->previous() }}" class="btn btn-outline-dark">Cancel</a>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
