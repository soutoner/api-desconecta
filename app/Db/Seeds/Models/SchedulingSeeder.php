<?php

namespace App\Db\Seeds\Models;

use App\Db\Seeds\Models\BaseSeeder;
use App\Models\Period;

class SchedulingSeeder extends BaseSeeder
{
    protected static $n_fake_seeds = 5;

    protected static $db_seeds = [
        [
            'id'            => 1,
            'end_period'    => '2015-12-20 17:56:56',
            'period_id'     => 1,
        ], [
            'id'            => 2,
            'end_period'    => '2015-12-21 20:56:56',
            'period_id'     => 2,
        ],
    ];

    protected static $extra_seeds = [
        [
            'end_period'    => '2015-12-29 17:56:56',
            'period_id'     => 1,
        ],
    ];

    public static function GenerateFake($faker){
        return [
            'end_period'    => $faker->dateTime($min = 'now'),
            'period_id'     => $faker->numberBetween($min = 1, $max = Period::count()),
        ];
    }
}