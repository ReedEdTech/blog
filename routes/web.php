<?php

use Illuminate\Support\Facades\Route;

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
    return view('posts');
});

//{post} is a wildcard
//value gets passed to function (& named $slug)
Route::get('posts/{post}', function ( $slug ) {
    //build the file path for this file
    //$path = __DIR__ . "/../resources/posts/{$slug}.html";
    
    if( !file_exists( $path = __DIR__ . "/../resources/posts/{$slug}.html") ){
        //doesn't exit?  redirect to homepage
        return redirect('/');
    }
    
    //$post = cache()->remember("posts.{$slug}", now()->addHour(), function() use ($path){
    //    return file_get_contents( $path );
    //});

    //inline that function for shorter code
    $post = cache()->remember("posts.{$slug}", now()->addHour(), fn() => file_get_contents($path) );
    //cash will remember this file for one hour!

    //load the view & instantiate a $post variable for the view to use
    return view('post', ['post' => $post]);
})->where('post', '[A-z_\-]+');

