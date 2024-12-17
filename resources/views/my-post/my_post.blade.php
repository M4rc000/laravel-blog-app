@extends('layouts.main')
@section('container')

<style>
	/* .select2-container {
		z-index: 999;
	} */

	.select2-selection {
		padding-top: 4px !important;
		height: 38px !important;
	}
</style>

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

<a href="/my-post/createPost">
    <button type="button" class="btn btn-primary my-2">New post</button>
</a>


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
                <h3 class="card-title text-primary" style="font-size: 35px">{{ $posts[0]->title }}</h3>
            </div>
            <div class="col text-end d-flex justify-content-end align-items-center">
                <h5 class="card-title">
                    {!! $posts[0]->visibility == 'public' ? '<i class="bi bi-eye-fill"></i>' : '<i class="bi bi-eye-slash-fill"></i>' !!}
                </h5>                
            </div>
        </div>
        <h6>
            <span style="color: #002e63">{{ $categories[0]->name }}</span>
        </h6>
        <p class="card-text text-secondary" style="font-size: 20px">{{ $posts[0]->exerpt }}</p>
    </div>
    <div class="card-footer">
        <div class="row">
            <div class="col text-start d-flex">
                <small class="text-dark" style="font-size: 18px">{{ $posts[0]->created_at->diffForHumans() }}</small>
            </div>
            <div class="col text-end d-flex justify-content-end">
                <a class="badge badge-primary mx-1 p-2" href="/my-post/detail/{{ $posts[0]->slug }}" style="text-decoration: none">
                    <i class="bi bi-arrow-up-right-square"></i>
                </a>
                <a class="badge badge-warning mx-1 p-2" href="#" style="text-decoration: none" data-toggle="modal" data-target="#editModal{{ $posts[0]->slug }}">
                    <i class="bi bi-pencil"></i>
                </a>
                <a class="badge badge-danger mx-1 p-2" href="#" style="text-decoration: none" data-toggle="modal" data-target="#deleteModal{{ $posts[0]->slug }}">
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
            </div>
            <div class="card-footer">
                <div class="row">
                    <div class="col text-start d-flex">
                        <small class="text-dark" style="font-size: 18px">{{ $post->created_at->diffForHumans() }}</small>
                    </div>
                    <div class="col text-end d-flex justify-content-end">
                        <a class="badge badge-primary mx-1 p-2" href="/my-post/detail/{{ $post->slug }}" style="text-decoration: none">
                            <i class="bi bi-arrow-up-right-square"></i>
                        </a>
                        <a class="badge badge-warning mx-1 p-2" href="#" style="text-decoration: none" data-toggle="modal" data-target="#editModal{{ $post->slug }}">
                            <i class="bi bi-pencil"></i>
                        </a>
                        <a class="badge badge-danger mx-1 p-2" href="#" style="text-decoration: none" data-toggle="modal" data-target="#deleteModal{{ $post->slug }}">
                            <i class="bi bi-trash"></i>
                        </a>
                    </div>
                </div>
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


<!-- DELETE MODAL -->
@foreach ($posts as $post)
<div class="modal deleteModal fade" id="deleteModal{{ $post->slug }}" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Edit post</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary">Save changes</button>
        </div>
        </div>
    </div>
</div>
@endforeach

<script src="{{ asset('assets/home/js/jquery.min.js') }}"></script>
<script>
    $(document).ready(function() {
        // $('.editModal').on('shown.bs.modal', function() {
        //     // Set the dropdown parent to the modal itself
        //     $(this).find('#category').select2({
        //         dropdownParent: $(this)
        //     });
        //     $(this).find('#status').select2({
        //         dropdownParent: $(this)
        //     });

        //     const title = $('title');
        //     const slug = $('slug');

        //     title.on('click', function(){
        //         fetch('/my-post/createSlug?tile=' + title.value)
        //         .then(response => response.json())
        //         .then(data => slug.value = data.slug)
        //     });
        // });

    });
</script>
@endsection