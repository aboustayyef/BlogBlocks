<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $guarded=['id'];
    
    public function parent()
    {
      return $this->belongsTo('App\Tag','parent_id');             
    }
    /**
     * These are the rules for validating field form submissions
     * @return array 
     */
    public static function validationRules($create=true)
    {
       $rules = [
            'description'  =>  'required|min:6',
            'nickname'=> 'required|alpha_num',
       ];
       if ($create) {
            $rules['nickname'] .= '|unique:tags';
       }
       return $rules;
    }
}


