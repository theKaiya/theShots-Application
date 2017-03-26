<?php

namespace App\TheShots\Models;

use App\TheShots\Traits\ModelHelpers;
use Illuminate\Database\Eloquent\Model;

/**
 * App\TheShots\Models\Comment
 *
 * @property-read \App\TheShots\Models\User $user
 * @mixin \Eloquent
 * @property int $id
 * @property string $message
 * @property int $user_id
 * @property int $shot_id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\TheShots\Models\Comment whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\TheShots\Models\Comment whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\TheShots\Models\Comment whereMessage($value)
 * @method static \Illuminate\Database\Query\Builder|\App\TheShots\Models\Comment whereShotId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\TheShots\Models\Comment whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\TheShots\Models\Comment whereUserId($value)
 */
class Comment extends Model
{
    use ModelHelpers;

    protected $fillable = [
      'user_id', 'shot_id', 'message'
    ];

    protected  $appends = [
      'time', 'liked', 'likes_count'
    ];

    protected $hidden = [
      'likes', 'user_id'
    ];

    
    public function user ()
    {
      return $this->hasOne(User::class, 'id', 'user_id')->select(['id', 'username', 'picture']);
    }

    /**
     * Has many likes comment have..
     *
     * @return mixed
     */
    public function likes ()
    {
        return $this->hasMany(CommentLike::class, 'comment_id', 'id');
    }

    public function isLiked ()
    {
        if(! auth()->check())
            return false;

        return $this->hasOne(CommentLike::class)
            ->whereUserId(u()->id)
            ->whereCommentId($this->id);
    }

    /**
     * Has many likes comment have..
     *
     * @return mixed
     */
    public function getLikesCountAttribute ()
    {
        if($this->hasRelation('likes')) {
            return k( $this->likes->count() );
        }
    }

    public function getLikedAttribute ()
    {
        if(!auth()->check()) {
            return false;
        }

        return CommentLike::whereUserId(u()->id)->whereCommentId($this->id)->first();
    }

    /**
     * unlike this comment by current auth user.
     */
    public function unLike ()
    {
        CommentLike::whereCommentId($this->id)
            ->whereUserId(u()->id)->forceDelete();
    }

    /**
     * Create a like for comment.
     */
    public function like ()
    {
        CommentLike::create([
           'user_id' => u()->id,
           'comment_id' => $this->id,
        ]);
    }

}
