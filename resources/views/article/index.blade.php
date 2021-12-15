@extends('layouts.app')

@section('head')
    <style>
        .article-thumnail{
            display: inline-block;
            width: 50px;
            height: 50px;
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
            <li class="breadcrumb-item active" aria-current="page">Article</li>
            @endcomponent
            <div class="card">
                <div class="card-header">Article List</div>
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div class="">
                            {{ $articles->appends(Request::all())->links() }}
                        </div>
                        <div class="">
                            <form action="{{ route('article.search') }}" method="GET">

                                <div class="form-inline mb-3">
                                    <input type="text" name="search" class="form-control mr-2">
                                    <button class="btn btn-primary">Search</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    @if (session('status'))
                        <p class="alert alert-danger">
                            {!! session('status') !!}
                        </p>

                    @endif
                    @if (session('updateStatus'))
                        <p class="alert alert-success">
                            {!! session('updateStatus') !!}
                        </p>

                    @endif
                    <div class="row">
                        <div class="col-12">
                            <table class="table table-hover table-bordered w-100">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Title</th>
                                        <th>Description</th>
                                        <th>Owner</th>
                                        <th>Control</th>
                                        <th class="text-nowrap">Created At</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    {{-- @inject('users', 'App\User')
                                    @inject('photo', 'App\Photo') --}}
                                    @foreach ($articles as $article)

                                    <tr>
                                        <td>{{ $article->id }}</td>
                                        <td style="max-width: 250px;">{{ substr($article->title,0,50) }}.....</td>
                                        <td class="text-wrap" style="max-width: 450px;">
                                            <div class="">
                                                {{ substr($article->description,0,80) }}.....
                                            </div>
                                            @foreach ($article->getPhotos as $img)
                                               <div class="article-thumnail shadow-sm" style="background-image: url('{{ asset("storage/article/".$img->location) }}')">
                                               </div>
                                            @endforeach
                                        </td>
                                        <td class="text-nowrap">
                                            @isset($article->getUser)
                                            {{ $article->getUser->name }}
                                                @else
                                                Unknow
                                            @endisset
                                        </td>
                                        <td class="">
                                            <a href="{{ route("article.show",$article->id) }}" class="btn btn-sm btn-info">
                                                Details
                                            </a>
                                            <a href="{{ route("article.edit",$article->id) }}" class="btn btn-sm btn-secondary my-2">
                                                Edit
                                            </a>
                                            <form  action="{{ route("article.destroy",$article->id) }}" class="d-inline-block" method="POST">
                                                @csrf
                                                @method("delete")
                                                <button type="submit"  class="btn btn-sm btn-danger">Delete</button>
                                            </form>
                                        </td>
                                        <td>
                                            <small class="text-nowrap">
                                                {{ $article->created_at->format("d M Y") }}
                                                <br>
                                                {{ $article->created_at->format("h:i a") }}
                                            </small>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
