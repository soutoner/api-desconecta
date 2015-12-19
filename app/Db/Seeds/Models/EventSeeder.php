<?php

namespace App\Db\Seeds\Models;

use App\Db\Seeds\Models\BaseSeeder;
use App\Models\GuestList;
use App\Models\Scheduling;


class EventSeeder extends BaseSeeder
{
    protected static $n_fake_seeds = 5;

    protected static $db_seeds = [
        [
            'id'            => 1,
            'name'          => 'Son las 5 en la mañana, y yo no he dormido nada',
            'desc'          => 'Pensando en tu belleza, en loco voy a acabar',
            'photo_cover'   => 'http://foo.com',
            'start_date'    => '2015-12-17 16:54:21',
            'end_date'      => '2015-12-18 16:54:21',
            'flyer'         => 'http://flyer.com',
            'local_id'      => 1,
            'guestList_id'  => 1,
            'scheduling_id' => 1,
        ],
    ];

    protected static $extra_seeds = [
        [
            'name'          => 'Son las 10 en la mañana',
            'desc'          => 'Pensando en tu belleza, en loco no voy a acabar',
            'photo_cover'   => 'http://foo.com',
            'start_date'    => '2016-12-17 16:54:21',
            'end_date'      => '2016-12-18 16:54:21',
            'flyer'         => 'http://flyer.com',
            'local_id'      => 1,
            'guestList_id'  => 2,
            'scheduling_id' => 2,
        ],
    ];

    public static function GenerateFake($faker)
    {
        return [
            'name'          => $faker->sentence($nbWords = 6),
            'desc'          => $faker->text($maxNbChars = 200),
            'photo_cover'   => $faker->imageUrl($width = 640, $height = 480),
            'start_date'    => $faker->dateTime($min = 'now'),
            'end_date'      => $faker->dateTime($min = 'now'),
            'flyer'         => $faker->imageUrl($width = 640, $height = 480),
            'local_id'      => $faker->numberBetween($min = 1, $max = RRPP::count()),
            'guestList_id'  => $faker->optional()->unique()->numberBetween($min = 1, $max = GuestList::count()),
            'scheduling_id' => $faker->optional()->unique()->numberBetween($min = 1, $max = Scheduling::count()),
        ];
    }
}