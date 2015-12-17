<?php

namespace App\Db\Seeds\Models\Relationships;

use App\Db\Seeds\Models\BaseSeeder;
use App\Models\Photo;
use App\Models\User;

class AppearSeeder extends BaseSeeder
{
    protected static $n_fake_seeds = 20;

    protected static $db_seeds = [
        [
            'user_id'   => 2,
            'photo_id'  => 1,
        ],
    ];

    protected static $extra_seeds = [
        [
            'user_id'   => 1,
            'photo_id'  => 2,
        ],
    ];

    public static function GenerateFake($faker){
        return [
            'user_id'   =>  $faker->numberBetween($min = 1, $max = User::count()),
            'photo_id'  =>  $faker->numberBetween($min = 1, $max = Photo::count()),
        ];
    }
}