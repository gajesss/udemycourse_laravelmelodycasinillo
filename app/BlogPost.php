<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BlogPost extends Model
{


   public function comments()
   {
       return $this->hasMany('App\Comment');
   }

   protected $dates = [
      'created_at',
      'updated_at',
      'deleted_at'
  ];


   protected $fillable=['title','content'];

}
