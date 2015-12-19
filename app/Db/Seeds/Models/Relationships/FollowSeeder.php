<?php

namespace App\Db\Seeds\Models\Relationships;

use App\Db\Seeds\Models\BaseSeeder;
use App\Models\Local;
use App\Models\User;

class FollowSeeder extends BaseSeeder
{
    protected static $n_fake_seeds = 20;

    protected static $db_seeds = [
        [
            'user_id'   => 1,
            'local_id'  => 1,
        ],
    ];

    protected static $extra_seeds = [
        [
            'user_id'   => 1,
            'local_id'  => 2,
        ],
    ];

    public static function GenerateFake($faker)
    {
        return [
            'user_id'   =>  $faker->numberBetween($min = 1, $max = User::count()),
            'local_id'  =>  $faker->numberBetween($min = 1, $max = Local::count()),
        ];
    }
}