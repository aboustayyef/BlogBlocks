<?php

namespace App\Console\Commands;

use App\Post;
use App\Score;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class ScoreUpdater extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'lb:update_scores';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update the Scores of the last 100 posts';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $gravity = 1.2;
        $posts = Post::orderBy('posted_at','desc')->take(100)->get();

        foreach ($posts as $post) {
            $this->info('Getting Score for [ ' . $post->title . ' ]' );

            // if post already has score
            if ($post->score) {
                $this->comment('post exists in database');
                $score = Score::where('post_id', $post->id)->first();
            } else {
                $score = new Score;
            }

            $score->post_id = $post->id;
            $score->likes = $post->getFacebookLikes();
            // age of post in hours
            $t = round(($post->posted_at->diffInMinutes((new Carbon()))/60),2);
            $score->hours_ago = $t;
            $score->score = round( ($score->likes * 100) / pow($t, $gravity), 2);
            $score->save();
        }
        //
    }
}
