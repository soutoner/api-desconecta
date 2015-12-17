<?php

namespace App\Db\Seeds\Models;

use App\Db\Seeds\Models\BaseSeeder;

class GuestListSeeder extends BaseSeeder
{
    protected static $n_fake_seeds = 5;

    protected static $db_seeds = [
        [
            'id'            => 1,
            'start_time'    => '2015-12-17 17:12:12',
            'end_time'      => '2015-12-17 20:12:12',
            'max_friends'   => '1',
            'max_capacity'  => '120',
        ], [
            'id'            => 2,
            'start_time'    => '2015-12-18 16:12:12',
            'end_time'      => '2015-12-18 21:12:12',
            'max_friends'   => '2',
            'max_capacity'  => '125',
        ],
    ];

    protected static $extra_seeds = [
        [
            'start_time'    => '2015-12-19 18:12:12',
            'end_time'      => '2015-12-19 20:12:12',
            'max_friends'   => '5',
            'max_capacity'  => '200',
        ],
    ];

    public static function GenerateFake($faker){
        return [
            'start_time'    => $faker->dateTime($min = 'now'),
            'end_time'      => $faker->dateTime($min = 'now'),
            'max_friends'   => $faker->optional()->randomDigit,
            'max_capacity'  => $faker->optional()->randomDigit,
        ];
    }
}