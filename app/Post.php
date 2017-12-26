<?php

namespace App;

use App\Media;
use Carbon\Carbon;
use GuzzleHttp\Client;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $guarded = [];
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
        'posted_at'
    ]; 

    /*
        Relationships
     */

    public function source()
    {
        return $this->belongsTo('App\Source');
    }

    public function media()
    {
      return $this->hasMany('App\Media');
    }

    public function tags()
    {
        return $this->belongsToMany('App\Tag');
    }

    /*
        Utility Functions
     */ 
    public static function uid_exists($uid)
    {
        return Static::where('uid',$uid)->count() > 0;
    }

    public static function uidExists($uid)
    {
        return Static::where('uid',$uid)->count() > 0;
    }


    /*
        Images and Media
     */

    public function hasCache(){
        return $this->media->count() > 0 ;
    }
    /**
     * Get appropriate Image (choose between cache and original)
     * @return (string) Image Location
     */
    public function image()
    {
        // if cache exists, return cache, 
        if ($this->hasCache()) {
            return '/img/media/'.$this->media->first()->pointer;
        }
        // other wise if an original image exists, return it
        if ($this->original_image && $this->original_image !== 'NULL') {
            return $this->original_image;
        }
        // otherwise, no image exists;
        return null;
    }
    public function rgb()
     {
         if ($this->hasCache()) {
            $values = json_decode($this->media()->latest()->take(1)->first()->dominant_color);
            $string = 'rgb('.$values[0].','.$values[1].','.$values[2].')';
            return $string;
        }
        return null;
     } 
    /**
     * Cache original image if cache doesn't exist
     * @return null 
     */
    public function cacheImage($days = 21)
    {

        // ignore caching posts that are older than $days;
        if ($this->posted_at->diffInDays() > $days ) {
            return ;
        }
        if ($this->media->count() == 0) {
            $image = Media::createFromImage($this->original_image, 'post');
            $image->post_id = $this->id;
            $image->save();
        }
    }

    public function score(){
        return $this->hasOne('App\Score');
    }
    
    public function getFacebookLikes(){
        // https://graph.facebook.com/?id=URL_GOES_HERE/&fields=og_object{engagement}
        $client = new Client();
            try {            
                $response = $client->request('GET', 'https://graph.facebook.com', [
                    'query' => [ 'id' => $this->url ]
                ]);
                $score_object = json_decode($response->getBody());
                if (isset($score_object->share->share_count)) {
                    return $score_object->share->share_count;
                }
                return null;
            } catch (\Exception $e) {
                return null;
            }

    }
}
