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
            <li class="breadcrumb-item"><a href="{{ route("article.index") }}">Article</a></li>
            <li class="breadcrumb-item active" aria-current="page">Edit Article</li>
            @endcomponent
            <div class="row">
                <div class="col-12 col-md-7">
                    <div class="card shadow">
                        <div class="card-header">Add Article</div>
                        @if (session('status'))
                            <p class="alert alert-success">
                                {!! session('status') !!}
                            </p>
                        @endif
                        <div class="card-body">
                            @inject('photo', 'App\Photo')
                            <form action="{{ route("article.update",$article->id) }}" id="article-form" method="POST">
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
                                <button class="btn btn-primary" form="article-form">Update Article</button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-5">
                    <div class="card">
                        <div class="card-body">
                            @foreach ($photo->where("article_id",$article->id)->get() as $img)
                            <div class="d-inline-block">
                                <div class="article-thumnail shadow-sm" style="background-image: url('{{ asset("storage/article/".$img->location) }}')">
                                </div>
                                <form action="{{ route('photo.destroy',$img->id) }}" method="POST">
                                    @csrf
                                    @method("delete")
                                    <button class="btn btn-sm btn-danger" style="margin-top: -80px; margin-left: 5px">Delete</button>
                                </form>
                            </div>
                            @endforeach
                            <form action="{{ route('photo.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="article_id" value="{{ $article->id }}">
                                <input type="file" name="photo[]" id="photo" class="form-control p-1" multiple required>
                                @error('photo.*')
                                    <small class="text-danger font-weight-bold">{{ $message }}</small>

                                @enderror
                                <button class="btn btn-info btn-sm my-2">Upload</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
