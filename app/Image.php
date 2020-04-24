<?php

namespace App;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $fillable = ['path'];
    public function imageable()
    {
        
        return $this->belongsTo('App\BlogPost');
    }
    public function url()
    {
        return $this->morphTo();
    }
}
