<?php

namespace App\TheShots\Helpers\Models;

class UserInstanceHelper
{
    public static function userDefaultImage ()
    {
        return [
          'path' => '/assets/images/',
          'image' => 'default-user.jpg',
        ];
    }

    public static function userDefaultNetworks ()
    {
        return [
            'vk' => [
              'url' => 'https://vk.com',
              'contain' => 'vk.com',
              'icon' => 'fa fa-vk',
              'link' => null,
            ],
            'twitter' => [
                'url' => 'https://twitter.com',
                'contain' => 'twitter.com',
                'icon' => 'fa fa-twitter',
                'link' => null,
            ],
            'google' => [
                'url' => 'https://google.com',
                'contain' => 'google.com',
                'icon' => 'fa fa-twitter',
                'link' => null,
            ],
        ];
    }

}