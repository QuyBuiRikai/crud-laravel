<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
  protected $table = 'news';
  protected $guarded = [];

  public function comments()
  {
    return $this->morphMany(Comment::class, 'commentable');
  }
}
