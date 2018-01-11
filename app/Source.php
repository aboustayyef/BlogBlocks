<?php

namespace App;

use App\Analyzers\SourceFrequencyAnalyzer;
use App\Media;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Source extends Model
{
    protected $guarded=['id'];
    
    public function posts()
    {
      return $this->hasMany('App\Post');
    }
    public function media()
    {
      return $this->hasMany('App\Media');
    }
    
    public function createAvatar($img)
    {
      $avatar = Media::createFromImage($img, 'source');
      $avatar->source_id = $this->id;
      $avatar->save();
    } 
    
    public function hasAvatar()
    {
      # code...
    }

    public function avatar(){
      if (! $this->hasAvatar()) {
        return null;
      }

    }
    public static function getByNickname($nickname)
    {
      try {
       return Static::where('nickname',$nickname)->first(); 
      } catch (\Exception $e) {
        return null;
      }
    }

    public function daysSinceLastPost()
    {
      return $this->posts->last()->posted_at->diffInDays(new Carbon);
    }

    public function updatePosts()
    {
      $className = 'App\Fetchers\\' . $this->fetcher_kind . 'Fetcher';

      // Fetch The Posts into a collection;
      $posts = (new $className($this))->fetch();

      if ($posts->count() == 0) {
        return 'No New Posts Available';
      }
      
      foreach ($posts as $post) {
        // attach to source
        $post->source_id = $this->id;
        $post->save(); 

        // cache image
        $post->cacheImage();
      }
      return $posts->count() . ' new posts saved';
    }


    /**
     * These are the rules for validating field form submissions
     * @return array 
     */
    public static function validationRules($create = true)
    {
        $available_fetcher_kinds = ['rss'];
        $rules =  [
            'name'  =>  'required|min:6',
            'url'   =>  'required|url',
            'nickname'=> 'required|alpha_num',
            'description'   =>  'max:140',
            'fetcher_source'   =>  'required|url',      
            'fetcher_kind'   =>  'in:'. implode(',', $available_fetcher_kinds),      
       ];
       if ($create) {
           $rules['nickname'] .= '|unique:sources';
       }
       return $rules;
    }

    public function calculateFrequency($sample_size = 20)
    {
      return (new SourceFrequencyAnalyzer($this, $sample_size))->median;
    }

    public function tags()
    {
      return $this->BelongsToMany('App\Tag');
    }
}
