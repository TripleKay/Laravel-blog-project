<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get("about","PageController@about")->name("page.about");
Route::get("article","PageController@article")->name("page.article");

Route::prefix("user-dashboard")->middleware("auth")->group(function(){
    Route::get('/home', 'HomeController@index')->name('home');
    Route::resource("article","ArticleController");
    Route::resource("photo","PhotoController");
    Route::get("/profile","ProfileController@edit")->name("profile.edit");
    Route::post("/profile","ProfileController@update")->name("profile.update");
});

Route::get("article-search","ArticleController@search")->name('article.search');
Auth::routes();