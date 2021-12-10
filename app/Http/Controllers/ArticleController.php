<?php

namespace App\Http\Controllers;

use App\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ArticleController extends Controller
{
    public function __construct()
    {
        $this->middleware("auth");
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $articles = Article::orderBy("id","desc")->paginate(5);
        return view("article.index",compact('articles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('article.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            "title"=>"required|min:10|max:255",
            "description"=>"required|min:30"
        ]);
        $article = new Article();
        $article->title = $request->title;
        $article->description = $request->description;
        $article->user_id = Auth::id();
        $article->save();
        return redirect()->route("article.create")->with("status","<b>$request->title</b> is added.");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function show(Article $article)
    {
        return view("article.show",compact("article"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function edit(Article $article)
    {
        return view('article.edit',compact('article'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Article $article)
    {
        $request->validate([
            "title"=>"required|min:10|max:255",
            "description"=>"required|min:30"
        ]);
        $article->title = $request->title;
        $article->description = $request->description;
        $article->update();
        return redirect()->route("article.index")->with("updateStatus","<b>$request->title</b> is updated.");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function destroy(Article $article)
    {
        $title =$article->title;
        $article->delete();
        return redirect()->route("article.index")->with("status","<b>$title</b> is deleted.");
    }
    public function search(Request $request){
        $searchKey = $request->search;
        $articles = Article::where("title","LIKE","%$searchKey%")->orWhere("description","LIKE","%$searchKey%")->paginate(5);
        return view("article.index",compact('articles'));
    }
}