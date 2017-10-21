<?php

use Illuminate\Database\Seeder;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // If the Posts don't exist, import them using the following query from sequel Pro:
        // SELECT posts.post_title, posts.post_url, posts.post_excerpt, posts.post_tags FROM posts 
    }
}
