@extends('layouts.main')

@section('container')
    <div class="card mb-5" style="width: 100%; height: 30%">
        <img src="/assets/img/posts/{{ $post->picture }}" class="card-img-top" alt="{{ $post->picture }}"  style="height: 300px">
        <div class="card-body">
            <div class="row">
                <div class="col text-start">
                    <h3 class="card-title text-primary" style="font-size: 35px">{{ $post->title }}</h3>
                </div>
                <div class="col text-end d-flex justify-content-end align-items-center">
                    <h5 class="card-title pt-1">
                        {!! $post->visibility == 'public' ? '<i class="bi bi-eye-fill"></i>' : '<i class="bi bi-eye-slash-fill"></i>' !!}
                    </h5>                
                </div>
            </div>
            <h5 class="card-text" style="text-decoration: none; color: #002e63; font-size: 24px">{{ $post->category->name }}</h5>
            <h6 class="card-text text-secondary" style="font-size: 21px">By {{ $post->user->name }}</h6>
            <p class="card-text" style="text-align: justify; font-size: 20px">{{ $post->body }}</p>
        </div>
        <div class="card-footer">
            <div class="row">
                <div class="col text-start">
                    <p class="card-text" style="font-size: 20px">{{ $post->created_at->diffForHumans() }}</p>
                </div>
                <div class="col text-end d-flex justify-content-end align-items-center">
                    <button class="btn btn-warning"><i class="bi bi-archive-fill"></i></button>
                    <button class="btn btn-success mx-2" data-toggle="modal" data-target="#editModal"><i class="bi bi-pencil"></i></button>
                    <button class="btn btn-danger"><i class="bi bi-trash"></i></button>
                </div>
            </div>

        </div>
    </div>
    <a href="{{ url()->previous() }}" style="text-decoration: none">
        <button class="mb-5 btn btn-primary">
            Back to
        </button>
    </a>    
    
    <!-- Edit Modal -->
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editeModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Modal</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="/edit-post" method="post">
                    
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
            </div>
        </div>
    </div>
@endsection

