@extends('layouts.main')
@section('container')
    <div class="card mb-3" style="max-width: 540px;">
        <div class="row g-0">
        <div class="col-md-4">
            <img src="{{ asset('storage') . '/' . $user->picture }}" class="img-fluid rounded-start" alt="{{ $user->picture }}">
        </div>
        <div class="col-md-8">
            <div class="card-body">
                <h5 class="card-title">{{ $user->name }}</h5>
                <h6 class="card-text">@ {{ $user->username }}</h6>
            <p class="card-text">{{ $user->email }}</p>
            <p class="card-text"><small class="text-body-secondary">Joined {{ date('d M Y', strtotime($user->created_at)) }}</small></p>
            </div>
        </div>
        </div>
    </div>
@endsection