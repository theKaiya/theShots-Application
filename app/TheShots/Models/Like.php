<?php

namespace App\TheShots\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\TheShots\Models\Like
 *
 * @mixin \Eloquent
 * @property int $id
 * @property int $user_id
 * @property int $shot_id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\TheShots\Models\Like whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\TheShots\Models\Like whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\TheShots\Models\Like whereShotId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\TheShots\Models\Like whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\TheShots\Models\Like whereUserId($value)
 */
class Like extends Model
{
    protected $fillable = [
      'user_id', 'shot_id'
    ];
}
