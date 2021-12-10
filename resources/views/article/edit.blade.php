@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">
            @component('component.breadcrumb')
            <li class="breadcrumb-item"><a href="{{ route("home") }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route("article.index") }}">Article</a></li>
            <li class="breadcrumb-item active" aria-current="page">Edit Article</li>
            @endcomponent
            <div class="card">
                <div class="card-header">Add Article</div>
                @if (session('status'))
                    <p class="alert alert-success">
                        {!! session('status') !!}
                    </p>
                @endif
                <div class="card-body">
                    <form action="{{ route("article.update",$article->id) }}" method="POST">
                        @csrf
                        @method('put')
                        <div class="form-group">
                            <label for="title">Article Title</label>
                            <input type="text" name="title" id="title" value="{{ $article->title }}" class="form-control @error('title') is-invalid @enderror">
                            @error('title')
                                <small class="text-danger font-weight-bold">{{ $message }}</small>

                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="description">Article Description</label>
                            <textarea name="description" id="description" rows="10" class="form-control  @error('description') is-invalid @enderror">
                                {{ $article->description }}
                            </textarea>
                            @error('description')
                                <small class="text-danger font-weight-bold">{{ $message }}</small>

                            @enderror
                        </div>
                        <button class="btn btn-primary">Update Article</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
