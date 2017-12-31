<?php

use App\Post;
use App\Source;
use App\Tag;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use League\Csv\Reader;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // If the Posts don't exist, import them using the following query (for digital ocean), or sequel pro for local:
        // SELECT posts.`post_title`, posts.`post_url`, posts.`post_excerpt`, posts.`post_timestamp`, posts.`post_tags`, posts.`blog_id`,  posts.`post_rss_id`, posts.`post_original_image` FROM posts INTO OUTFILE '/var/lib/mysql-files/lb_posts.csv' FIELDS TERMINATED BY ',' ENCLOSED BY '"' LINES TERMINATED BY '\n';

        $fileLocation = storage_path(). '/app/lb_posts.csv';

        // Get CSV content from goods.csv in storage
        $csv = Reader::createFromPath($fileLocation);

        // Remove Headers
        $posts = collect($csv->setOffset(1)->fetchAll());

        foreach ($posts as $key => $post) {
            $source_id = $this->find_id_from_shortname($post[5]);
            
            $uid = $post[6] == 'NULL' ? $post[5] . $key: $post[6];      // Get UID or Create if Doesnt exist
            if ($source_id !== 9999) {                                  // Prevent Including Blogs that no longer exist
                if (! Post::uid_exists($uid)) {                         // Prevent Duplicate Posts
                    try {
                        $new_post = Post::create([
                            'title'             =>  $post[0],
                            'url'               =>  $post[1],
                            'excerpt'           =>  $post[2],
                            'posted_at'         =>  Carbon::createFromTimestamp($post[3]),
                            'original_image'    =>  $post[7],
                            'uid'               =>  $uid,
                            'source_id'         =>  $source_id 
                        ]);
                        $tags = Tag::createListFromString($post[4]);
                        $new_post->tags()->attach($tags);
                        $new_post->cacheImage();
                    } catch (\Exception $e) {
                        //error in a particular post. Skip                        
                    }
                }
            }
        }
    }

    /**
     * Find the source ID from shorthand name of Source
     */
    public function find_id_from_shortname($shortname)
    {
        try {
            $id = Source::Where('nickname',$shortname)->first()->id; 
            return $id;
        } catch (\Exception $e) {
            return 9999; 
        }
    }
}
