<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PostingFrequency extends Model
{
    public function source()
    {
        return $this->belongsTo('App\Source');
    }
}
