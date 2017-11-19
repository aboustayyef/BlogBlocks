<?php

namespace App;

use App\Media;
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

    public function source()
    {
        return $this->belongsTo('App\Source');
    }
    public function media()
    {
      return $this->hasMany('App\Media');
    }
    public static function uid_exists($uid)
    {
        return Static::where('uid',$uid)->count() > 0;
    }

    public function image()
    {
        // if cache exists, return cache, 
        if ($this->media->count() > 0) {
            return '/img/media/'.$this->media->first()->pointer;
        }
        // other wise if an original image exists, return it
        if ($this->original_image && $this->original_image !== 'NULL') {
            return $this->original_image;
        }
        // otherwise, no image exists;
        return null;
    }

    public function cacheImage($value='')
    {
        if ($this->media->count() == 0) {
            $image = Media::createFromImage($this->original_image, 'post');
            $image->post_id = $this->id;
            $image->save();
        }
    }

    public function tags()
    {
        return $this->belongsToMany('App\Tag');
    }

    public static function uidExists($uid)
    {
        return Static::where('uid',$uid)->count() > 0;
    }
}
