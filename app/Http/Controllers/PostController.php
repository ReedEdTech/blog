<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        //dd( request()->only('search'));
        //pass those POSTS to the view (clean up the output in the view)
        return view('posts', [
            'posts' => Post::latest()->filter( request()->only('search') )->get(), //<<that calls the Post.scopeFilter function
            'categories' => Category::all()
        ]);
        // notes:
        //request()->only('search') return an array like ['search'=>'dkjafjldks']
        //that array gets passed as the SECOND parameter to the Post.scopeFilter function
    }

    public function show( Post $post ){
        //go find the file
        //load the view & instantiate a $post variable for the view to use
        return view('post', [
            'post' => $post
        ]);
    }

}
