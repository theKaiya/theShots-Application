<?php

namespace App\TheShots\Models;

use Illuminate\Database\Eloquent\Model;
use App\TheShots\Traits\ModelHelpers;

/**
 * App\TheShots\Models\Shot
 *
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\TheShots\Models\Comment[] $comments
 * @property-read mixed $comments_count
 * @property-read mixed $liked
 * @property-read mixed $likes_count
 * @property-read mixed $link
 * @property-read mixed $preview_image
 * @property-read mixed $tags
 * @property-read mixed $time
 * @property-read \App\TheShots\Models\User $user
 * @property-read mixed $views_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\TheShots\Models\ShotImage[] $images
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\TheShots\Models\Like[] $likes
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\TheShots\Models\ShotView[] $views
 * @mixin \Eloquent
 * @property int $id
 * @property int $user_id
 * @property string $title
 * @property string $about
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\TheShots\Models\Shot whereAbout($value)
 * @method static \Illuminate\Database\Query\Builder|\App\TheShots\Models\Shot whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\TheShots\Models\Shot whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\TheShots\Models\Shot whereTags($value)
 * @method static \Illuminate\Database\Query\Builder|\App\TheShots\Models\Shot whereTitle($value)
 * @method static \Illuminate\Database\Query\Builder|\App\TheShots\Models\Shot whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\TheShots\Models\Shot whereUserId($value)
 */
class Shot extends Model
{
    use ModelHelpers;

    protected $fillable = [
        'user_id',
        'title',
        'description',
        'tags',
        'is_activated',
    ];

    protected $appends = [
        'liked',
        'link',
        'time',
        'preview_image',
        'tags',
        'posted_on'
    ];

    protected $hidden = [
        'updated_at',
        'created_at',
        'likes',
        'views',
        'image'
    ];

    protected  $casts = [
        'time'
    ];

    /**
     * Has many likes shot have?
     *
    */
    public function likes ()
    {
      return $this->hasMany(Like::class, 'shot_id', 'id')->select(['shot_id', 'user_id']);
    }

    /**
     * Get all shot comments.
     *
     * Maybe need to rework.
     * #
    */
    public function comments ()
    {
      return $this->hasMany(Comment::class, 'shot_id', 'id');
    }

    /**
     * Views
    */
    public function views ()
    {
      return $this->hasMany(ShotView::class, 'shot_id', 'id')->select(['shot_id']);
    }


    /**
     * Return a shot author.
    */
    public function user ()
    {
      return $this->belongsTo(User::class, 'user_id', 'id')->select(['id', 'username', 'picture', 'is_blocked']);
    }

    /**
     * @return mixed
     */
    public function images ()
    {
       return $this->hasMany(ShotImage::class);
    }

    /**
     * @return mixed
     */
    public function image ()
    {
        return $this->hasOne(ShotImage::class, 'shot_id', 'id')->whereIsPreview(1);
    }

    public function getLikedAttribute ()
    {
      if(Auth()->check()) {
        return $this->likes->contains(function ($e) {
          return $e->user_id == u()->id;
        });
      }
      return false;
    }

    public function getTagsAttribute ()
    {
      if(isset($this->attributes['tags'])) {
        return explode(',', $this->attributes['tags']);
      }
    }

    public function getPostedOnAttribute ()
    {
        if($this->created_at) {
            return $this->created_at->format('t M, Y');
        }
        return 'Date not specified.';
    }

    /**
     * Return a full link on shot.
    */
    public function getLinkAttribute ()
    {
      return Route('shot', $this->id);
    }

    public function getPreviewImageAttribute ()
    {
        if($this->hasRelation('image')) {
            return $this->image->path.$this->image->image;
        }
        return null;
    }
    

    /**
     * Like the shot.
    */
    public function like ()
    {
      return Like::create([
        'user_id' => u()->id,
        'shot_id' => $this->id,
      ]);
    }

    /**
     * Unlike the shot.
    */
    public function unlike ()
    {
      return Like::whereUserId(u()->id)
      ->whereShotId($this->id)
      ->forceDelete();
    }

    /**
     * Add the 1 view by user.
    */
    public function see ()
    {
      $user_id = Auth()->check() ? u()->id : null;

      $user_ip = request()->ip();

      $hasView = ShotView::whereShotId( $this->id )->whereUserIp( $user_ip )->first();

      if(!$hasView) {
        ShotView::create([
          'user_id' => $user_id,
          'shot_id' => $this->id,
          'user_ip' => $user_ip
        ]);
      }
    }
}
