{{-- @dd($posts) --}}

@extends('layouts.main')
@section('container')

<form action="/my-post/{{ ($category == 'all' ? 'all' : $category->slug) }}">
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
        <small style="font-size: 18px"><i class="bi bi-hourglass"></i> <b>result</b> {{ $posts->count() }} {{ ($posts->count() > 1) ? 'posts' : 'post' }}</small>
    </div>
</div>
<div class="card mb-3">
    <img src="{{ asset('assets/img/posts/' . $posts[0]->picture) }}"
        class="card-img-top img-fluid" alt="{{ $posts[0]->title }}" style="height: auto; max-height: 400px;">
    <div class="card-body">
        <div class="row">
            <div class="col text-start">
                <h3 class="card-title" style="font-size: 35px">{{ $posts[0]->title }}</h3>
            </div>
            <div class="col text-end d-flex justify-content-end align-items-center">
                <h5 class="card-title">
                    {!! $posts[0]->visibility == 'public' ? '<i class="bi bi-eye-fill"></i>' : '<i class="bi bi-eye-slash-fill"></i>' !!}
                </h5>                
            </div>
        </div>
        <h6>
            <span class="text-primary" style="font-size: 24px">{{ $categories[0]->name }}</span>
        </h6>
        <p class="card-text" style="font-size: 20px">{{ $posts[0]->exerpt }}</p>
    </div>
    <div class="card-footer">
        <div class="row">
            <div class="col text-start d-flex">
                <small class="text-body-secondary" style="font-size: 18px">{{ $posts[0]->created_at->diffForHumans() }}</small>
            </div>
            <div class="col text-end d-flex justify-content-end">
                <a class="badge badge-primary mx-1 p-2" href="/blog/{{ $posts[0]->slug }}" style="text-decoration: none">
                    <i class="bi bi-arrow-up-right-square"></i>
                </a>
                <a class="badge badge-warning mx-1 p-2" href="/blog/{{ $posts[0]->slug }}" style="text-decoration: none">
                    <i class="bi bi-pencil"></i>
                </a>
                <a class="badge badge-danger mx-1 p-2" href="/blog/{{ $posts[0]->slug }}" style="text-decoration: none">
                    <i class="bi bi-trash"></i>
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
