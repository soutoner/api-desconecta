<?php

namespace App\Db\Seeds\Models;

use App\Db\Seeds\Models\BaseSeeder;

class RRPPSeeder extends BaseSeeder
{
    protected static $n_fake_seeds = 5;

    protected static $db_seeds = [
        [
            'id'        => 1,
            'verified'  => true,
        ], [
            'id'        => 2,
            'verified'  => false
        ],
    ];

    protected static $extra_seeds = [
        [
            'verified'  => false,
        ], [
            'verified'  => true,
        ],
    ];

    public static function GenerateFake($faker){
        return [
            'verified' => $faker->boolean($chanceOfGettingTrue = 50),
        ];
    }
}