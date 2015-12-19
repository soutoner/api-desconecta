<?php

namespace App\Db\Seeds\Models;

use App\Db\Seeds\Models\BaseSeeder;
use App\Models\Provider;
use App\Models\User;

class ProfileSeeder extends BaseSeeder
{
    protected static $n_fake_seeds;

    protected static $db_seeds = [
        [
            'uid'           => '895345',
            'access_token'  => 'access_token895345',
            'user_id'       => 2,
            'provider_id'   => 1,
        ], [
            'uid'           => '2345',
            'access_token'  => 'access_token2345',
            'user_id'       => 1,
            'provider_id'   => 2,
        ],
    ];

    protected static $extra_seeds = [
        [
            'uid'           => '12345',
            'access_token'  => 'access_token1234',
            'user_id'       => 1,
            'provider_id'   => 1,
        ],
    ];

    public static function GenerateFake($faker)
    {
        return [
            'uid'           => $faker->uuid,
            'access_token'  => $faker->swiftBicNumber,
            'user_id'       => $faker->numberBetween($min = 1, $max = User::count()),
            'provider_id'   => $faker->numberBetween($min = 1, $max = Provider::count()),
        ];
    }
}