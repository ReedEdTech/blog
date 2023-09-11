<?php

namespace App\Models;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Comment extends Model
{
    use HasFactory;


    public function post(){
        //don't need a 2nd parameter here because the names match
        //  Post - post_id : laravel can figure that out
        return $this->belongsTo( Post::class );
    }

    public function author(){
        //need explicit 2nd parameter here because the column name doesn't match (author != user)
        return $this->belongsTo( User::class, 'user_id' );
    }
}
