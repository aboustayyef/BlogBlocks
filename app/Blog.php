<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    protected $guarded=['id'];
    
    /**
     * These are the rules for validating field form submissions
     * @return array 
     */
    public static function validationRules($create = true)
    {
        $rules =  [
            'name'  =>  'required|min:6',
            'url'   =>  'required|url',
            'nickname'=> 'required|alpha_num',
            'description'   =>  'max:140',
            'twitter'  =>   'required|alpha_dash',
            'rss'   =>  'required|url',      
       ];
       if ($create) {
           $rules['nickname'] .= '|unique:blogs';
       }
       return $rules;
    }
}
