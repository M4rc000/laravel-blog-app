@extends('layouts.main')
@section('container')
    <div class="row">
        <div class="col-lg-8">
            <form action="" method="post">
            <div class="form-group row">
                <label for="email" class="col-sm-2 col-form-label">Email</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="email" name="email" value="{{ auth()->user()->email }}" readonly>
                </div>
            </div>
            <div class="form-group row">
                <label for="name" class="col-sm-2 col-form-label">Name</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="name" name="name" value="{{ auth()->user()->name }}">
                </div>
            </div>
            <div class="form-group row">
                <label for="birth_place" class="col-sm-2 col-form-label">Birth Of Date</label>
                <div class="col-sm-5">
                    <input type="text" class="form-control" id="birth_place" name="birth_place" value="">
                </div>
                <div class="col-sm-5">
                    <input type="date" class="form-control" id="bdate" name="bdate" value="">
                </div>
            </div>
            <div class="form-group row">
                <label for="gender" class="col-sm-2 col-form-label">Gender</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="gender" name="gender" value="{{ auth()->user()->gender }}">
                </div>
            </div>
            <div class="form-group row">
                <label for="citizenship" class="col-sm-2 col-form-label">Citizenship</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="citizenship" name="citizenship" value="">
                </div>
            </div>
            <div class="form-group row">
                <div class="col-sm-2">Picture</div>
                <div class="col-sm-10">
                    <div class="row">
                        <div class="col-sm-3">
                            <img src="{{ asset('storage') . '/' . auth()->user()->picture }}" class="img-thumbnail">
                        </div>
                        <div class="col-sm-9">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="image" name="image">
                                <label class="custom-file-label" for="image">Choose file</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-group row justify-content-end">
                <div class="col-sm-10">
                    <button type="submit" class="btn btn-primary">Edit</button>
                </div>
            </div>
        </form>


        </div>
    </div>
@endsection