<?php

namespace App\TheShots\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\TheShots\Models\Follow
 *
 * @mixin \Eloquent
 * @property int $id
 * @property int $to
 * @property int $from
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\TheShots\Models\Follow whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\TheShots\Models\Follow whereFrom($value)
 * @method static \Illuminate\Database\Query\Builder|\App\TheShots\Models\Follow whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\TheShots\Models\Follow whereTo($value)
 * @method static \Illuminate\Database\Query\Builder|\App\TheShots\Models\Follow whereUpdatedAt($value)
 */
class Follow extends Model
{
  protected $fillable = [
    'to', 'from'
  ];
  
}
