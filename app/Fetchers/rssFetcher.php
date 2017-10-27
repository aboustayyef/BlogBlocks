<?php

namespace App\Fetchers;

use App\Post;
use App\Source;
use Carbon\Carbon;
use Embed\Embed;


class rssFetcher implements Fetchable
{
	
	function __construct(Source $source)
	{
		$this->source = $source;
	}

	public function fetch()
	{
		$rss_feed = $this->source->fetcher_source; 
		$feed = \Feeds::make($rss_feed);
		$source_id = $this->source->id;

		// get all Items in the RSS feed
		$items = collect($feed->get_items());

		// filter out the ones that already exist in the database
		$items = $items->filter(function($item) use ($source_id){
			return ! Post::uidExists($item->get_id());
		
		// Keep only the url and the uid
		})->map(function($item) use ($source_id){
			return [ 'url' => $item->get_link(), 'uid' => $item->get_id()];

		// Convert to Posts using data taken from link embed
		})->map(function($item) use ($source_id){
			$e = Embed::create($item['url']);
			return Post::create([
				'uid'			=>	$item['uid'],
				'title'			=>	$e->title,
				'url'			=>	$e->url,
				'excerpt'		=>	$e->description,
				'posted_at'		=> new Carbon($e->publishedTime),
				'source_id'		=>	$source_id
			]);
		});

		return $items;
	}
}