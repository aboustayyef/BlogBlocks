<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $guarded=['id'];
    
    /**
     * 
     * Eloquent Relationships
     * 
     */

    public function parent()
    {
      return $this->belongsTo('App\Tag','parent_id');             
    }

    public function sources()
    {
      return $this->belongsToMany('App\Source');
    }

    public function posts()
    {
      return $this->belongsToMany('App\Post');
    }

    /**
     *
     * Static Getter Functions
     * 
     */

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
     * 
     * Utility functions
     * 
     */

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


    /**
     * 
     * Form Validation 
     * 
     */
    
    public static function validationRules($create=true)
    {
       $rules = [
            'description'  =>  'required|min:6',
            'nickname'=> 'required|alpha_num',
       ];

       // This is a conditional validation rule
       // that only applies for when creating records
       // when editing a record, the 'unique' validation
       // for the nickname should not be applied

       if ($create) {
            $rules['nickname'] .= '|unique:tags';
       }
       
       return $rules;
    }


    /**
     * 
     * Function to convert a string to a list of Tag Ids
     * 
     * Useful mainly for importing from the old Database, where tags were
     * listed in columns in the posts and blogs tables
     * 
     * @param  String $string (like 'politics, society')
     * @return Collection of Tag Ids $tags ()
     */
    
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


