<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Post;
use App\Models\Category;
use App\Models\User;
use App\Models\Image;

class PostSeeder extends Seeder
{
    public function run()
    {
        $admin = User::where('email', 'admin@example.com')->first();

        $post1 = Post::create([
            'user_id' => $admin->id,
            'title' => 'First Post',
            'body' => 'This is the body of the first post.',
            'is_published' => true,
        ]);

        $post1->categories()->attach(Category::where('name', 'Technology')->first());
        $post1->images()->create(['path' => 'images/post1.jpg']);

        $post2 = Post::create([
            'user_id' => $admin->id,
            'title' => 'Second Post',
            'body' => 'This is the body of the second post.',
            'is_published' => false,
        ]);

        $post2->categories()->attach(Category::where('name', 'Health')->first());
        $post2->images()->create(['path' => 'images/post2.jpg']);
    }
}
