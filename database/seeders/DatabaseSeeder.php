<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Category;
use App\Models\Post;
use Database\Factories\PostFactory;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        /*
        User::truncate();
        Category::truncate();
        Post::truncate();
        */
        //seed catgories (not using factory!)
        $names = ['Personal', 'Family', 'Work', 'Hobbies'];
        $slugs = ['personal', 'family', 'work', 'hobbies'];
        $categories = [];
        for( $i=0; $i<count($names); $i+=1){
            $categories[] = Category::create( ['name'=> $names[$i], 'slug'=>$slugs[$i] ] );
        }

        for($i=0; $i<10; $i++){
            //create 10 random users
            $user = User::factory()->create();
            //create between 1&5 posts for this user
            for($p=0; $p<rand(1,5); $p++){
                Post::factory()->create([
                    'user_id' => $user->id,
                    'category_id' => $categories[ rand( 0, count($categories)-1 ) ]
                ]);
            }
        }

        $this->call([ CommentSeeder::class ]);

        //\App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);        
        /*
        $users = [];
        for( $u=0; $u<3; $u++)
            $users[] = User::factory()->create();
        
        //seed catgories
        $names = ['Personal', 'Family', 'Work', 'Hobbies'];
        $slugs = ['personal', 'family', 'work', 'hobbies'];
        $categories = [];
        for( $i=0; $i<count($names); $i+=1){
            $categories[] = Category::create( ['name'=> $names[$i], 'slug'=>$slugs[$i] ] );
        }

        //seed posts
        $titles = [];
        $slugsP = [];
        $excerpts = [];
        $bodies = [];

        for( $i=0; $i<count($names); $i+=1){
            $titles[] = 'My ' . $names[$i] . ' Post';
            $slugsP[] = 'my-'.$slugs[$i].'-post';
            $excerpts[] = 'Read all about my '. $slugs[$i];
            $bodies[] = '';
            for($j=0; $j<10; $j++){
                $bodies[$i] = $bodies[$i] . ' ' . $slugs[$i];
            }

            Post::create([
                'user_id' => $users[ rand(0, count($users)-1 ) ]->id,
                'category_id' => $categories[$i]->id,
                'title' => $titles[$i],
                'slug' => $slugsP[$i],
                'excerpt' => $excerpts[$i],
                'body' => $bodies[$i]
            ]);
            
        }
        */

        

    }
}
