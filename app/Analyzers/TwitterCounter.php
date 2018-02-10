<?php
namespace App\Analyzers;

class TwitterCounter
{
    public static function count($searchterm, $countonly=true){
        
        $settings = array(
            'oauth_access_token' => env('TWITTER_ACCESS_TOKEN'),
            'oauth_access_token_secret' => env('TWITTER_ACCESS_TOKEN_SECRET'),
            'consumer_key' => env('TWITTER_CONSUMER_KEY'),
            'consumer_secret' => env('TWITTER_CONSUMER_SECRET')
        );

        $url = 'https://api.twitter.com/1.1/search/tweets.json';
        $requestMethod = 'GET';
        $getfield = '?q=' . $searchterm ;

        $twitter = new \TwitterAPIExchange($settings);
        $response = json_decode($twitter->setGetfield($getfield)->buildOauth($url, $requestMethod)->performRequest());
        $statuses = collect($response->statuses);
        $count = $statuses->count();
        if ($countonly) {
            return $count;
        }
        return $statuses;
    }
}