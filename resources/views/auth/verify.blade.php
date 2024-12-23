@extends('layouts.app')

@section('container')
    <div class="container">
        @if (session('status') == 'verification-link-sent')
            <div class="alert alert-success" role="alert">
                A new verification link has been sent to your email address.
            </div>
        @endif

        <h2>Please check your email for the verification link!</h2>
    </div>
@endsection


<script>
    $(document).ready(function() {
        @if (session()->has('success_registration'))   
            Swal.fire({
                title: "Success",
                text: "{{ session('success_registration') }}",
                icon: "success"
            });
        @endif
    });
</script>
@endsection