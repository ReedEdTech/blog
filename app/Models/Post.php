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
    public function user(){
        return $this->belongsTo( User::class );
    }

}
