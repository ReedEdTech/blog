<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Post extends Model
{
    //protected $guarded = ['id'];
    protected $fillable=['title','excerpt','body','slug','category_id'];

    use HasFactory;

    //scopeFilter functions allow you to run queries
    //Call like this:  Post::newQuery()->filter()
    public function scopeFilter( $query , array $filters){

        //if there is a search parameter in the query string, call this in-line function        
        $query->when(  $filters['search'] ?? false, fn($query, $search) =>  
            $query
                ->where('title', 'like', '%' . request('search') . '%')
                ->orWhere('body', 'like', '%' . request('search') . '%')
                //uses SQL syntax:  'like' and wildcard '%'
         );


        //if there is a category parameter in the query string, call this in-line function        
        $query->when(  $filters['category'] ?? false, fn( $query, $category) =>  
            $query->whereHas( 'category' , fn($query) => 
                $query->where( 'slug', $category )
            )
        );

    }

    public function category(){
        return $this->belongsTo( Category::class );
    }

    //rename this from user to author 
    public function author(){
        return $this->belongsTo( User::class , 'user_id');
        //need 2nd parameter to force mapping to user_id (otherwise, it will be looking for author_id)
        //now you can talk about $post->author->name (instead of $post->user->name)
    }

}
