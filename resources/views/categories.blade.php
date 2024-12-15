@extends('layouts.main')
@section('container')
    <div class="row row-cols-1 row-cols-md-3 g-4 mb-3">
        @foreach ($categories as $category)
        <div class="col">
            <div class="card">
                <img src="/assets/img/profile/default.jpg" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title fs-6 text-center">{{ strtoupper($category->name) }}</h5>
                    <div class="container mt-3">
                        <div class="row">
                            <div class="col text-center">
                                <a href="/categories/{{ $category->slug }}">
                                    <button class="btn btn-success">
                                        <i class="bi bi-search"></i>
                                    </button>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <small class="text-secondary">
                        {{ $category->posts_count }} posts
                    </small>
                </div>
            </div>
        </div>
        @endforeach
    </div>
@endsection