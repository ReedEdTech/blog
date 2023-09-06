<?php

use Illuminate\Support\Facades\Route;
use App\Models\Post;
use App\Models\Category;
use Spatie\YamlFrontMatter\Document;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {   
    
    //pass those POSTS to the view (clean up the output in the view)
    return view('posts', [
        'posts' => Post::all()
    ]);
    
});

//{post} is a wildcard
//value gets passed to function (& named $slug)
Route::get('posts/{post:slug}', function ( Post $post ) {
    //go find the file
    //load the view & instantiate a $post variable for the view to use
    return view('post', [
        'post' => $post
    ]);
});

//route for categories view
Route::get('categories/{category:slug}', function( Category $category ){
    //reuse the posts view (with a different parameter)
    return view( 'posts', [
        'posts' => $category->posts
    ]);
});

