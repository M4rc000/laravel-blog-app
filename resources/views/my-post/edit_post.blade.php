@extends('layouts.main')
@section('container')

<style>
	.select2-selection {
		padding-top: 4px !important;
		height: 38px !important;
	}

    label{
        font-weight: bold;
    }
</style>

<form action="/my-post/updatePost/{{ $post->slug }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="row mt-3">
        <label for="title" class="col-12 col-md-1 col-form-label text-md-end">Picture</label>
        <div class="col-12 col-md-5">
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="inputGroupFileAddon01">Upload</span>
                </div>
                <div class="custom-file">
                    <input type="hidden" name="oldPostImage" id="oldPostImage" value="{{ $post->picture }}">
                    <input type="file" class="custom-file-input @error('picture') is-invalid @enderror" id="picture" name="picture" aria-describedby="inputGroupFileAddon01" accept="image/*" onchange="preview_image()">
                    <label class="custom-file-label" for="picture">
                        @if ($post->picture)
                            {{ basename($post->picture) }}
                        @else
                            Choose file
                        @endif
                    </label>                                            
                </div>
            </div>
            @error('picture')
                <small class="text-danger pt-3 pb-1">
                    {{ $message }}
                </small>
            @enderror
            <div class="col-12 p-2 my-2 preview-container shadow" style="border-radius: 10px">
                <img id="imagePreview" src="{{ asset('storage') . '/' . ($post->picture == '' ? 'post-img/no-preview.png' : $post->picture) }}" alt="Preview" class="img-fluid rounded preview-image" style="background-color: white; border-radius: 10px; border: 1.5px solid grey">
            </div>
        </div>
    </div>
    
    <div class="row mt-3">
        <label for="title" class="col-12 col-md-1 col-form-label text-md-end">Title</label>
        <div class="col-12 col-md-10">
            <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('slug', $post->title) }}" required autofocus>
            @error('title')
                <small class="text-danger pt-3 pb-1">
                    {{ $message }}
                </small>
            @enderror
        </div>
    </div>

    <div class="row mt-3">
        <label for="slug" class="col-12 col-md-1 col-form-label text-md-end">Slug</label>
        <div class="col-12 col-md-10">
            <input type="text" class="form-control @error('slug')is-invalid @enderror" id="slug" name="slug" value="{{ old('slug', $post->slug) }}" readonly required>
        </div>
        @error('slug')
            <small class="text-danger pt-3 pb-1">
                {{ $message }}
            </small>
        @enderror
    </div>

    <div class="row mt-3">
        <label for="category" class="col-12 col-md-1 col-form-label text-md-end">Category</label>
        <div class="col-12 col-md-10">
            <select class="form-control" id="category" name="category" required>
                <option value="">Choose a category</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" {{ old('category', $post->category->id) == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="row mt-3">
        <label for="status" class="col-12 col-md-1 col-form-label text-md-end">Status</label>
        <div class="col-12 col-md-10">
            <select class="form-control" id="status" name="status" required>
                <option value="">Choose a status</option>
                <option value="Public" {{ old('status', $post->visibility) == 'Public' ? 'selected' : '' }}>Public</option>
                <option value="Private" {{ old('status', $post->visibility) == 'Private' ? 'selected' : '' }}>Private</option>
            </select>
        </div>
    </div>

    <div class="row mt-3">
        <label for="body" class="col-12 col-md-1 col-form-label text-md-end">Body</label>
        <div class="col-12 col-md-10">
            <input id="body" class="@error('body') is-invalid @enderror" type="hidden" name="body" required value="{{ old('body', $post->body) }}">
            <trix-editor input="body"></trix-editor>
            @error('body')
                <small class="text-danger pt-3 pb-1">
                    {{ $message }}
                </small>
            @enderror
        </div>
    </div>

    <div class="row mt-3">
        <div class="col-12 text-end justify-content-end d-flex">
            <button class="btn btn-primary px-4" type="submit">Save</button>
        </div>
    </div>
</form>


<script src="{{ asset('assets/home/js/jquery.min.js') }}"></script>
<script>
    $(document).ready(function() {
        $('#category').select2();
        $('#status').select2();

        var title = $('#title');
        var slug = $('#slug');

        $('#title').on('change', function(){
            fetch('/my-post/createSlug?title=' + title.val())
            .then(response => response.json())
            .then(data => slug.val(data.slug))
        });

        document.addEventListener('trix-file-accept', function(e){
            e.preventDefault();
        })    
    });

    function preview_image() {
        const fileInput = document.getElementById('picture');
        const imagePreview = document.getElementById('imagePreview');

        if (fileInput.files && fileInput.files[0]) {
            const reader = new FileReader();
            
            reader.onload = function(e) {
                imagePreview.src = e.target.result;
            };

            reader.readAsDataURL(fileInput.files[0]);
        }
    }
    </script>
@endsection