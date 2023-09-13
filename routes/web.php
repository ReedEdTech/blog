<?php

use App\Models\Post;
use App\Models\User;
use App\Models\Category;
use App\Services\Newsletter;
use Spatie\YamlFrontMatter\Document;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SessionsController;
use App\Http\Controllers\AdminPostController;
use App\Http\Controllers\NewsletterController;
use App\Http\Controllers\PostCommentsController;

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

Route::get('/', [PostController::class, 'index'] )->name('home');

//{post} is a wildcard
//value gets passed to function (& named $slug)
Route::get('posts/{post:slug}', [PostController::class, 'show']);

//registration page
Route::get( 'register' , [RegisterController::class, 'create'] )->middleware('guest');
Route::post( 'register' , [RegisterController::class, 'store'] )->middleware('guest');

//logging out
Route::post( 'logout', [SessionsController::class, 'destroy'] )->middleware('auth');

//logging in
Route::get( 'login', [SessionsController::class, 'create'] )->middleware('guest');
Route::post( 'login', [SessionsController::class, 'store'] )->middleware('guest');

//comments
Route::post( 'posts/{post:slug}/comments', [PostCommentsController::class, 'store'] )->middleware('auth');


//playing with mailchimp
Route::post( 'newsletter' , NewsletterController::class);  //note: no controller function specified.  Calls __invoke() function

//admin stuff
Route::get('admin/posts/create', [AdminPostController::class, 'create'])->middleware('admin');
Route::post('admin/posts', [AdminPostController::class, 'store'])->middleware('admin');

//admin console
Route::get('admin/posts', [AdminPostController::class, 'index'])->middleware('admin');
Route::get('admin/posts/{post}/edit', [AdminPostController::class, 'edit'])->middleware('admin');
Route::patch('admin/posts/{post}', [AdminPostController::class, 'update'])->middleware('admin');
Route::delete('admin/posts/{post}', [AdminPostController::class, 'destroy'])->middleware('admin');

