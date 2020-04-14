<?php

namespace App;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use SoftDeletes;
    public function blogPost()
    {
        return $this->belongsTo('App\BlogPost');
    }
}
