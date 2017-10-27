<?php

namespace App;

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

    public static function uid_exists($uid)
    {
        return Static::where('uid',$uid)->count() > 0;
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
