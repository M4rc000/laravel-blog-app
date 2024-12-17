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

<form action="" method="POST">
    <div class="row mt-3">
        <label for="title" class="col-12 col-md-1 col-form-label text-md-end">Title</label>
        <div class="col-12 col-md-10">
            <input type="text" class="form-control" id="title" name="title">
        </div>
    </div>

    <div class="row mt-3">
        <label for="slug" class="col-12 col-md-1 col-form-label text-md-end">Slug</label>
        <div class="col-12 col-md-10">
            <input type="text" class="form-control" id="slug" name="slug" readonly>
        </div>
    </div>

    <div class="row mt-3">
        <label for="category" class="col-12 col-md-1 col-form-label text-md-end">Category</label>
        <div class="col-12 col-md-10">
            <select class="form-control" id="category" name="category" required>
                <option value="">Choose a category</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="row mt-3">
        <label for="status" class="col-12 col-md-1 col-form-label text-md-end">Status</label>
        <div class="col-12 col-md-10">
            <select class="form-control" id="status" name="status" required>
                <option value="">Choose a status</option>
                <option value="Public">Public</option>
                <option value="Private">Private</option>
            </select>
        </div>
    </div>

    <div class="row mt-3">
        <label for="exerpt" class="col-12 col-md-1 col-form-label text-md-end">Exerpt</label>
        <div class="col-12 col-md-10">
            <textarea class="form-control" id="exerpt" name="exerpt" rows="3" style="resize: none"></textarea>
        </div>
    </div>

    <div class="row mt-3">
        <label for="body" class="col-12 col-md-1 col-form-label text-md-end">Body</label>
        <div class="col-12 col-md-10">
            <textarea class="form-control" id="body" name="body" rows="10"></textarea>
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

        const title = $('title');
        const slug = $('slug');

        title.on('click', function(){
            fetch('/my-post/createSlug?tile=' + title.value)
            .then(response => response.json())
            .then(data => slug.value = data.slug)
        });
    });
</script>
@endsection