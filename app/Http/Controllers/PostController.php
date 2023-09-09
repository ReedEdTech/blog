<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        //dd( request(['search', 'category']) );
        //dd( Category::all()->where('slug', request('category'))->first());
        //pass those POSTS to the view (clean up the output in the view)
        return view('posts.index', [
            'posts' => Post::latest()->filter( request(['search', 'category', 'author']) )->get() //<<that calls the Post.scopeFilter function
            //'currentCategory' => Category::firstWhere('slug', request('category')) //<<<moved this CategoryDropdown.php
        ]);
        // notes:
        //request()->only('search') return an array like ['search'=>'dkjafjldks']
        //that array gets passed as the SECOND parameter to the Post.scopeFilter function
    }

    public function show( Post $post ){
        //go find the file
        //load the view & instantiate a $post variable for the view to use
        return view('posts.show', [
            'post' => $post
        ]);
    }

}
