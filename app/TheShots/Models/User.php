<?php

namespace App\TheShots\Models;

use App\TheShots\Traits\ModelHelpers;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * App\TheShots\Models\User
 *
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\TheShots\Models\User[] $followers
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\TheShots\Models\User[] $followings
 * @property-read mixed $about_small
 * @property-read mixed $act
 * @property-read mixed $avatar
 * @property-read mixed $followers_count
 * @property-read mixed $followings_count
 * @property-read mixed $is_followed
 * @property-read mixed $likes_count
 * @property-read mixed $link
 * @property-read mixed $links
 * @property-read mixed $sections
 * @property-read mixed $shots_count
 * @property-read mixed $shots_count_diff
 * @property-read mixed $socials
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\TheShots\Models\Shot[] $likes
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\TheShots\Models\Shot[] $shots
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\TheShots\Models\Shot[] $shotsIds
 * @mixin \Eloquent
 * @property int $id
 * @property string $username
 * @property string $email
 * @property string $password
 * @property string $location
 * @property string $position
 * @property string $about
 * @property object $picture
 * @property object $settings
 * @property object $social
 * @property int $is_admin
 * @property int $is_blocked
 * @property int $is_activated
 * @property string $remember_token
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\TheShots\Models\User whereAbout($value)
 * @method static \Illuminate\Database\Query\Builder|\App\TheShots\Models\User whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\TheShots\Models\User whereEmail($value)
 * @method static \Illuminate\Database\Query\Builder|\App\TheShots\Models\User whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\TheShots\Models\User whereIsActivated($value)
 * @method static \Illuminate\Database\Query\Builder|\App\TheShots\Models\User whereIsAdmin($value)
 * @method static \Illuminate\Database\Query\Builder|\App\TheShots\Models\User whereIsBlocked($value)
 * @method static \Illuminate\Database\Query\Builder|\App\TheShots\Models\User whereLocation($value)
 * @method static \Illuminate\Database\Query\Builder|\App\TheShots\Models\User wherePassword($value)
 * @method static \Illuminate\Database\Query\Builder|\App\TheShots\Models\User wherePicture($value)
 * @method static \Illuminate\Database\Query\Builder|\App\TheShots\Models\User wherePosition($value)
 * @method static \Illuminate\Database\Query\Builder|\App\TheShots\Models\User whereRememberToken($value)
 * @method static \Illuminate\Database\Query\Builder|\App\TheShots\Models\User whereSettings($value)
 * @method static \Illuminate\Database\Query\Builder|\App\TheShots\Models\User whereSocial($value)
 * @method static \Illuminate\Database\Query\Builder|\App\TheShots\Models\User whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\TheShots\Models\User whereUsername($value)
 */
class User extends Authenticatable
{
    use Notifiable, ModelHelpers;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username',
        'email',
        'password',
        'settings',
        'social',
        'picture',
        'position',
        'location',
        'about',
        'api_token',
        'settings->notify->new_comment_to_shot',
        'settings->notify->new_follower',
        'settings->notify->new_newsletters',
        'settings->notify->new_shot_from_following'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'act', 'sections', 'picture',
        'settings'
    ];

    protected $casts = [
      'settings' => 'object',
      'picture' => 'object',
      'social' => 'object',
      'links' => 'object',
    ];

    protected $appends = [
      'link', 'is_follow', 'links', 'about_small',
      'avatar', 'sections', 'act'
    ];

    /**
     * Get a user shots.
     *
    */
    public function shots ()
    {
      return $this->hasMany(Shot::class, 'user_id', 'id');
    }

    public function shotsIds ()
    {
      return $this->hasMany(Shot::class, 'user_id', 'id')->select(['id', 'user_id']);
    }

    /**
     * Get a user shots.
     *
    */
    public function likes ()
    {
      return $this->hasMany(Like::class, 'user_id', 'id');
    }

    /**
     * Get a user followers.
     *
    */
    public function followers ()
    {
      return $this->hasMany(Follow::class, 'to', 'id');
    }

    /**
     * Get a user followings.
     *
    */
    public function followings ()
    {
        return $this->hasMany(Follow::class, 'from', 'id');
    }

    /**
     * Refactor later.
     *
     * @return mixed
     */
    public function followed ()
    {
        return $this->hasOne(Follow::class, 'to', 'id')->whereFrom(u()->id ?? null);
    }

    /**
     * Checks whether we are in user or not.
     * #REPLACE.
    */
    public function getIsFollowAttribute ()
    {
      $id = auth()->check() ? u()->id : 0;

      if($id && $this->hasRelation('followed')) {
          return $this->followed()->count();
      }
      return 0;
    }

    /**
     * Returns the number of social networks that the user filled out.
    */
    public function getSocialsAttribute ()
    {
      $items = [];

      foreach ($this->social as $key => $value)
       {
         if($value->username) {
           $items[$key] = $value;
         }
       }
      return $items;
    }

    /**
     * Return a full profile link.
    */
    public function getLinkAttribute ()
    {
      return Route('user', strtolower($this->username));
    }

    /**
     * User picture url.
    */
    public function getAvatarAttribute ()
    {
      return asset($this->picture->path.$this->picture->image);
    }

    /**
     * End here.
    */

    /**
     * Return a plural name.
     * shot -> shots.
    */
    public function getShotsCountDiffAttribute ()
    {
      return $this->shots_count.' '.str_plural('shot', $this->shots_count);
    }

    /**
     * Small about info.
    */
    public function getAboutSmallAttribute ()
    {
      return str_limit($this->about, 70);
    }

    /**
     * User content sections.
    */
    public function getSectionsAttribute ()
    {
      return [
        'shots',
        'likes',
        'followers',
        'followings'
      ];
    }

    /**
     * Act, e.g ?act=shots
    */
    public function getActAttribute ()
    {
      return 'act';
    }

    /**
     * All links for user sections + count. (if required)
     *
     * Ну типа.. сорри.
     * Тыковка пока не додумалась до более
     * приятного решения.
    */
    public function getLinksAttribute()
    {
      $url = strtolower(route("user", $this->username)."?$this->act=");

      $routes = new \stdClass;

      foreach($this->sections as $section)
      {
          $routes->$section = (object)[
            'link' => $url.$section,
            'count' => $this->c($section),
          ];
      }

      return $routes;
    }

    /**
     * Follow to $this user.
    */
    public function follow ()
    {
      return Follow::create([
        'to' => $this->id,
        'from' => u()->id,
      ]);
    }

    /**
     * UnFollow from $this user.
    */
    public function unFollow ()
    {
      return Follow::whereTo($this->id)->whereFrom( u()->id )->forceDelete();
    }

    /**
     * @param $relation
     *
     * @return string
     */
    public function c($relation)
    {
        $attribute = $relation.'_count';

        return isset($this->$attribute) ? k($this->$attribute) : 0;
    }

    public function followingsShots ()
    {
        return Shot::join('follows', 'follows.from', 'shots.user_id')
            ->where('follows.to', $this->id);
    }
}
