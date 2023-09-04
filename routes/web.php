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
    $path = __DIR__ . "/../resources/posts/{$slug}.html";
    
    if( !file_exists( $path ) ){
        //doesn't exit?  redirect to homepage
        return redirect('/');
    }
    
    //grab the file
    $post = file_get_contents( $path );
    //load the view & instantiate a $post variable for the view to use
    return view('post', [
        'post' => $post
    ]);
});

