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
