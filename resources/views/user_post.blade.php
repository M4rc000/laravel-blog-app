{{-- @dd($posts) --}}

<style>
    .card-img-top {
        width: 100%;
        /* Ensures full width */
        height: auto;
        /* Maintains aspect ratio */
        max-height: 400px;
        /* Adjust as needed for larger screens */
        object-fit: cover;
        /* Ensures image fits within the container */
    }

</style>

@extends('layouts.main')
@section('container')

@if ($posts->count())
<div class="card mb-3">
    <img src="https://images.unsplash.com/photo-1513381958995-63fd0b0c8246?q=80&w=1471&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
        class="card-img-top img-fluid" alt="{{ $posts[0]->title }}" style="height: auto; max-height: 400px;">
    <div class="card-body">
        <h3 class="card-title">{{ $posts[0]->title }}</h3>
        <h6>
            <a href="/categories/{{ $posts[0]->category->slug }}"
                style="text-decoration: none">{{ $posts[0]->category->name }}</a>
            <span class="card-text ms-3"><small
                    class="text-body-secondary">{{ $posts[0]->created_at->diffForHumans() }}</small></span>
        </h6>
        <p class="card-text">{{ $posts[0]->exerpt }}</p>
        <div class="row">
            <div class="col-md text-center">
                <a href="/blog/{{ $posts[0]->slug }}" style="text-decoration: none">
                    <button class="btn btn-primary">
                        Read more
                    </button>
                </a>
            </div>
        </div>
    </div>
</div>

<div class="row row-cols-1 row-cols-md-3 g-4 mb-4">
    @foreach ($posts->skip(1) as $post)
    <div class="col">
        <div class="card h-100">
            <img src="/assets/img/posts/{{ $post->picture }}" class="card-img-top img-fluid" alt="{{ $post->picture }}"
                style="height: auto; max-height: 250px;">
            <div class="card-body">
                <h3 class="card-title text-primary">{{ $post->title }}</h3>
                <a href="/categories/{{ $post->category->slug }}" style="text-decoration: none">
                    <h6 class="card-title">{{ $post->category->name }}</h6>
                </a>
                <p class="card-text" style="text-align: justify">{{ $post->exerpt }}</p>
                <a href="/blog/{{ $post->slug }}" style="text-decoration: none">
                    <div class="row">
                        <div class="col-md text-center">
                            <button class="btn btn-primary">
                                Read more
                            </button>
                        </div>
                    </div>
                </a>
            </div>
            <div class="card-footer">
                <small class="text-body-secondary">{{ $post->created_at->diffForHumans() }}</small>
            </div>
        </div>
    </div>
    @endforeach
</div>

@else
<p class="text-center fs-4">No post found.</p>
@endif

@endsection
