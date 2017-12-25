<?php
namespace App\Analyzers;

use App\Source;


/**
*  Analyzes the frequency with which a source typically posts
*/
class SourceFrequencyAnalyzer
{
    public $hourly_differences, $median;

    function __construct(Source $source, $sample_size = 20)
    {
        // get list of posts
        $sample_posts = $source->posts()->orderBy('posted_at','desc')->take($sample_size)->get();

        // remove details and keep only posted_at
        $list_of_posted_times = $sample_posts->map(function($post){
            return $post->posted_at;
        });

        // check the difference in hours between the posts
        $list_of_hour_differences = collect([]);
        foreach ($list_of_posted_times as $key => $timestamp) {
           if (isset($list_of_posted_times[$key + 1])) {
                    $list_of_hour_differences->push($list_of_posted_times[$key + 1]->diffInHours($list_of_posted_times[$key]));
            } 
        }

        $this->hourly_differences = $list_of_hour_differences;
        $this->median = (int) round($this->hourly_differences->median());
        if (! $this->median) {
            $this->median = 0;
        }
    }
}