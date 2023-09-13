<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class AdminPostController extends Controller
{
    //
    public function index(){
        return view('admin.posts.index' , [
            'posts' => Post::paginate(50)
        ]);
    }

    public function edit( Post $post ){

        return view( 'admin.posts.edit', [
            'post' => $post
        ]);
    }

    public function create(  ){
        return view( 'admin.posts.create' );
    }

    public function store( ){
        //ddd( request() -> all() );
        $attributes = request()->validate([
            'title' => 'required',
            'thumbnail' => 'required',//|image',
            'excerpt' => 'required',
            'body' => 'required',
            'slug' => ['required', Rule::unique('posts','slug')],
            'category_id' => ['required', Rule::exists('categories', 'id')]
        ]);
//ddd(request()->file('thumbnail')->store('thumbnails'));

        $attributes['user_id'] = auth()->user()->id;
        //store function = store in the 'thumbnails' folder & return the file path (as a string)
        $attributes['thumbnail'] = request()->file('thumbnail')->store('thumbnails');   
        

        //dd( $attributes );
        $post = Post::create($attributes);

        return redirect("/posts/".$post->slug);

    }

    public function update( Post $post ){

        $attributes = request()->validate([
            'title' => 'required',
            'thumbnail' => 'image',
            'excerpt' => 'required',
            'body' => 'required',
            'slug' => ['required', Rule::unique('posts','slug')->ignore($post->id)],
            'category_id' => ['required', Rule::exists('categories', 'id')]
        ]);

        if( isset( $attributes['thumbnail'] ) ){
            $attributes['thumbnail'] = request()->file('thumbnail')->store('thumbnails');   
        }

        $post->update( $attributes );

        //ddd( $post->title );

        return back()->with('success', 'Post Updated!');

    }

    public function destroy( Post $post ){
        //ddd("DELETE POST ".$post->id);
        //Post::destroy( $post->id );
        $post->delete();

        return back()->with('success', 'Post Deleted!');
    }
}

