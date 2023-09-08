<?php



use App\Models\Post;
use App\Models\User;
use App\Models\Category;
use Spatie\YamlFrontMatter\Document;
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
    //grab all the posts
    $posts =  Post::latest()->with('category', 'author'); //->get(); <don't get yet.  Might need to narrow down w/search
    
    //maybe filter the list down 
    if( request('search') ){ //if there is a search parameter in the query string
        $posts 
            ->where('title', 'like', '%' . request('search') . '%' )
            ->orWhere( 'body', 'like', '%' . request('search') . '%' );
            //uses SQL syntax:  'like' and wildcard '%'
    }

    //pass those POSTS to the view (clean up the output in the view)
    return view('posts', [
        'posts' => $posts->get(),
        'categories' => Category::all()
    ]);
    
})->name('home');

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
        'posts' => $category->posts->load(['category', 'author']),
        'currentCategory' => $category,
        'categories' => Category::all()
    ]);
})->name('category');

//route for posts by a user
Route::get('authors/{author:username}', function( User $author ){
    //reuse the posts view (with a different parameter)
    return view( 'posts', [
        'posts' => $author->posts->load(['category', 'author']),
        'categories' => Category::all()
    ]);
});



