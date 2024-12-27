@extends('layouts.main')
@section('container')
    <style>
        @media (max-width: 576px) {
            .col-sm-2 {
                text-align: left; /* Align label text to the left for smaller screens */
            }

            .col-sm-2,
            .col-sm-10 {
                flex: 0 0 100%; /* Full width for smaller screens */
                max-width: 100%;
            }
        }
    </style>
    <div class="row">
        <div class="col-lg-8">
            <form action="/user/edit" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="user_id" id="user_id" value="{{ auth()->user()->id }}">
                <div class="form-group row">
                    <label for="username" class="col-sm-2 col-form-label">Username</label>
                    <div class="col-sm-10">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">@</div>
                            </div>
                            <input type="text" class="form-control @error('username') is-invalid @enderror" id="username" name="username" value="{{ auth()->user()->username }}">
                        </div>
                    </div>
                    @error('username')
                        <small class="text-danger pt-3 pb-1">
                            {{ $message }}
                        </small>
                    @enderror
                </div>
                <div class="form-group row">
                    <label for="name" class="col-sm-2 col-form-label">Name</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ auth()->user()->name }}">
                    </div>
                    @error('name')
                        <small class="text-danger pt-3 pb-1">
                            {{ $message }}
                        </small>
                    @enderror
                </div>
                <div class="form-group row">
                    <label for="email" class="col-sm-2 col-form-label">Email</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ auth()->user()->email }}">
                    </div>
                    @error('email')
                        <small class="text-danger pt-3 pb-1">
                            {{ $message }}
                        </small>
                    @enderror
                </div>
                <div class="form-group row">
                    <label for="place_of_birth" class="col-sm-2 col-form-label">Birth Of Date</label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control @error('place_of_birth') is-invalid @enderror" id="place_of_birth" name="place_of_birth" value="{{ auth()->user()->place_of_birth }}">
                    </div>
                    <div class="col-sm-5">
                        <input type="date" class="form-control form-control @error('birth_of_date') is-invalid @enderror" id="birth_of_date" name="birth_of_date" value="{{ auth()->user()->birth_of_date }}">
                    </div>
                    @error('birth_of_date')
                        <small class="text-danger pt-3 pb-1">
                            {{ $message }}
                        </small>
                    @enderror
                    @error('place_of_birth')
                        <small class="text-danger pt-3 pb-1">
                            {{ $message }}
                        </small>
                    @enderror
                </div>
                <div class="form-group row">
                    <div class="col-sm-2">
                        <label for="gender" class="col-sm-2 col-form-label text-sm-left">Gender</label>
                    </div>
                        <div class="col-sm-10">
                        <select name="gender" id="gender" class="custom-select @error('gender') is-invalid @enderror">
                            <option value="">Choose a gender</option>
                            <option value="Male" {{ auth()->user()->gender == 'Male' ? 'selected' : '' }}>Male</option>
                            <option value="Female" {{ auth()->user()->gender == 'Female' ? 'selected' : '' }}>Female</option>
                        </select>
                        @error('gender')
                            <small class="text-danger pt-1">
                                {{ $message }}
                            </small>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-2">
                        <label for="country" class="text-sm-left">Country</label>
                    </div>
                    <div class="col-sm-10">
                        <select name="country" id="country" class="form-control @error('country') is-invalid @enderror">
                            <option value="" selected disabled>Select a country</option>
                        </select>
                        @error('country')
                            <small class="text-danger pt-1">
                                {{ $message }}
                            </small>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-2">Picture</div>
                    <div class="col-sm-10">
                        <div class="row">
                            <div class="col-sm-3">
                                <img src="{{ asset('storage') . '/' . auth()->user()->picture }}" class="img-thumbnail" id="imagePreview">
                            </div>
                            <div class="col-sm-9">
                                <div class="custom-file">
                                    <input type="hidden" class="custom-file-input" id="oldUserImage" name="oldUserImage">
                                    <input type="file" class="custom-file-input @error('picture') is-invalid @enderror" id="picture" name="picture" onchange="preview_image()">
                                    <label class="custom-file-label" for="picture">Choose file</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    @error('picture')
                        <small class="text-danger pt-3 pb-1">
                            {{ $message }}
                        </small>
                    @enderror
                </div>
                <div class="form-group row justify-content-end">
                    <div class="col-sm-10">
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('#country').select2();
            $('#gender').select2();

            @if (session()->has('success_update'))   
                Swal.fire({
                    title: "Success",
                    text: "{{ session('success_update') }}",
                    icon: "success"
                });
            @endif      
            @if (session()->has('failed_update'))   
                Swal.fire({
                    title: "Error",
                    text: "{{ session('failed_update') }}",
                    icon: "error"
                });
            @endif 
            
            // Fetch country data from the API
            $.ajax({
                url: "https://restcountries.com/v3.1/all",
                method: "GET",
                success: function (data) {
                    const countryDropdown = $('#country');
                    const userCountry = "{{ auth()->user()->country }}"; // Fetch user's country

                    // Loop through the API response and populate the select
                    data.forEach(country => {
                        const countryName = country.name.common; // Get the country's name
                        const isSelected = userCountry == countryName ? 'selected' : ''; // Mark user's country as selected
                        countryDropdown.append(`<option value="${countryName}" ${isSelected}>${countryName}</option>`);
                    });
                },
                error: function (xhr, status, error) {
                    console.error("Error fetching countries:", status, error);
                }
            });
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