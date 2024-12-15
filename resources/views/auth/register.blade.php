@extends('layouts.auth')
@section('container')
<style>
    label{
        font-weight: 500;
        font-size: 13px !important;
    }
</style>
<div class="row">
    <div class="col-md-5">
        <img src="{{ asset('assets/auth/images/undraw_remotely_2j6y.svg')}}" alt="Image" class="img-fluid">
    </div>
    <div class="col-md-7 contents">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="mb-4">
                    <h3>Sign Up</h3>
                    <p class="mb-4">Be awesome, be powerful and be grateful.</p>
                </div>
                <form action="/auth/register" method="post">
                    @csrf
                    <!-- Name Field -->
                    <div class="form-group first">
                        <label class="pt-3 pb-5" for="name">Name</label>
                        <input type="text" class="form-control pt-4 @error('name') is-invalid @enderror" id="name"
                            name="name" value="{{ old('name') }}" required>
                    </div>

                    @error('name')
                    <small class="text-danger pt-3 pb-1">
                        {{ $message }}
                    </small>
                    @enderror

                    <!-- Username Field -->
                    <div class="form-group first mt-2">
                        <label class="pt-3 pb-5" for="username">Username</label>
                        <input type="text" class="form-control pt-4 @error('username') is-invalid @enderror"
                            id="username" name="username" value="{{ old('username') }}" required>
                    </div>

                    @error('username')
                    <small class="text-danger pt-3 pb-1">
                        {{ $message }}
                    </small>
                    @enderror

                    <!-- Email Field -->
                    <div class="form-group first mt-2">
                        <label class="pt-3 pb-5" for="email">Email</label>
                        <input type="email" class="form-control pt-4 @error('email') is-invalid @enderror" id="email"
                            name="email" value="{{ old('email') }}" required>
                    </div>

                    @error('email')
                    <small class="text-danger pt-3 pb-1">
                        {{ $message }}
                    </small>
                    @enderror

                    <!-- Password Field -->
                    <div class="form-group last mt-2">
                        <label class="pt-3 pb-5" for="password">Password</label>
                        <input type="password" class="form-control pt-4 @error('password') is-invalid @enderror"
                            id="password" name="password" required>
                    </div>

                    @error('password')
                    <small class="text-danger pt-3 pb-1">
                        {{ $message }}
                    </small>
                    @enderror

                    <!-- Submit Button -->
                    <button type="submit" class="btn btn-block btn-primary mt-4">Register</button>
                </form>
                <small class="d-block text-center mt-3">Already have an account? <a href="/">Login here!</a></small>
            </div>
        </div>

    </div>
</div>
@endsection