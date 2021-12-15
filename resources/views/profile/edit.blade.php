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
            <div class="card w-25">
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


        </div>
        <div class="col-12">

            @foreach (Auth::user()->getPhoto as $img)
                <div class="article-thumnail shadow-sm" style="background-image: url('{{ asset("storage/article/".$img->location) }}')">
                </div>
            @endforeach
        </div>
    </div>
</div>

@endsection
