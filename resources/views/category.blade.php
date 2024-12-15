@extends('layouts.main')
@section('container')
<div class="card shadow-sm mb-5 pt-1">
    <div class="card-body">
        <div class="row justify-content-center ">
            <div class="col text-center">
                <h5 class="fs-6 fw-bold">{{ strtoupper($category) }}</h5>
            </div>
        </div>
    </div>
</div>

<div class="row row-cols-1 row-cols-md-3 g-4 mb-4">
    @foreach ($posts as $post)
    <div class="col">
        <div class="card h-100">
            <img src="/assets/img/posts/{{ $post->picture }}" class="card-img-top img-fluid" alt="{{ $post->picture }}"
                style="height: auto; max-height: 250px;">
            <div class="card-body">
                <h3 class="card-title text-primary text-center fs-4 mb-3">{{ $post->title }}</h3>
                <span class="text-secondary fs-6">
                    By {{ $post->user->name }}
                </span>
                <p class="card-text fs-6" style="text-align: justify">{{ $post->exerpt }}</p>
                <div class="row">
                    <div class="col-md text-center">
                        <a href="/blog/{{ $post->slug }}" style="text-decoration: none">
                            <button class="btn btn-primary">
                                Read more
                            </button>
                        </a>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <small class="text-body-secondary">{{ $post->created_at->diffForHumans() }}</small>
            </div>
        </div>
    </div>
    @endforeach
</div>

<a href="/categories" style="text-decoration: none">
    <button class="mb-5 btn btn-primary">
        Back to categories
    </button>
</a>
@endsection
