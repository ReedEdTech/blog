<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;

class PostCommentsController extends Controller
{
    //
    public function store( Post $post ){
        //add a comment to the given post
        request()->validate([
            'body' => 'required|max:255|min:5'
        ]);
        
        /*  This works...but there is an easier way
        $attributes = [
            'post_id' => $post->id,
            'user_id' => auth()->user()->id,
            'body' => request('body')
        ];
        Comment::create( $attributes );
        */

        //this will automatically attach it to the correct post
        //it will pull the post_id for you!
        $post->comments()->create([
            'user_id' => auth()->user()->id,
            'body' => request('body')
        ]);

        //return( redirect("/posts/{$post->slug}") );
        return back();  //redirect back to the post page!
    }
}
