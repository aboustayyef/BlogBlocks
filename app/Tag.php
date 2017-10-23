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

    public function hasParent()
    {
      if ($this->parent()->count() > 0) {
        return $this->parent;
      }
      return false;
    }
    public static function exists($nickname)
    {
      return Static::where('nickname', $nickname)->count() > 0;
    }

    public static function getByNickname($nickname)
    {
      return Static::where('nickname', $nickname)->first();
    }

    public static function getByNicknameTopmost($nickname)
    {
      if (Static::getByNickname($nickname)->hasParent()) {
        return Static::getByNickname($nickname)->parent;
      }
      return Static::getByNickname($nickname);
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


    public function sources()
    {
      return $this->belongsToMany('App\Source');
    }

    public static function createListFromString($string){
      $tags = collect(explode(',', $string));                  // process tag strings like "society, politics"
      $tags = $tags->filter(function($tag){                    // remove tags that don't exist in tags db
          return Static::exists(trim($tag));
      })->map(function($tag){                                     // get the uppermost tag object: example: tv > media 
          return Static::getByNicknameTopmost(trim($tag))->id;
      })->unique();  
      return $tags;
    }
}


