<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Source extends Model
{
    protected $guarded=['id'];
    
    public function posts()
    {
      return $this->hasMany('App\Post');
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
            'twitter'  =>   'required|alpha_dash',
            'fetcher_source'   =>  'required|url',      
            'fetcher_kind'   =>  'in:'. implode(',', $available_fetcher_kinds),      
       ];
       if ($create) {
           $rules['nickname'] .= '|unique:blogs';
       }
       return $rules;
    }
}
