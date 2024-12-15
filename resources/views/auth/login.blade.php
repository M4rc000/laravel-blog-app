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
                    @if(@session()->has('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif
                    @if(@session()->has('loginError'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ session('loginError') }}
                        </div>
                    @endif
                    <div class="mb-4">
                        <h3>Sign In</h3>
                        <p class="mb-4">Be awesome, be powerful and be grateful.</p>
                    </div>
                    <form action="/auth/login" method="post">
                        @csrf
                        <div class="form-group first">
                            <label class="pt-3 pb-5" for="username">Username</label>
                            <input type="text" class="form-control pt-4 @error('username')
                                is-invalid
                            @enderror" id="username" name="username" required autofocus>
                        </div>

                        @error('username')
                            <small class="text-danger pt-3 pb-1">
                                {{ $message }}
                            </small>
                        @enderror

                        <div class="form-group last mb-4 mt-2">
                            <label class="pt-3 pb-5" for="password">Password</label>
                            <input type="password" class="form-control pt-4 @error('password')
                                is-invalid
                            @enderror" id="password" name="password" required>
                        </div>

                        @error('password')
                            <small class="text-danger pt-3 pb-1">
                                {{ $message }}
                            </small>
                        @enderror

                        {{-- <div class="d-flex mb-5 align-items-center">
                    <label class="control control--checkbox mb-0"><span class="caption">Remember me</span>
                    <input type="checkbox" checked="checked"/>
                    <div class="control__indicator"></div>
                    </label>
                    <span class="ml-auto"><a href="{{ asset('assets/auth/#" class="forgot-pass">Forgot Password')}}</a></span>
                </div> --}}

                <button type="submit" class="btn btn-block btn-primary">Login</button>

                {{-- <span class="d-block text-left my-4 text-muted">&mdash; or login with &mdash;</span> --}}

                {{-- <div class="social-login">
                    <a href="{{ asset('assets/auth/#" class="facebook')}}">
                <span class="icon-facebook mr-3"></span>
                </a>
                <a href="{{ asset('assets/auth/#" class="twitter')}}">
                    <span class="icon-twitter mr-3"></span>
                </a>
                <a href="{{ asset('assets/auth/#" class="google')}}">
                    <span class="icon-google mr-3"></span>
                </a>
            </div> --}}
            </form>
            <small class="d-block text-center mt-3">Haven't register yet? <a
                    href="{{ url('auth/register') }}">Register now!</a></small>
        </div>
    </div>
@endsection

<script src="{{ asset('assets/auth/js/jquery-3.3.1.min.js')}}"></script>
<script>
    $(document).ready(function(){
        // Check if the alert exists
        if ($('.alert').length) {
            // Set a timeout to fade out and remove the alert
            setTimeout(function() {
                $('.alert').fadeOut('slow', function() {
                    $(this).remove(); // Remove the element from the DOM
                });
            }, 5000); // 5000ms = 5 seconds
        }
    });
</script>
