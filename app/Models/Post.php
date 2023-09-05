<?php

namespace App\Models;
use Spatie\YamlFrontMatter\YamlFrontMatter;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\File;

class Post{
    public $title;
    public $excerpt;
    public $date;
    public $body;
    public $slug;

    public function __construct($title, $excerpt, $date, $body, $slug){
        $this->title = $title;
        $this->excerpt = $excerpt;
        $this->date = $date;
        $this->body = $body;
        $this->slug = $slug;
    }

    public static function find( $slug ){
        /*
        if( !file_exists( $path = resource_path("posts/{$slug}.html") ) ){
            //doesn't exit?  Throw an error
            throw new ModelNotFoundException();
        }
        
        //return the file contents!
        return cache()->remember("posts.{$slug}", now()->addHour(), fn() => file_get_contents($path) );
        //cash will remember this file for one hour!
        */
      
        return static::all()->firstWhere('slug', $slug);

    }

    public static function all(){
        //same thing as calling array_map function
        //EXCEPT:  I birthed a collection & used his member function
        //to create a collection - pass it an ARRAY (of all the post files)
        /*
        $posts = collect( File::files( resource_path("posts") ))
            ->map( function( $file ){
                //this function is called on every item in the array

                //gives us an object w/ meta data separated out    
                $document = YamlFrontMatter::parseFile($file);
                //build a Post object (we wrote that custom class)
                return new Post( $document->title, $document->excerpt, $document->date, $document->body(), $document->slug);
                //returns this new item into the new array
            });
            */
        //Better way:  Chained map function calls!
        return cache()->rememberForever( 'posts.all', function(){
            return collect( File::files( resource_path("posts") ))
            -> map(  fn($file) => YamlFrontMatter::parseFile($file) )
            -> map( fn($document) => new Post( $document->title, $document->excerpt, $document->date, $document->body(), $document->slug))
            ->sortByDesc( 'date' );
        });

        
    }
}