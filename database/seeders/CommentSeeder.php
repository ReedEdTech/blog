<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\Comment;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $posts = Post::all();
        foreach( $posts as $post ){
            $num = rand(1,5);
            for($c=0; $c<$num; $c++){
                Comment::factory()->create([
                    'post_id' => $post->id,
                    'user_id' => User::all()->random()->id
                ]);
            }
        }
    }
}
