<?php

namespace App;
use App\Scopes\LatestScope;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use SoftDeletes;
    public function blogPost()
    {
        return $this->belongsTo('App\BlogPost');
    }
    public static function boot()
    {
        parent::boot();

        static::addGlobalScope(new LatestScope);
}
}
