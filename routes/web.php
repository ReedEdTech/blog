<?php



use App\Models\Post;
use App\Models\User;
use App\Models\Category;
use Spatie\YamlFrontMatter\Document;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;

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

//route for categories view ->  We REPLACED this by passing the category into the query string,
// now search by category is handled by the '/' route!
// Route::get('categories/{category:slug}', function( Category $category ){
//     //reuse the posts view (with a different parameter)
//     return view( 'posts', [
//         'posts' => $category->posts->load(['category', 'author']),
//         'currentCategory' => $category,
//         'categories' => Category::all()
//     ]);
// })->name('category');

//route for posts by a user
Route::get('authors/{author:username}', function( User $author ){
    //reuse the posts view (with a different parameter)
    return view( 'posts', [
        'posts' => $author->posts->load(['category', 'author']),
        'categories' => Category::all()
    ]);
});



