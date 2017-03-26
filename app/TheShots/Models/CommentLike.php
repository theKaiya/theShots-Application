<?php

namespace App\TheShots\Models;

use Illuminate\Database\Eloquent\Model;

class CommentLike extends Model
{
    protected $fillable = [
      'user_id', 'comment_id'
    ];
}
