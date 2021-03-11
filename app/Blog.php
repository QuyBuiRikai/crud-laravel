<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
  protected $guarded = [];

  public function comments()
  {
    return $this->morphMany(Comment::class, 'commentable');
  }

  public function user()
  {
    return $this->belongsTo(User::class);
  }
}
