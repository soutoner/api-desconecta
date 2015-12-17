<?php

namespace App\Db\Seeds\Models\Relationships;

use App\Db\Seeds\Models\BaseSeeder;
use App\Models\Event;
use App\Models\User;

class AttendSeeder extends BaseSeeder
{
    protected static $n_fake_seeds = 20;

    protected static $db_seeds = [
        [
            'user_id'       => 2,
            'event_id'      => 1,
            'geo_attended'  => false,
        ],
    ];

    protected static $extra_seeds = [
        [
            'user_id'       => 1,
            'event_id'      => 1,
            'geo_attended'  => true,
        ],
    ];

    public static function GenerateFake($faker){
        return [
            'user_id'       => $faker->numberBetween($min = 1, $max = User::count()),
            'event_id'      => $faker->numberBetween($min = 1, $max = Event::count()),
            'geo_attended'  => $faker->boolean($chanceOfGettingTrue = 50),
        ];
    }
}