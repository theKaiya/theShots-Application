<?php

namespace App\TheShots\Helpers\Controllers;

use Illuminate\Support\Facades\Input;
use App\TheShots\Models\Shot;
use App\TheShots\Models\ShotImage;
use makeImage;

trait ShotHelper
{
    /**
     * Create a new shot.
     *
     * @param $request
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function createShotInstance($request)
    {
        return Shot::create([
            'user_id' => u()->id,
            'title' => $request->get('title'),
            'description' => $request->get('description'),
            'tags' => validateTags($request->get('tags')),
            'is_activated' => 1,
        ]);
    }

    /**
     * Upload all shot images.
     *
     * @param Shot $shot
     */
    public function UploadShotImages (Shot $shot)
    {
        $files = Input::file('images');

        if(!is_array($files))
            $files[] = $files;

        $images = [];

        foreach($files as $file)
        {
            $name = jpg_random();
            $path = get_upload_path();

            makeImage::make($file)->save(public_path($path.$name));

            $images[] = [
                'user_id' => u()->id,
                'shot_id' => $shot->id,
                'is_preview' => 0,
                'path' => $path,
                'image' => $name,
            ];
        }

        ShotImage::insert($images);
    }


    /**
     * Upload shot avatar.
     *
     * @param Shot $shot
     */
    public function uploadShotPreview(Shot $shot)
    {
        $name = jpg_random();
        $path = get_upload_path();

        makeImage::make(Input::file('preview_image'))->save(public_path($path.$name));

        ShotImage::create([
            'user_id' => u()->id,
            'shot_id' => $shot->id,
            'is_preview' => 1,
            'path' => $path,
            'image' => $name,
        ]);
    }

    /**
     * Validate request.
     *
     * @param $request
     */
    public function rules ($request)
    {
        $this->validate($request, [
            'title' => 'required|max:255',
            'description' => 'required|max:255',
            'preview_image' => 'required|image:jpeg,jpg,png|dimensions:max_width=1280,max_height=720',
            'images.*' => 'image:jpeg,jpg,png|dimensions:max_width=1280,max_height=720',
        ]);
    }
}