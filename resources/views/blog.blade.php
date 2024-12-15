{{-- @dd($posts) --}}

@extends('layouts.main')
@section('container')

<form action="/my-post">
    @if(request('category'))
        <input type="hidden" name="category" value="{{ request('category') }}">
    @endif
    @if(request('user'))
        <input type="hidden" name="user" value="{{ request('user') }}">
    @endif
    <div class="row justify-content-center mb-3">
        <div class="col-md-6 text-center">
            <div class="input-group mb-3">
                <input type="text" class="form-control mx-1" placeholder="Search.." aria-label="Recipient's username" aria-describedby="button-addon2" name="search" value="{{ request('search') }}" style="border-radius: 5px">
                <button class="btn btn-info text-light" type="submit" id="button-addon2"><i class="bi bi-search"></i></button>
            </div>
        </div>
    </div>
</form>

@if ($posts->count())
<div class="row">
    <div class="col-md-3 text-start text-secondary mt-1 mb-3">
        <small style="font-size: 18px"><i class="bi bi-hourglass"></i> <b>result</b> {{ $post_count }} {{ ($post_count > 1) ? 'posts' : 'post' }}</small>
    </div>
</div>
<div class="card mb-3">
    <img src="{{ asset('assets/img/posts/' . $posts[0]->picture) }}"
        class="card-img-top img-fluid" alt="{{ $posts[0]->title }}" style="height: auto; max-height: 400px;">
    <div class="card-body">
        <div class="row">
            <div class="col text-start">
                <h3 class="card-title">{{ $posts[0]->title }}</h3>
            </div>
            <div class="col text-end d-flex justify-content-end align-items-center">
                <h5 class="card-title">
                    {!! $posts[0]->visibility == 'public' ? '<i class="bi bi-eye-fill"></i>' : '<i class="bi bi-eye-slash-fill"></i>' !!}
                </h5>                
            </div>
        </div>
        <h6>By
            <a href="/blog?user={{ $posts[0]->user->username }}" style="text-decoration: none">
                {{ $posts[0]->user->name }}
            </a>
            in <a href="/blog?category={{ $posts[0]->category->slug }}"
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
    <div class="col mt-3">
        <div class="card h-100 shadow">
            <img src="/assets/img/posts/{{ $post->picture }}" class="card-img-top img-fluid" alt="{{ $post->picture }}"
                style="height: auto; max-height: 250px;">
            <div class="card-body">
                <div class="row">
                    <div class="col text-start">
                        <h3 class="card-title text-primary" style="font-size: 25px">{{ $post->title }}</h3>
                    </div>
                    <div class="col text-end d-flex justify-content-end align-items-center">
                        <h5 class="card-title pt-1">
                            {!! $posts[0]->visibility == 'Public' ? '<i class="bi bi-eye-fill"></i>' : '<i class="bi bi-eye-slash-fill"></i>' !!}
                        </h5>                
                    </div>
                </div>
                <a href="/blog?category={{ $post->category->slug }}" style="text-decoration: none; color: #002e63">
                    <h6 class="card-title">{{ $post->category->name }}</h6>
                </a>
                <span class="text-secondary fs-6">
                    By <a href="/blog?user={{ $post->user->username }}" style="text-decoration: none">{{ $post->user->name }}</a>
                </span>
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

<div class="d-flex justify-content-end">
    {{ $posts->links() }}
</div>
@endsection
