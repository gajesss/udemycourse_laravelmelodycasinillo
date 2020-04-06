<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BlogPost extends Model
{
   protected $dates = [
      'created_at',
      'updated_at',
      'deleted_at'
  ];


   protected $fillable=['title','content'];
}

