<?php

namespace App;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Comment extends Model
{
    use SoftDeletes;
    protected $fillable=['user_id'.'content'];
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

        static::creating(function (BlogPost $blogPost) {
            Cache::forget("blog-post-{$blogPost->id}");
        });
}
}
