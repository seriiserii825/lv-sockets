<?php

namespace Database\Seeders;

use App\Models\Post;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $posts = [
            [
                'title' => 'First Post',
                'content' => 'This is the first post content',
                'user_id' => 1,
            ],
            [
                'title' => 'Second Post',
                'content' => 'This is the second post content',
                'user_id' => 2,
            ],
            [
                'title' => 'Third Post',
                'content' => 'This is the third post content',
                'user_id' => 1,
            ],
            [
                'title' => 'Fourth Post',
                'content' => 'This is the fourth post content',
                'user_id' => 2,
            ],
            [
                'title' => 'Fifth Post',
                'content' => 'This is the fifth post content',
                'user_id' => 3,
            ],
            [
                'title' => 'Sixth Post',
                'content' => 'This is the sixth post content',
                'user_id' => 3,
            ],
            [
                'title' => 'Seventh Post',
                'content' => 'This is the seventh post content',
                'user_id' => 1,
            ]
        ];
        foreach ($posts as $post) {
            Post::factory()->create($post);
        }
    }
}
