<?php

namespace App\Fetchers;

use App\Post;
use App\Source;
use Carbon\Carbon;
use Embed\Embed;

class rssFetcher implements Fetchable
{
	
	private $list_of_post_links; // raw collection of link and uid keys

	function __construct(Source $source)
	{
		$this->source = $source;
	}
	public function fetch()
	{
		$this->list_of_post_links = $this->get_list_of_post_links();
		$this->list_of_new_posts = $this->get_new_posts();
		return $this->list_of_new_posts;
	}

	public function get_list_of_post_links()
	{
		$rss_feed = $this->source->fetcher_source; 
		$feed = \Feeds::make($rss_feed);

		// get all Items in the RSS feed
		$items = collect($feed->get_items());

		// keep only url and id
		$items = $items->map(function($item) {
			return [ 'url' => $item->get_link(), 'uid' => $item->get_id()];
		});

		return $items;
	}

	public function get_new_posts()
	{
		// filter out posts that already exist in the database
		$new_links = $this->list_of_post_links->filter(function($item) {
			return ! Post::uidExists($item['uid']);
		});
		
		$posts = $new_links->map(function($item){
			$e = Embed::create($item['url']);
			$post = new Post;
			$post->uid = $item['uid'];
			$post->title = $e->title;
			$post->url = $e->url;
			$post->excerpt = $e->description;
			$post->posted_at = new Carbon($e->publishedTime);
			return $post;
		});

		return $posts;
	}
}