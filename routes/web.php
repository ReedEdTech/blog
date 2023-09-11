<?php



use App\Models\Post;
use App\Models\User;
use App\Models\Category;
use Spatie\YamlFrontMatter\Document;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SessionsController;

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