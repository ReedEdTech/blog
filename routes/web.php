<?php

use Illuminate\Support\Facades\Route;
use App\Models\Post;

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
    return view('posts', [
        'posts' => Post::all()
    ]);
});

//{post} is a wildcard
//value gets passed to function (& named $slug)
Route::get('posts/{post}', function ( $slug ) {
    //go find the file
    //load the view & instantiate a $post variable for the view to use
    return view('post', [
        'post' => Post::find( $slug )
    ]);
})->where('post', '[A-z_\-]+');

