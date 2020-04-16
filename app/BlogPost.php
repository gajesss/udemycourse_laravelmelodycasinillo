<?php

namespace App;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use App\Scopes\DeletedAdminScope;

class BlogPost extends Model
{
    // protected $table = 'blogposts';

    use SoftDeletes;

    protected $fillable = ['title', 'content', 'user_id'];

    public function comments()
    {
        return $this->hasMany('App\Comment')->latest();
    }
    public function user()
    {
        return $this->belongsTo('App\User');
    }
    public function scopeLatest(Builder $query)
    {
        return $query->orderBy(static::CREATED_AT, 'desc');
    }

    public function scopeMostCommented(Builder $query)
    {
        // comments_count
        return $query->withCount('comments')->orderBy('comments_count', 'desc');
    }


    public static function boot()
    {
        static::addGlobalScope(new DeletedAdminScope);
        parent::boot();
        // static::deleting(function (BlogPost $blogPost) {
        //     $blogPost->comments()->delete();
        // });
        
       //static::addGlobalScope(new LatestScope);
       static::deleting(function (BlogPost $blogPost) {
            $blogPost->comments()->delete();
       });

        static::restoring(function (BlogPost $blogPost) {
            $blogPost->comments()->restore();
        });
   }
}
