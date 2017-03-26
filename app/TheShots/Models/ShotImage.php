<?php

namespace App\TheShots\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\TheShots\Models\ShotImage
 *
 * @mixin \Eloquent
 * @property int $id
 * @property int $user_id
 * @property int $shot_id
 * @property string $image
 * @property string $path
 * @property int $is_preview
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\TheShots\Models\ShotImage whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\TheShots\Models\ShotImage whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\TheShots\Models\ShotImage whereImage($value)
 * @method static \Illuminate\Database\Query\Builder|\App\TheShots\Models\ShotImage whereIsPreview($value)
 * @method static \Illuminate\Database\Query\Builder|\App\TheShots\Models\ShotImage wherePath($value)
 * @method static \Illuminate\Database\Query\Builder|\App\TheShots\Models\ShotImage whereShotId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\TheShots\Models\ShotImage whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\TheShots\Models\ShotImage whereUserId($value)
 */
class ShotImage extends Model
{
    protected $fillable = [
      'user_id', 'shot_id', 'image', 'path', 'is_preview'
    ];

    protected $appends = [
        'preview', 'link'
    ];

    protected $hidden = [
      'shot_id', 'user_id', 'image', 'path', 'is_preview', 'created_at', 'updated_at'
    ];

    /**
     * Return a preview image.
     *
     * @return string
     */
    public function getPreviewAttribute ()
    {
        if($this->is_preview) {
            return $this->image;
        }
    }

    /**
     * Get the full path to the image.
     *
     * @return string
     */
    public function getLinkAttribute ()
    {
        return asset($this->path.$this->image);
    }
}
