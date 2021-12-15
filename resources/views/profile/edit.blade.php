@extends('layouts.app')
@section('head')
    <style>
        .article-thumnail{
            display: inline-block;
            width: 150px;
            height: 150px;
            border-radius: .25rem;
            margin-top: 10px;
            background-size: 200%;
        }
    </style>

@endsection
@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">
            @component('component.breadcrumb')
                <li class="breadcrumb-item"><a href="{{ route("home") }}">Home</a></li>

                <li class="breadcrumb-item active" aria-current="page">Edit Profile</li>
            @endcomponent
            <div class="row">
                <div class="col-12 col-md-4">
                    <div class="card mb-3">
                        <div class="card-header">Edit Profile</div>

                        <div class="card-body">
                            <img src="{{ asset("storage/profile/".Auth::user()->photo) }}" class="mb-3 rounded img-fluid" alt="" srcset="">
                            <form action="{{ route("profile.update") }}" enctype="multipart/form-data" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label for="photo">Choose new photo</label>
                                    <input type="file" name="photo" class="form-control p-1">
                                    @error('photo')
                                        <small class="font-weight-bold text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <button class="btn btn-primary w-100">Update Profile Photo</button>
                            </form>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">Change Password</div>
                        <div class="card-body">
                            <form action="{{ route("profile.changePassword") }}" method="POST">
                                @csrf
                                @foreach ($errors->all() as $error)
                                    <p class="text-danger">{{ $error }}</p>

                                @endforeach
                                <div class="form-group">
                                    <label for="password" >Current Password</label>
                                    <input type="password" name="current_password" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="new_password" >New Password</label>
                                    <input type="password" name="new_password" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="confirm_new_password" >Confirm New Password</label>
                                    <input type="password" name="confirm_new_password" class="form-control">
                                </div>
                                <button class="btn btn-primary w-100">Change Password</button>
                            </form>

                        </div>
                    </div>
                </div>

                <div class="col-12 col-md-8">
                    <div class="card">
                        <div class="card-header">
                            Uploaded Photos
                        </div>
                        <div class="card-body">
                            @foreach (Auth::user()->getPhoto as $img)
                                <div class="article-thumnail shadow-sm" style="background-image: url('{{ asset("storage/article/".$img->location) }}')">
                                </div>
                            @endforeach
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

@endsection
