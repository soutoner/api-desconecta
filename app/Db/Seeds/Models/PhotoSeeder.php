<?php

namespace App\Db\Seeds\Models;

use App\Db\Seeds\Models\BaseSeeder;
use App\Models\Event;

class PhotoSeeder extends BaseSeeder
{
    protected static $n_fake_seeds;

    protected static $db_seeds = [
        [
            'id'        => 1,
            'uri'       => 'uri1',
            'desc'      => 'desc1',
            'event_id'  => 1,
        ], [
            'id'        => 2,
            'uri'       => 'uri2',
            'desc'      => 'desc2',
            'event_id'  => 1,
        ],
    ];

    protected static $extra_seeds = [
        [
            'uri'       => 'urinew',
            'desc'      => 'descnew',
            'event_id'  => 1,
        ],
    ];

    public static function GenerateFake($faker)
    {
        return [
            'uri'       => $faker->imageUrl($width = 640, $height = 480),
            'desc'      => $faker->optional()->text($maxNbChars = 200),
            'event_id'  => $faker->numberBetween($min = 1, $max = Event::count()),
        ];
    }
}