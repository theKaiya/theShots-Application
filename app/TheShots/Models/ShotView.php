<?php

namespace App\TheShots\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\TheShots\Models\ShotView
 *
 * @mixin \Eloquent
 * @property int $id
 * @property string $user_ip
 * @property int $user_id
 * @property int $shot_id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\TheShots\Models\ShotView whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\TheShots\Models\ShotView whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\TheShots\Models\ShotView whereShotId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\TheShots\Models\ShotView whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\TheShots\Models\ShotView whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\TheShots\Models\ShotView whereUserIp($value)
 */
class ShotView extends Model
{
    protected $fillable = [
      'shot_id', 'user_id', 'user_ip'
    ];

    protected $table = 'shot_views';
}
