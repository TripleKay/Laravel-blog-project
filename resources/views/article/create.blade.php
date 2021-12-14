@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">
            @component('component.breadcrumb')
            <li class="breadcrumb-item"><a href="{{ route("home") }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route("article.index") }}">Article</a></li>
            <li class="breadcrumb-item active" aria-current="page">Add Article</li>
            @endcomponent
            <div class="card">
                <div class="card-header">Add Article</div>
                @if (session('status'))
                    <p class="alert alert-success">
                        {!! session('status') !!}
                    </p>
                @endif
                <div class="card-body">
                    <form action="{{ route("article.store") }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="title">Article Title</label>
                            <input type="text" name="title" id="title" value="{{ old('title') }}" class="form-control @error('title') is-invalid @enderror">
                            @error('title')
                                <small class="text-danger font-weight-bold">{{ $message }}</small>

                            @enderror
                        </div>
                        <div class="form-group">
                            <div class="form-row">
                                <div class="col-12 col-md-6">
                                    <label for="photo">Upload Photo</label>
                                    <input type="file" name="photo[]" id="photo" class="form-control p-1" multiple>
                                    @error('photo.*')
                                        <small class="text-danger font-weight-bold">{{ $message }}</small>

                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="description">Article Description</label>
                            <textarea name="description" id="description" rows="10" class="form-control  @error('description') is-invalid @enderror">
                                {{ old('description') }}
                            </textarea>
                            @error('description')
                                <small class="text-danger font-weight-bold">{{ $message }}</small>

                            @enderror
                        </div>
                        <button class="btn btn-primary">Save Article</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
