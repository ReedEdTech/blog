<?php

namespace App\Models;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\File;

class Post{


    public static function find( $slug ){
        if( !file_exists( $path = resource_path("posts/{$slug}.html") ) ){
            //doesn't exit?  Throw an error
            throw new ModelNotFoundException();
        }
        
        //return the file contents!
        return cache()->remember("posts.{$slug}", now()->addHour(), fn() => file_get_contents($path) );
        //cash will remember this file for one hour!

    }

    public static function all(){
        //File is a class that already exists in Laravel
        //grab all of the files that live in our directory
        $files = File::files( resource_path("posts/") );

        /*
        //array_map returns a new array based on an old array
        //the function gets called on each element of the old array to determine the element of the new array
        return array_map( function($file){
            return $file->getContents();
        }, $files );
        */
        //fancy in-line version
        return array_map( fn($file) => $file->getContents() , $files );
    }
}