<?php

namespace App\Db\Seeds\Models;

use App\Db\Seeds\Models\BaseSeeder;

class RRPPSeeder extends BaseSeeder
{
    protected static $n_fake_seeds = 5;

    protected static $db_seeds = [];

    protected static $extra_seeds = [
        [
            'verified'  => 'false',
        ],
        [
            'verified'  => 'true',
        ],
    ];

    public static function GenerateFake($faker){
        return [
            'verified' => $faker->boolean($chanceOfGettingTrue = 50),
        ];
    }
}