<?php

namespace App;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use SoftDeletes;
    public function blogPost()
    {
        return $this->belongsTo('App\BlogPost');
    }
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function scopeLatest(Builder $query)
    {
        return $query->orderBy(static::CREATED_AT, 'desc');
    }
    public static function boot()
    {
        parent::boot();

       // static::addGlobalScope(new LatestScope);
}
}
